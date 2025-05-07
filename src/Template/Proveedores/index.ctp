<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Proveedore[]|\Cake\Collection\CollectionInterface $proveedores
 */
?>

<!-- Botón Nuevo Proveedor -->
<?= $this->Html->link(__('Nuevo Proveedor'), ['action' => 'add'], ['class' => 'btn btn-primary btn-lg mb-3']) ?>

<!-- Filtrado de proveedores -->
<div class="form-group">
    <input type="text" id="filtroProveedores" class="form-control" placeholder="Se puede filtrar por: Cuit / Razón Social / IVA / Dirección / Código Postal / Localidad / Provincia / Pais / Teléfono">
</div>


<!-- Card: Proveedores -->
<div class="card card-success mt-3">
    <div class="card-header">
        <h3 class="card-title"><?= __('Proveedores') ?></h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table id="tablaProveedores" class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('cuit') ?></th>
                    <th><?= $this->Paginator->sort('Razón Social') ?></th>
                    <th><?= $this->Paginator->sort('iva_condicion_id', 'IVA') ?></th>
                    <th><?= $this->Paginator->sort('Dirección') ?></th>
                    <th><?= $this->Paginator->sort('CP') ?></th>
                    <th><?= $this->Paginator->sort('Localidad') ?></th>
                    <th><?= $this->Paginator->sort('Provincia_id') ?></th>
                    <th><?= $this->Paginator->sort('pais_id') ?></th>
                    <th><?= $this->Paginator->sort('Teléfono') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proveedores as $proveedore): ?>
                <tr>
                    <td><?= $this->Number->format($proveedore->id) ?></td>
                    <td><?= h($proveedore->cuit) ?></td>
                    <td><?= h($proveedore->razon_social) ?></td>
                    <td>
                        <?php 
                        if ($proveedore->has('iva_condicion')) {
                            echo h($proveedore->iva_condicion->descripcion);
                        } else {
                            echo 'No Definido';
                        }
                        ?>
                    </td>
                    <td><?= h($proveedore->direccion) ?></td>
                    <td><?= h($proveedore->cp) ?></td>
                    <td><?= h($proveedore->localidad) ?></td>
                    <td><?= $proveedore->has('provincia') ? h($proveedore->provincia->nombre) : '' ?></td>
                    <td><?= $proveedore->has('paise') ? h($proveedore->paise->nombre) : '' ?></td>
                    <td><?= h($proveedore->telefono) ?></td>
                    <td><?= h($proveedore->created) ?></td>
                    <td><?= h($proveedore->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('<i class="fas fa-eye"></i>', ['action' => 'view', $proveedore->id], [
                            'escape' => false,
                            'class' => 'btn btn-info btn-sm',
                            'title' => 'Ver'
                        ]) ?>
                        <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $proveedore->id], [
                            'escape' => false,
                            'class' => 'btn btn-warning btn-sm mx-1',
                            'title' => 'Editar'
                        ]) ?>
                        <?= $this->Form->postLink('<i class="fas fa-trash"></i>', ['action' => 'delete', $proveedore->id], [
                            'escape' => false,
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Eliminar',
                            'confirm' => __('¿Estás seguro que querés eliminar al proveedor #{0}?', $proveedore->id)
                        ]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="card-footer clearfix">
        <div class="float-left">
            <?= $this->Paginator->counter([
                'format' => __('Página {{page}} de {{pages}}, mostrando {{current}} registro(s) de {{count}} total')
            ]) ?>
        </div>
        <div class="float-right">
            <ul class="pagination pagination-sm m-0">
                <?= $this->Paginator->first('«') ?>
                <?= $this->Paginator->prev('‹') ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next('›') ?>
                <?= $this->Paginator->last('»') ?>
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
        const input = document.getElementById('filtroProveedores');
        const table = document.getElementById('tablaProveedores');
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
                const cuit = normalizeText(row.cells[1].textContent);
                const razonSocial = normalizeText(row.cells[2].textContent);
                const iva = normalizeText(row.cells[3].textContent);

                console.log('Texto en celda IVA:', iva);

                const direccion = normalizeText(row.cells[4].textContent);
                const cp = normalizeText(row.cells[5].textContent);
                const localidad = normalizeText(row.cells[6].textContent);
                const provincia = normalizeText(row.cells[7].textContent);
                const pais = normalizeText(row.cells[8].textContent);
                const telefono = normalizeText(row.cells[9].textContent);

                // Verificar coincidencia en cualquier campo
                const coincide = 
                    id.includes(filtro) ||
                    cuit.includes(filtro) ||
                    razonSocial.includes(filtro) ||
                    iva.includes(filtro) ||
                    direccion.includes(filtro) ||
                    cp.includes(filtro) ||
                    localidad.includes(filtro) ||
                    provincia.includes(filtro) ||
                    pais.includes(filtro) ||
                    telefono.includes(filtro);

                row.style.display = coincide ? '' : 'none';
            });
        });
    });
</script>