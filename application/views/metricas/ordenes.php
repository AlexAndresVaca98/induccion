<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Métricas de Órdenes</h1>
        </div>
        <div class="col-6 mb-4">
            <div>Gráfico de barras</div>
            <div class="d-flex justify-content-center" style="position: relative; max-height:50vh;">
                <canvas id="graficoBarras"></canvas>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div>Gráfico de pastel</div>
            <div class="d-flex justify-content-center" style="position: relative; max-height:50vh;">
                <canvas id="graficoPastel"></canvas>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div>Tabla</div>
            <table class="table" id="tabla-usuarios">
                <thead>
                    <tr>
                        <th>Num de ventas</th>
                        <th>Producto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($productosMasVendidos) : ?>
                        <?php foreach ($productosMasVendidos as $index => $producto) : ?>
                            <tr>
                                <td><?php echo $producto->numero_ventas; ?></td>
                                <td><?php echo $producto->detalle; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function crearGraficoBarra() {
        // Recuperar el elemento
        const ctx = document.getElementById('graficoBarras');
        // Crear el gráfico
        // Crear la data
        let labels = [];
        <?php if ($labelsBarras) : ?>
            <?php foreach ($labelsBarras as $index => $label) : ?>
                // JS
                labels.push('<?php echo $label; ?>');

            <?php endforeach; ?>
        <?php endif; ?>

        let valuesData = [];
        <?php if ($valuesData) : ?>
            <?php foreach ($valuesData as $index => $valueData) : ?>
                // JS 
                valuesData.push('<?php echo $valueData; ?>');
            <?php endforeach; ?>
        <?php endif; ?>

        let data = {
            labels: labels, // Eje horizontal (EJE X)
            datasets: [{
                label: 'Ventas Ventas mensuales 2023', // Descripcion
                data: valuesData, // Eje vertical (EJE Y)
            }]
        };
        // Crear Opciones
        let options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };
        // Crear configuracion 
        let config = {
            type: 'bar', // Tipo de grafico
            data: data, // Grupo de informacion
            options: options // Opciones
        };

        let grafico = new Chart(ctx, config);
    }

    function crearGraficoPastel() {
        // Recuperar el elemento
        const ctx = document.getElementById('graficoPastel');
        let labels = [];
        <?php if ($labelsPastel) : ?>
            <?php foreach ($labelsPastel as $index => $label) : ?>
                labels.push('<?php echo $label; ?>');
            <?php endforeach; ?>
        <?php endif; ?>

        let valuesData = [];
        <?php if ($valuesPastel) : ?>
            <?php foreach ($valuesPastel as $index => $valueData) : ?>
                valuesData.push('<?php echo $valueData; ?>');
            <?php endforeach; ?>
        <?php endif; ?>
        // Creo la data
        let data = {
            labels: labels,
            datasets: [{
                label: 'Número de compras',
                data: valuesData,
            }]
        };
        // Creamos las opciones
        let options = {};
        // Crear el gráfico
        let grafico = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });
    }

    function crearTabla() {
        let table = new DataTable('#tabla-usuarios', {
            order: [
                [0, 'desc']
            ]
        });
        // $('#tabla-usuarios').DataTable();
    }

    $(() => {
        crearGraficoBarra();
        crearGraficoPastel();
        crearTabla();
    })
</script>