<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use App\Models\ColorBasico;
use App\Models\ImagenColorUña; 
use App\Models\Carrito;
use App\Models\Compras;
use App\Models\detallesCompras;
use App\Models\Compra;
use App\Models\uña;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class ConsultasController extends Controller
{


    public function login()
    {
        $correo = $_POST['correo']; // Obtener el valor del usuario directamente de $_POST
        $clave=$_POST['clave'];

        // Consultar la base de datos para ver si el nombre de usuario existe
        $usuario = Usuario::where('Correo', $correo)->where('clave', $clave)->first();
    
        if ($usuario!== null) {
            //SESSION
            Auth::login($usuario, true);
            // Si el usuario existe en la base de datos, redireccionar a home.blade.php
            return redirect()->route('home');
        } else {
            return redirect()->route('login');
        }
    }
    
    //REGISTRARTE
    public function registro(){
        //RECUPERAMOS INFORMACION 
        $nombreUsuario=$_POST['usuario'];
        $clave = $_POST['clave'];
        $correo = $_POST['correo'];

        //CREAMOS OBJETO
        $nuevoUsuario = new Usuario();
        $nuevoUsuario->usuario = $nombreUsuario;
        $nuevoUsuario->clave = $clave;
        $nuevoUsuario->tipo = 0; 
        $nuevoUsuario->correo = $correo;
    
        $usuario=Usuario::where('Correo',$correo)->where('clave',$clave)->first();
        if($usuario!==null){
            return redirect()->route('registro')->with('error', '¡Cuenta ya existe!');
        }else{
            $nuevoUsuario->save();

            //manetener la session inicada
            Auth::login($nuevoUsuario);
    
    
            return redirect()->route('home')->with('success', '¡Registro exitoso!');
        }

      
    }

    //DESLOGUEARSE
    public function logout()
    {
        Auth::logout(); // Cerrar la sesión del usuario
        return redirect()->route('home'); // Redirigir a la página de inicio u otra página deseada
    }

    //PAGINA UÑAS
    public function obtenerUñas(){

        $datos = DB::table('unas')->select('nombre', 'precio','imagen')->get();

        return view('uñas', ['datos' => $datos]);
    }

    //PAGINA UÑA ESPECIFICA
   public function detallarUñas($nombre){
        $uña = DB::table('unas')->where('nombre', $nombre)->first();
    
        if($uña) {
            if ($uña->color === 'basicos') {
                $coloresBasicos = ColorBasico::where('stock', 'true')->get();
                return view('detallar_uñas', ['uña' => $uña, 'coloresBasicos' => $coloresBasicos]);
            }
            return view('detallar_uñas', ['uña' => $uña]);
        } else {
            return "La uña no se encontró.";
        }
    }

   

    public function carrito(Request $request) { 
        // ID USUARIO
        $userId = Auth::id();
        // COLOR A FORMATO RGB
        $colorFormateado = str_replace(['rgb(', ')', ' '], '', $request->input('color'));
    
        // Crear el objeto Carrito
        $carrito = new Carrito([
            'idUsuario' => $userId,
            'nombre' => $request->input('nombreUña'),
            'precio' => $request->input('precio'),
            'categoria' => $request->input('categoria'),
            'tipo' => $request->input('tipo'),
            'color' => $colorFormateado, 
            'imagen' => $request->input('imagen'),
            'tamaño' => $request->input('tamaño'),
            'cantidad' => 1
        ]);
    
        // Comprobar si ya existe un pedido similar
        $pedidoExistente = $this->comprobarPedidoExiste($carrito);
    
        if ($pedidoExistente) {
            Carrito::where('idUsuario', $carrito->idUsuario)
                ->where('categoria', $carrito->categoria)
                ->where('tipo', $carrito->tipo)
                ->where('tamaño', $carrito->tamaño)
                ->where('color', $carrito->color)
                ->where('nombre', $carrito->nombre)
                ->increment('cantidad', 1);
        } else {
            $carrito->save();
        }
    
        return response()->json(['success' => true]);
    }
    

    //COMPROBAR PEDIDOS
    public function comprobarPedidoExiste($carrito) {
        $usuario = $carrito->idUsuario;
        $categoria = $carrito->categoria;
        $tipo = $carrito->tipo;
        $tamaño = $carrito->tamaño;
        $color = $carrito->color;
        $nombre = $carrito->nombre;
    
        // Comprobar si ya existe un pedido similar
        $pedidoExistente = Carrito::where('idUsuario', $usuario)
            ->where('categoria', $categoria)
            ->where('tipo', $tipo)
            ->where('tamaño', $tamaño)
            ->where('color', $color)
            ->where('nombre', $nombre)
            ->first();
    
        return $pedidoExistente !== null;
    }


    //MOSTRAR LOS PEDIDOS
    public function mostrarCompras(){
        $userId = Auth::id();
        $compras = Carrito::where('idUsuario', $userId)->get();
    
        // Calcular el total
        $total = 0;
        foreach ($compras as $compra) {
            $total += $compra->precio * $compra->cantidad;
        }
    
    return view('carrito', ['compras' => $compras, 'total' => $total]);
    }




    //INSERTAMOS LA INFORMACION DE PRODUCTOS COMPRAMOS
    public function insertarInfoCompra(Request $request){

        $userId = Auth::id();
        $precioTotal = $request->input('precioTotal');
        $compras = json_decode($request->input('compras'), true);
    
        // CREAR OBJETO COMPRA Y GUARDAR
        $compra = Compras::create([
            'idUsuario' => $userId,
            'PrecioTot' => $precioTotal
        ]);
    
        // OBTENER EL ID DE LA COMPRA CREADA
        $idCompra = DB::getPdo()->lastInsertId();
    
        
    
        // CREAR OBJETO DETALLES COMPRAS Y GUARDAR
        foreach ($compras as $compraDetalle) {
            detallesCompras::create([
                'idCompra' => $idCompra,
                'nombre' => $compraDetalle['nombre'],
                'precio' => $compraDetalle['precio'],
                'categoria' => $compraDetalle['categoria'],
                'tipo' => $compraDetalle['tipo'],
                'color' => $compraDetalle['color'],
                'tamaño' => $compraDetalle['tamaño'],
                'cantidad' => $compraDetalle['cantidad']
            ]);
        }

        //ELIMINAR DE CARRITO LAS COSAS
        Carrito::where('idUsuario', $userId)->delete();
    
        return redirect()->route('home');

    }


    //BOTON ELIMINAR PRODUCTOS 
    public function eliminarCompra(Request $request)
    {
        $nombre = $request->input('nombre');
        $precio = $request->input('precio');
        $categoria = $request->input('categoria');
        $tipo = $request->input('tipo');
        $color = $request->input('color');
        $tamaño = $request->input('tamaño');
        $cantidad = $request->input('cantidad');

        // Buscar y eliminar el producto con los criterios especificados
        $deletedRows = DB::table('carrito')
                        ->where('nombre', $nombre)
                        ->where('precio', $precio)
                        ->where('categoria', $categoria)
                        ->where('tipo', $tipo)
                        ->where('color', $color)
                        ->where('tamaño', $tamaño)
                        ->where('cantidad', $cantidad)
                        ->delete();

        if ($deletedRows > 0) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Producto no encontrado']);
        }
    }



    public function filtrarUñas(Request $request)
    {
        $query = uña::query();

       /* if ($request->filled('forma')) {
            $query->where('nombre', $request->forma);
        }*/

        if ($request->filled('precio')) {
            $precio = $request->precio;
            $query->whereBetween('precio', [0, $precio]);
        }

        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        $datos = $query->get();

        return view('uñas', compact('datos'));
    }


    
}

?>