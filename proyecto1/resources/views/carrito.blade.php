@include('menu')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Aplicación</title>

    <style>
        .hidden {
            display: none;
        }
        .container {
            margin-top: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .BotonEliminar, .RealizarCompra {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .BotonEliminar:hover, .RealizarCompra:hover {
            background-color: #c82333;
            cursor: pointer;
        }
        .RealizarCompra {
            background-color: #28a745;
            margin-top: 20px;
        }
        .RealizarCompra:hover {
            background-color: #218838;
        }
        .container-boton {
            text-align: center;
            padding-bottom:5%;
        }
        .table-responsive {
            margin-top: 20px;
        }
        #TextoNoProducto {
            color: #dc3545;
            font-weight: bold; 
            font-size: 1.5em; 
            margin-top: 10%; 
            margin-bottom:10%;
        }
        .color-circle {
            display: inline-block;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 5px;
            border: 1px solid #ccc;
            margin-left:30%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Tu Carrito</h1>
        
        @if($compras->isEmpty())
            <p class="text-center" id="TextoNoProducto">No tienes productos en tu carrito.</p>
        @else
        <form action="{{ route('insertarInfoCompra') }}" method="POST" id="carrito-form">
            @csrf
            <input type="hidden" name="precioTotal" id="precio-total-input">
            <input type="hidden" name="compras" id="compras-input">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Categoría</th>
                            <th>Tipo</th>
                            <th>Color</th>
                            <th>Tamaño</th>
                            <th>Cantidad</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($compras as $compra)
                            <tr data-nombre="{{ $compra->nombre }}" data-precio="{{ $compra->precio }}" data-categoria="{{ $compra->categoria }}" data-tipo="{{ $compra->tipo }}" data-color="{{ $compra->color }}" data-tamaño="{{ $compra->tamaño }}" data-cantidad="{{ $compra->cantidad }}">
                                <td>{{ $compra->nombre }}</td>
                                <td>{{ $compra->precio }}</td>
                                <td>{{ $compra->categoria }}</td>
                                <td>{{ $compra->tipo }}</td>
                                <td>  <span class="color-circle" style="background-color: rgb({{ $compra->color }});"></span>   </td>
                                <td>{{ $compra->tamaño }}</td>
                                <td>
                                    <select name="cantidad[{{ $compra->nombre }}]" class="form-select cantidad" size="1">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}" {{ $i == $compra->cantidad ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger BotonEliminar">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-end">
                <h3>Total General: <span id="total-general">{{ $total }}</span> €</h3>
            </div>
            <div class="container-boton">
                <button type="submit" id="RealizarCompra" class="btn btn-success RealizarCompra">Comprar</button>
            </div>
        </form>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cantidadSelects = document.querySelectorAll('.cantidad');
            const totalGeneralElement = document.getElementById('total-general');
            const comprarForm = document.getElementById('carrito-form');

            cantidadSelects.forEach(select => {
                select.addEventListener('change', function(event) {
                    actualizarTotalGeneral();
                });
            });

            function actualizarTotalGeneral() {
                let totalGeneral = 0;
                document.querySelectorAll('tr[data-precio]').forEach(tr => {
                    const precio = parseFloat(tr.getAttribute('data-precio'));
                    const cantidad = parseInt(tr.querySelector('.cantidad').value);
                    totalGeneral += precio * cantidad;
                });
                totalGeneralElement.textContent = totalGeneral.toFixed(2);
                document.getElementById('precio-total-input').value = totalGeneral.toFixed(2);
            }

            document.getElementById('RealizarCompra').addEventListener('click', function(event) {
                event.preventDefault(); // Previene el envío inmediato del formulario
                agregarDatosTablaAlFormulario();
                comprarForm.submit();

              
            });

            function agregarDatosTablaAlFormulario() {
                const compras = [];
                document.querySelectorAll('tr[data-precio]').forEach(tr => {
                    const nombre = tr.getAttribute('data-nombre');
                    const precio = tr.getAttribute('data-precio');
                    const categoria = tr.getAttribute('data-categoria');
                    const tipo = tr.getAttribute('data-tipo');
                    const color = tr.getAttribute('data-color');
                    const tamaño = tr.getAttribute('data-tamaño');
                    const cantidad = tr.querySelector('.cantidad').value;

                    compras.push({
                        nombre: nombre,
                        precio: precio,
                        categoria: categoria,
                        tipo: tipo,
                        color: color,
                        tamaño: tamaño,
                        cantidad: cantidad
                    });
                });

                document.getElementById('compras-input').value = JSON.stringify(compras);

                alert("Compra Realizada");
            }

            actualizarTotalGeneral();

            document.querySelectorAll('.BotonEliminar').forEach(button => {
                button.addEventListener('click', function(event) {
                    const row = this.closest('tr');
                    const compraData = {
                        nombre: row.getAttribute('data-nombre'),
                        precio: row.getAttribute('data-precio'),
                        categoria: row.getAttribute('data-categoria'),
                        tipo: row.getAttribute('data-tipo'),
                        color: row.getAttribute('data-color'),
                        tamaño: row.getAttribute('data-tamaño'),
                        cantidad: row.querySelector('.cantidad').value
                    };
                    eliminarProducto(compraData, row);
                });
            });

            function eliminarProducto(compraData, row) {
                fetch('{{ route('eliminarCompra') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(compraData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        row.remove();
                        actualizarTotalGeneral();
                        console.log('Producto eliminado.');
                    } else {
                        console.error('Error al eliminar el producto');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    </script>
    @include('footer')
</body>
</html>
