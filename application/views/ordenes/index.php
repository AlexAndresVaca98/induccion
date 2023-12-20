<!-- HTML -->
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Gestión de Órdenes</h1>
        </div>
        <div class="col-12">
            <a href="<?php echo site_url('welcome'); ?>">Regresar al menú</a>
        </div>
        <div class="col-12 my-3">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Cliente</label>
                        <select name="" id="cliente" class="form-control">
                            <option value="">Seleccione el cliente</option>
                            <?php if ($clientes) : ?>
                                <?php foreach ($clientes as $index => $cliente) : ?>
                                    <option value="<?php echo $cliente->id; ?>"><?php echo $cliente->nombre . ' ' . $cliente->apellido; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Fecha</label>
                        <input type="date" id="fecha" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-12 text-right">
                    <button type="button" id="btn-agregar" onclick="agregarRegistro();" class="btn btn-primary">Nueva orden</button>
                </div>
            </div>
        </div>
        <div class="col-12 mb-3">
            <table class="table" id="tabla-ordenes">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<!-- HTML -->
<!-- SCRIPT -->
<script>
    async function cargarTabla() {
        table.destroy();

        await $.get('<?php echo site_url('ordenes/list'); ?>', {}, function(data) {
            let result = JSON.parse(data);
            if (result.length > 0) {
                for (let i = 0; i < result.length; i++) {
                    const orden = result[i];
                    let row = `
                    <tr>
                        <td>${orden.id}</td>
                        <td>${orden.fecha}</td>
                        <td>${orden.nombre} ${orden.apellido}</td>
                        <td>
                        <a href="<?php echo site_url('ordenes/gestionar/'); ?>${orden.id}" class="btn btn-info">
                            <i class="fa-regular fa-file-lines"></i>
                        </a>
                        <button type="button" class="btn btn-danger" onclick="eliminarRegistro(this, ${orden.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                        </td>
                    </tr>
                    `;
                    $('#tabla-ordenes tbody').prepend(row);
                }
            }
        });
        table = $('#tabla-ordenes').DataTable();
    }

    async function agregarRegistro() {
        table.destroy();
        // Recuperar datos
        let fecha = $('#fecha').val();
        let clienteId = $('#cliente option:selected').val();
        let clienteVal = $('#cliente option:selected').text();
        // Validar
        if (clienteId == '') {
            alert('Cliente requerido');
            return;
        }
        // Almacenar
        await $.post('<?php echo site_url('ordenes/create'); ?>', {
            fecha: fecha,
            cliente_id: clienteId
        }, function(data) {
            let row = `
                    <tr>
                        <td>${data}</td>
                        <td>${fecha}</td>
                        <td>${clienteVal}</td>
                        <td>
                        <a href="<?php echo site_url('ordenes/gestionar/'); ?>${data}" class="btn btn-info">
                            <i class="fa-regular fa-file-lines"></i>
                        </a>
                        <button type="button" class="btn btn-danger" onclick="eliminarRegistro(this, ${data})">
                            <i class="fas fa-trash"></i>
                        </button>
                        </td>
                    </tr>
                    `;
            $('#tabla-ordenes tbody').prepend(row);
        });
        table = $('#tabla-ordenes').DataTable();
    }

    async function eliminarRegistro(element, id) {
        table.destroy();
        // Envio a eliminar
        await $.post(`<?php echo site_url('ordenes/delete/'); ?>${id}`, {}, function(data) {
            // Si se pudo eliminar
            if (data) {
                // Elimina del front
                $(element).parents('tr').remove();
            }
        });
        table = $('#tabla-ordenes').DataTable();
    }
    
    let table = null;
    // Globales
    $(async () => {
        table = $('#tabla-ordenes').DataTable()
        await cargarTabla();

    });
</script>
<!-- SCRIPT -->