<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Panel de clientes</h1>
        </div>
        <div class="col-12 col-md-6">
            <a class="btn btn-link" href="<?php echo site_url('welcome'); ?>" role="button">Ir a menú</a>
        </div>
        <div class="col-12 col-md-6 text-right">
            <a class="btn btn-primary" href="<?php echo site_url('clientes/add'); ?>" role="button">Nuevo cliente</a>
        </div>
        <div class="col-12 mt-4">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Identificacion</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($clientes) : ?>
                            <?php foreach ($clientes as $index => $cliente) : ?>
                                <tr>
                                    <td><?php echo $cliente->id; ?></td>
                                    <td><?php echo $cliente->nombre; ?></td>
                                    <td><?php echo $cliente->apellido; ?></td>
                                    <td><?php echo $cliente->identificacion; ?></td>
                                    <td>
                                        <a class="btn btn-info" 
                                            href="<?php echo site_url('clientes/edit/') . $cliente->id; ?>">
                                            Editar
                                        </a>
                                        <a class="btn btn-danger" 
                                            href="<?php echo site_url('clientes/delete/') . $cliente->id; ?>">
                                            Eliminar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>