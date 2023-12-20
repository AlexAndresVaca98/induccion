<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Editar cliente</h1>
        </div>
        <div class="col-12">
            <a class="btn btn-link " href="<?php echo site_url('clientes/index'); ?>" role="button"> <- Regresar</a>
        </div>
        <div class="col-12 col-md-8 mx-auto">
            <form action="<?php echo site_url('clientes/update/') . $cliente->id; ?>" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombres</label>
                    <input id="nombre" name="nombre" class="form-control" type="text" placeholder="Ingrese el nombre" required value="<?php echo $cliente->nombre; ?>">
                </div>
                <div class="form-group">
                    <label for="apellido">Apellidos</label>
                    <input id="apellido" name="apellido" class="form-control" type="text" placeholder="Ingrese el apellido" required value="<?php echo $cliente->apellido; ?>">
                </div>
                <div class="form-group">
                    <label for="identificacion">Identificación</label>
                    <input id="identificacion" name="identificacion" class="form-control" type="text" placeholder="Ingrese el identificación" required value="<?php echo $cliente->identificacion; ?>">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input id="direccion" name="direccion" class="form-control" type="text" placeholder="Ingrese el dirección" value="<?php echo $cliente->direccion; ?>">
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input id="telefono" name="telefono" class="form-control" type="text" placeholder="Ingrese el teléfono" value="<?php echo $cliente->telefono; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" class="form-control" type="email" placeholder="Ingrese el email" value="<?php echo $cliente->email; ?>">
                </div>
                <div class="form-group text-right">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>