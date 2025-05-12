<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrdenCompra $ordenCompra
 */
?>

<section class="content">
  <div class="container-fluid">

    <!-- Inicio del Formulario Orden Compra que tambien incluye al Orden Detalles -->
    <?= $this->Form->create($ordenCompra) ?>

      <!-- Card 1: Datos de la Orden de Compra -->
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title"><?= __('Nueva Orden de Compra Nº') ?> <strong><?= h($numeroOC) ?></strong></h3>
        </div>

        <div class="card-body">

          <div class="row">
            <!-- Select de Proveedor mostrando razon social -->
            <div class="form-group col-md-6">
              <?= $this->Form->control('proveedor_id', [
                  'type' => 'select',
                  'options' => $proveedores,                // listado de proveedores
                  'class' => 'form-control',
                  'label' => 'Proveedor',
                  'empty' => 'Seleccione el Proveedor'      // placeholder
              ]) ?>
            </div>
            <!-- Select de Moneda mostrando símbolo y divisa -->
            <div class="form-group col-md-3">
              <?= $this->Form->control('moneda_id', [
                  'label' => 'Tipo de moneda',
                  'options' => $tipoMoneda,
                  'empty' => 'Seleccioná una opción',
                  'class' => 'form-control'
              ]) ?>
            </div>
          </div>

          <div class="row">
            <!-- Observaciones -->
            <div class="form-group col-md-12">
              <?= $this->Form->control('observaciones', [
                  'type' => 'textarea',
                  'class' => 'form-control',
                  'label' => 'Observaciones',
                  'rows'    => 9,
                  'value' => "El pago del producto se realizará mediante transferencia bancaria en pesos argentinos, de acuerdo a facturación previamente enviada, por lo que se solicita factura 'A' para realizar dicha transferencia a:\n\n- Razón Social: ADECO AGROPECUARIA S.A\n- CUIT: 30-61870567-2\n- Condición IVA: Responsable Inscripto.\n- Domicilio: Molino Mercedes Adeco, Mercedes, Corrientes.\n- Código Postal: 3470.\n\nAdemás, se solicitan datos bancarios para efectuar el pago por dichos productos."
              ]) ?>
            </div>
          </div>

          <div class="row">
            <!-- Forma de Pago -->
            <div class="form-group col-md-4">
              <?= $this->Form->control('forma_pago', [
                  'class' => 'form-control',
                  'label' => 'Forma de Pago'
              ]) ?>
            </div>
            <!-- Forma de Envío -->
            <div class="form-group col-md-4 offset-md-4">
              <?= $this->Form->control('forma_envio', [
                  'class' => 'form-control',
                  'label' => 'Forma de Envío'
              ]) ?>
            </div>
          </div>

          <div class="row">
            <!-- FEcha de Emisión -->
            <div class="form-group col-md-4">
              <?= $this->Form->control('fecha_emision', [
                  'class' => 'form-control',
                  'label' => 'Fecha de Emisión'
              ]) ?>
            </div>
            <!-- Validez de la Orden de Compra -->
            <div class="form-group col-md-4 offset-md-4">
              <?= $this->Form->control('fecha_vencimiento', [
                  'empty' => true,
                  'class' => 'form-control',
                  'label' => 'Validez de la Orden de Compra'
              ]) ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 2: Detalles de la Orden de Compra -->
      <div class="card card-info">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4 class="card-title mb-0"><?= __('Orden de Compra - Detalles') ?></h4>

          <!-- Botón Nuevo Detalle -->
          <button id="btnNuevoDetalle" type="button" class="btn btn-warning btn-sm">
            <i class="fas fa-plus"></i> <?= __('Nuevo Detalle') ?>
          </button>
        </div>

        <div class="card-body p-0">
          <!-- Tabla Orden de Compra - Detalles -->
          <table id="tablaOrdenCompraDetalles" class="table table-striped table-hover table-bordered mb-0">
            <thead class="thead-dark">
              <tr>
                <th><?= __('Item') ?></th>
                <th><?= __('Descripción del Producto') ?></th>
                <th><?= __('Cantidad') ?></th>
                <th><?= __('Precio Unitario') ?></th>
                <th><?= __('Bonificación %') ?></th>
                <th><?= __('Subtotal') ?></th>
                <th><?= __('IVA') ?></th>
                <th><?= __('Subtotal con IVA') ?></th>
                <th class="text-center"><?= __('Acciones') ?></th>
              </tr>
            </thead>
            <tbody>
              <!-- acá se van a ir insertando las filas dinamicamente a través de los scipts -->
            </tbody>
          </table>
          
          <div class="card">
            <!-- Todo está calculado con scripts -->
            <div class="row">
              <div class="col-md-5 text-right"><strong><?= __('Importe Neto Gravado') ?>:</strong></div>
              <div class="col-md-6 text-right"><strong><span id="netoGravado">$ 0</span></strong></div>
            </div>
            <div class="row">
              <div class="col-md-5 text-right"><strong><?= __('IVA') ?>:</strong></div>
              <div class="col-md-6 text-right"><strong><span id="totalIva">$ 0</span></strong></div>
            </div>
            <div class="row">
              <div class="col-md-5 text-right"><strong><?= __('TOTAL Orden de Compra') ?>:</strong></div>
              <div class="col-md-6 text-right"><strong><span id="totalOrdenCompra">$ 0</span></strong></div>
            </div>
          </div>
        </div>
      </div>
        
      <!-- Botón - Guardar o Cancelar la Orden de Compra -->
      <div class="card-footer text-center">
          <?= $this->Form->button(__('Guardar Orden de Compra'), ['class' => 'btn btn-success']) ?>
          <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
      </div>

    <?= $this->Form->end() ?>
  </div>
</section>




<!--  Scripts para manejar los detalles -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    let numItem = 0;

    // Añadir fila al pulsar "Nuevo Detalle"
    document.getElementById('btnNuevoDetalle').addEventListener('click', () => {
      numItem++;
      const tbody = document.querySelector('#tablaOrdenCompraDetalles tbody');
      const tr = document.createElement('tr');

      tr.innerHTML = `
        <td class="text-center">${numItem}</td>
        <td><input type="text" name="orden_detalles[${numItem}][descripcion_producto]" class="form-control"/></td>
        <td><input type="number" step="0.01" name="orden_detalles[${numItem}][cantidad]" class="form-control cantidad" value="0.1"/></td>
        <td><input type="number" step="0.01" name="orden_detalles[${numItem}][precio_unitario]" class="form-control precio"/></td>
        <td><input type="number" step="0.01" name="orden_detalles[${numItem}][bonificacion]" class="form-control bono"/></td>
        <td class="subtotal">$ 0</td>
        <td><input type="number" step="0.01" name="orden_detalles[${numItem}][iva]" class="form-control iva" value="21"/></td>
        <td class="subtotalIva">$ 0</td>

        <td class="text-center">
          <button type="button" class="btn btn-danger btn-sm btn-del"><i class="fas fa-trash"></i></button>
        </td>
      `;

      tbody.appendChild(tr);
      actualizarEventos();
    });

    function actualizarEventos() {
      document.querySelectorAll('#tablaOrdenCompraDetalles .cantidad, .precio, .bono, .iva')
        .forEach(input => input.addEventListener('input', recalcularFila));
      document.querySelectorAll('#tablaOrdenCompraDetalles .btn-del')
        .forEach(btn => btn.addEventListener('click', e => {
          e.target.closest('tr').remove();
          recalcularTotales();
        }));
    }

    function recalcularFila(e) {
      const row = e.target.closest('tr');
      const cantidad = parseFloat(row.querySelector('.cantidad').value) || 0;
      const precio = parseFloat(row.querySelector('.precio').value) || 0;
      const boni = parseFloat(row.querySelector('.bono').value) / 100 || 0;
      const subtotal = cantidad * precio * (1 - boni);
      row.querySelector('.subtotal').textContent = `$ ${subtotal.toFixed(2)}`;
      const ivaPct = parseFloat(row.querySelector('.iva').value) || 0;
      const subIva = subtotal * (1 + ivaPct / 100);
      row.querySelector('.subtotalIva').textContent = `$ ${subIva.toFixed(2)}`;
      recalcularTotales();
    }

    function recalcularTotales() {
      let totalNeto = 0, totalIva = 0;
      document.querySelectorAll('#tablaOrdenCompraDetalles tbody tr').forEach(row => {
        const sub = parseFloat(row.querySelector('.subtotal').textContent.replace(/[^0-9.-]+/g,"")) || 0;
        const subIva = parseFloat(row.querySelector('.subtotalIva').textContent.replace(/[^0-9.-]+/g,"")) || 0;
        totalNeto += sub;
        totalIva += (subIva - sub);
      });
      document.getElementById('netoGravado').textContent = `$ ${totalNeto.toFixed(2)}`;
      document.getElementById('totalIva').textContent   = `$ ${totalIva.toFixed(2)}`;
      document.getElementById('totalOrdenCompra').textContent  = `$ ${(totalNeto + totalIva).toFixed(2)}`;
    }
  });
</script>
