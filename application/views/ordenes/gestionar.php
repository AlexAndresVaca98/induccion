<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Gestionar Orden <small style="font-size: 12px;">id: <?php echo $orden->id; ?></small></h1>
        </div>
        <div class="col-12">
            <a href="<?php echo site_url('ordenes/index'); ?>">
                < Regresar </a>
        </div>
        <div class="col-12">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Cliente</label>
                        <select name="" id="cliente" class="form-control">
                            <option value="">Seleccione el cliente</option>
                            <?php if ($clientes) : ?>
                                <?php foreach ($clientes as $index => $cliente) : ?>
                                    <option <?php echo $cliente->id == $orden->cliente_id ? 'selected' : ''; ?> value="<?php echo $cliente->id; ?>"><?php echo $cliente->nombre . ' ' . $cliente->apellido; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Fecha</label>
                        <input type="date" id="fecha" class="form-control" value="<?php echo $orden->fecha; ?>">
                    </div>
                </div>
                <div class="col-12 text-right mb-4">
                    <button type="button" id="btn-agregar" onclick="actualizarRegistro();" class="btn btn-primary">Actualizar</button>
                </div>
                <div class="col-12 mb-3">
                    <h3>Agregar producto</h3>
                    <div class="row align-items-end">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Producto</label>
                                <select name="" id="producto" class="form-control">
                                    <option value="">Seleccione un producto</option>
                                    <?php if ($productos) : ?>
                                        <?php foreach ($productos as $index => $producto) : ?>
                                            <option data-valor="<?php echo $producto->valor; ?>" value="<?php echo $producto->id; ?>"><?php echo $producto->detalle; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Cantidad</label>
                                <input type="number" id="cantidad" class="form-control" value="1" min="1">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <button type="button" class="btn btn-warning" onclick="agregarDetalle()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <h3>Lista de productos</h3>
                </div>
                <div class="col-12">
                    <table class="table" id="tabla-detalle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Valor U</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="col-12">
                    <h4 class="text-right">Total: $<span id="total-orden">0.00</span></h4>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function actualizarRegistro() {
        // Recuperacion de datos
        let cliente_id = $('#cliente').val();
        let fecha = $('#fecha').val();

        // Validacion 
        if (!cliente_id) {
            alert('El cliente es requerido');
            return;
        }

        // Envío de la información
        $.post('<?php echo site_url('ordenes/update/') . $orden->id; ?>', {
            clienteId: cliente_id,
            fecha: fecha,
        }, function(data) {
            console.log(data);
        });
    }

    function agregarDetalle() {
        // Recupera valores
        let productId = $('#producto option:selected').val();
        let productNombre = $('#producto option:selected').text();
        // Recuperar metadata
        let valor = $('#producto option:selected').data('valor');
        let cantidad = $('#cantidad').val();

        let total = parseFloat(valor) * parseInt(cantidad);

        // Validacion
        if (!productId) {
            alert('Producto requerido');
            return;
        }
        if (!cantidad || parseInt(cantidad) <= 0) {
            alert('Cantidad invalida');
            return;
        }
        // Envio de la data
        $.post('<?php echo site_url('detallesOrdenes/create'); ?>', {
            ordenId: '<?php echo $orden->id; ?>',
            productoId: productId,
            cantidad: cantidad,
        }, function(data) {
            // Actualizar tabla
            $('#tabla-detalle tbody').prepend(`
            <tr>
                <td>${data}</td>
                <td>${productNombre}</td>
                <td>X ${cantidad}</td>
                <td>$ ${valor}</td>
                <td>$ ${total}</td>
                <td>
                    <button class="btn btn-danger" onclick="eliminarDetalle(this, ${data})">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            `);
            obtenerTotal();
        });
    }

    function eliminarDetalle(ele, id) {
        // Enviar a eliminar
        $.post('<?php echo site_url('detallesOrdenes/delete'); ?>', {
            id: id,
            ordenId: '<?php echo $orden->id; ?>'
        }, function(data) {
            // Eliminamos la fila
            $(ele).parents('tr').remove();
            obtenerTotal();
        })
    }

    function cargarDetalles() {
        $.get('<?php echo site_url('detallesOrdenes/list/') . $orden->id; ?>', {}, function(data) {
            let response = JSON.parse(data);
            if (response.length > 0) {
                for (let i = 0; i < response.length; i++) {
                    const element = response[i];
                    $('#tabla-detalle tbody').prepend(`
                    <tr>
                        <td>${element.id}</td>
                        <td>${element.detalle}</td>
                        <td>X ${element.cantidad}</td>
                        <td>$ ${element.valor}</td>
                        <td>$ ${element.total}</td>
                        <td>
                            <button class="btn btn-danger" onclick="eliminarDetalle(this, ${element.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    `);
                }
            }

        });
    }

    function obtenerTotal() {
        $.get('<?php echo site_url('ordenes/obtenerTotal/') . $orden->id; ?>', {}, function(data) {
            $('#total-orden').text(data);
        });
    }

    $(() => {
        cargarDetalles();
        obtenerTotal();
    });
</script>