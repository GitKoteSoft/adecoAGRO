<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrdenCompra $ordenCompra
 */
?>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-3">
        <div class="card card-primary">
          <div class="card-header">
              <h3 class="card-title"><?= __('Acciones') ?></h3>
          </div>
          <div class="card-body">
            <ul class="nav flex-column">
              <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $ordenCompra->id], ['confirm' => __('¿Estás seguro de que deseas eliminar la Orden de Compra Nº #{0}?', $ordenCompra->id), 'class' => 'btn btn-danger']) ?>
              <?= $this->Html->link(__('Lista de Ordenes de Compra'), ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
              <?= $this->Html->link(__('Nueva Orden de Compra'), ['action' => 'add'], ['class' => 'btn btn-success']) ?>
            </ul>
          </div>
        </div>
      </div>

      <!-- Detalles de la orden -->
      <div class="col-md-9">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Orden de Compra #<?= h($ordenCompra->id) ?></h3>
          </div>
          <div class="card-body">

            <table class="table table-bordered table-striped">
              <tbody>
                <tr>
                  <th><?= __('Proveedor') ?></th>
                  <td><?= $ordenCompra->has('proveedore') ? $this->Html->link($ordenCompra->proveedore->nombre ?? $ordenCompra->proveedore->id, ['controller' => 'Proveedores', 'action' => 'view', $ordenCompra->proveedore->id]) : '' ?></td>
                </tr>
                <tr>
                  <th><?= __('Forma de Pago') ?></th>
                  <td><?= h($ordenCompra->forma_pago) ?></td>
                </tr>
                <tr>
                  <th><?= __('Forma de Envío') ?></th>
                  <td><?= h($ordenCompra->forma_envio) ?></td>
                </tr>
                <tr>
                  <th><?= __('Tipo de Moneda') ?></th>
                  <td><?= $ordenCompra->has('tipo_moneda') ? h($ordenCompra->tipo_moneda->nombre ?? $ordenCompra->tipo_moneda->id) : '' ?></td>

                </tr>
                <tr>
                  <th><?= __('Estado') ?></th>
                  <td>
                    <?php
                      $estadoClass = 'danger';
                      if ($ordenCompra->estado === 'Aprobada') {
                          $estadoClass = 'success';
                      } elseif ($ordenCompra->estado === 'Anulado') {
                          $estadoClass = 'danger';
                      }
                      echo "<span class='badge badge-$estadoClass'>" . h($ordenCompra->estado) . "</span>";
                    ?>
                  </td>
                </tr>
                <tr>
                  <th><?= __('Total Orden de Compra') ?></th>
                  <td>$ <?= $this->Number->format($ordenCompra->total_orden_compra) ?></td>
                </tr>
                <tr>
                  <th><?= __('Fecha de Emisión') ?></th>
                  <td><?= h($ordenCompra->fecha_emision) ?></td>
                </tr>
                <tr>
                  <th><?= __('Fecha de Vencimiento') ?></th>
                  <td><?= h($ordenCompra->fecha_vencimiento) ?></td>
                </tr>
                <tr>
                  <th><?= __('Creado') ?></th>
                  <td><?= h($ordenCompra->created) ?></td>
                </tr>
                <tr>
                  <th><?= __('Modificado') ?></th>
                  <td><?= h($ordenCompra->modified) ?></td>
                </tr>
              </tbody>
            </table>

            <!-- Observaciones -->
            <?php if (!empty($ordenCompra->observaciones)): ?>
            <div class="mt-4">
              <h5><?= __('Observaciones') ?></h5>
              <div class="border rounded p-3 bg-light">
                <?= $this->Text->autoParagraph(h($ordenCompra->observaciones)) ?>
              </div>
            </div>
            <?php endif; ?>

            <!-- Card - Orden Detalles -->
            <?php if (!empty($ordenCompra->orden_detalles)): ?>
              <div class="card card-info mt-4">
                <div class="card-header">
                  <h3 class="card-title"><?= __('Items de la Orden de Compra') ?></h3>
                </div>
                <div class="card-body p-0">
                  <table class="table table-sm table-striped mb-0">
                    <thead>
                      <tr>
                        <th><?= __('Item') ?></th>
                        <th><?= __('Descripción') ?></th>
                        <th><?= __('Cantidad') ?></th>
                        <th><?= __('P. Unitario') ?></th>
                        <th><?= __('Bonificación %') ?></th>
                        <th><?= __('Subt. sin IVA') ?></th>
                        <th><?= __('IVA %') ?></th>
                        <th><?= __('Subt. c/ IVA') ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($ordenCompra->orden_detalles as $i => $det): ?>
                        <tr>
                          <td class="text-center"><?= $i + 1 ?></td>
                          <td><?= h($det->descripcion_producto) ?></td>
                          <td><?= $this->Number->format($det->cantidad) ?></td>
                          <td><?= h($ordenCompra->tipo_moneda->simbolo) . ' ' . $this->Number->format($det->precio_unitario) ?></td>
                          <td><?= $this->Number->format($det->bonificacion) ?>%</td>
                          <td><?= h($ordenCompra->tipo_moneda->simbolo) . ' ' . $this->Number->format($det->subtotal_sin_iva) ?></td>
                          <td><?= $this->Number->format($det->iva) ?>%</td>
                          <td><?= h($ordenCompra->tipo_moneda->simbolo) . ' ' . $this->Number->format($det->subtotal_con_iva) ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            <?php endif; ?>

          </div>
              
        </div>
        
      </div>
    </div>
  </div>
</section>
