<!-- Botón Nueva Órden de Compra -->
<?= $this->Html->link(__('Nueva Orden de Compra'), ['action' => 'add'], ['class' => 'btn btn-primary btn-lg mb-3']) ?>

<!-- Filtrado para las Ordenes de Compras -->
<div class="form-group">
    <input type="text" id="filtroOrdenesCompras" class="form-control" placeholder="Se puede filtrar por: id/ Proveedor / Fecha de Emisión / Fecha de Vencimiento / Forma de Pago / Forma de Envío / Moneda / Estado / Total Orden de Compra / Created / Modified">
</div>

<div class="card">
    <div class="card-body table-responsive p-0">
        <table id="tablaOrdenesCompras" class="table table-striped table-hover table-bordered mb-0">
            <thead class="thead-dark">
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('proveedor_id', 'Proveedor') ?></th>
                    <th><?= __('Localidad y Provincia') ?></th>
                    <th><?= $this->Paginator->sort('fecha_emision') ?></th>
                    <th><?= $this->Paginator->sort('fecha_vencimiento') ?></th>
                    <th><?= $this->Paginator->sort('forma_pago') ?></th>
                    <th><?= $this->Paginator->sort('forma_envio') ?></th>
                    <th><?= $this->Paginator->sort('moneda_id', 'Moneda') ?></th>
                    <th><?= $this->Paginator->sort('estado') ?></th>
                    <th><?= $this->Paginator->sort('total_orden_compra') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="text-center"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ordenCompra as $orden): ?>
                <tr>
                    <td><?= $this->Number->format($orden->id) ?></td>
                    <td><?= $orden->has('proveedore') ? h($orden->proveedore->razon_social) : '' ?></td>
                    <td>
                        <?php
                            if ($orden->has('proveedore')) {
                                $localidad = h($orden->proveedore->localidad);
                                $provincia = $orden->proveedore->provincia ? h($orden->proveedore->provincia->nombre) : '';
                                echo $localidad . ' - ' . $provincia;
                            }
                        ?>
                    </td>
                    <td><?= h($orden->fecha_emision) ?></td>
                    <td><?= h($orden->fecha_vencimiento) ?></td>
                    <td><?= h($orden->forma_pago) ?></td>
                    <td><?= h($orden->forma_envio) ?></td>
                    <td><?= $orden->has('tipo_moneda') ? h($orden->tipo_moneda->codigo) : '' ?></td>
                    <td>
                        <?php
                            $estadoClass = 'secondary';
                            if ($orden->estado === 'Aprobada') {
                                $estadoClass = 'success';
                            } elseif ($orden->estado === 'Anulada') {
                                $estadoClass = 'danger';
                            }
                            echo "<span class='badge badge-$estadoClass'>" . h($orden->estado) . "</span>";
                        ?>
                    </td>

                    <td>
                        <?= $orden->has('tipo_moneda') 
                            ? h($orden->tipo_moneda->simbolo) . ' ' . $this->Number->format($orden->total_orden_compra) 
                            : $this->Number->format($orden->total_orden_compra) ?>
                    </td>


                    <td><?= h($orden->created) ?></td>
                    <td><?= h($orden->modified) ?></td>

                    <td class="text-center">
                        <!-- Botón Ver Orden Compra -->
                        <?= $this->Html->link('<i class="fas fa-eye"></i>', ['action' => 'view', $orden->id], [
                            'class' => 'btn btn-outline-info btn-sm',
                            'escape' => false,
                            'title' => 'Ver'
                        ]) ?>

                        <!-- Botón Anular -->
                        <?php if ($orden->estado !== 'Anulado'): ?>
                            <?= $this->Form->postLink(
                                '<i class="fas fa-ban"></i>',
                                ['action' => 'anular', $orden->id],
                                [
                                    'class' => 'btn btn-outline-warning btn-sm',
                                    'escape' => false,
                                    'confirm' => __('¿Anular la Orden de Compra # {0}?', $orden->id),
                                    'title' => 'Anular'
                                ]
                            ) ?>
                        <?php endif; ?>

                        

                        <!-- Botón Eliminar -->
                        <?= $this->Form->postLink('<i class="fas fa-trash-alt"></i>', ['action' => 'delete', $orden->id], [
                            'class' => 'btn btn-outline-danger btn-sm',
                            'escape' => false,
                            'confirm' => __('¿Estás seguro de eliminar la orden #{0}?', $orden->id),
                            'title' => 'Eliminar'
                        ]) ?>

                        <!-- Botón Generar PDF -->
                        <?= $this->Html->link('<i class="fas fa-file-pdf"></i>',
                            ['action' => 'generarPdf', $orden->id, '_ext' => 'pdf'],
                            ['escape' => false, 'class' => 'btn btn-outline-success', 'title' => 'Generar PDF']
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-left">
            <p><?= $this->Paginator->counter(['format' => 'Página {{page}} de {{pages}}, mostrando {{current}} registro(s) de {{count}}']) ?></p>
        </div>
        <div class="float-right">
            <ul class="pagination pagination-sm m-0">
                <?= $this->Paginator->first('<<') ?>
                <?= $this->Paginator->prev('<') ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next('>') ?>
                <?= $this->Paginator->last('>>') ?>
            </ul>
        </div>
    </div>
</div>

<!--  script para el filtrado de la tabla  -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        /*
        console.log("Prueba básica");
        alert("Script cargado"); // Debe mostrarse al recargar
        */
        const input = document.getElementById('filtroOrdenesCompras');
        const table = document.getElementById('tablaOrdenesCompras');
        const rows = table.querySelectorAll('tbody tr');

        // Función para normalizar textos (elimina acentos y espacios)
        const normalizeText = (text) => {
            return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase().trim();
        };

        input.addEventListener('input', function () {
            const filtro = normalizeText(this.value);

            console.log('Texto buscado (filtro):', filtro); 

            rows.forEach(row => {
                // Obtener el texto de cada celda (ajustado a tu estructura actual)
                const id = normalizeText(row.cells[0].textContent);
                const proveedor = normalizeText(row.cells[1].textContent);
                const fechaEmision = normalizeText(row.cells[2].textContent);
                const fechaVencimiento = normalizeText(row.cells[3].textContent);
                const formaPago = normalizeText(row.cells[5].textContent);
                const formaEnvio = normalizeText(row.cells[6].textContent);
                const moneda = normalizeText(row.cells[7].textContent);
                const estado = normalizeText(row.cells[8].textContent);
                const totalOrdenCompra = normalizeText(row.cells[9].textContent);
                const created = normalizeText(row.cells[10].textContent);
                const modified = normalizeText(row.cells[11].textContent);

                // Verificar coincidencia en cualquier campo
                const coincide = 
                    id.includes(filtro) ||
                    proveedor.includes(filtro) ||
                    fechaEmision.includes(filtro) ||
                    fechaVencimiento.includes(filtro) ||
                    formaPago.includes(filtro) ||
                    formaEnvio.includes(filtro) ||
                    moneda.includes(filtro) ||
                    estado.includes(filtro) ||
                    totalOrdenCompra.includes(filtro) ||
                    created.includes(filtro) ||
                    modified.includes(filtro);

                row.style.display = coincide ? '' : 'none';
            });
        });
    });
</script>