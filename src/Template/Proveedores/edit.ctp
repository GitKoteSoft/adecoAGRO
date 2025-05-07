<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Proveedore $proveedore
 */
?>

<section class="content">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><?= __('Acciones') ?></h3>
                </div>
                <div class="card-body">
                    <ul class="nav flex-column">
                        <?= $this->Form->postLink(__('Eliminar Proveedor'), ['action' => 'delete', $proveedore->id], ['class' => 'btn btn-danger btn-block mb-2','confirm' => __('¿Está seguro de eliminar este proveedor? # {0}', $proveedore->id)]) ?>
                        <?= $this->Html->link(__('Lista de Proveedores'), ['action' => 'index'], ['class' => 'btn btn-info btn-block mb-2']) ?>
                        <?= $this->Html->link(__('Nuevo Proveedor'), ['action' => 'add'], ['class' => 'btn btn-primary btn-block mb-2']) ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Formulario principal -->
        <div class="col-md-9">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title"><?= __('Editar Proveedor') ?>: <?= h($proveedore->razon_social) ?></h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($proveedore, ['class' => 'form-horizontal']) ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <?= $this->Form->control('cuit', [
                                'class' => 'form-control',
                                'label' => 'CUIT <span class="text-danger">*</span>',
                                'id' => 'cuit-input',
                                'required' => true,
                                'escape' => false,
                                'templateVars' => [
                                    'help' => 'Formato: 30-12345678-1'
                                ]
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->Form->control('razon_social', [
                                'class' => 'form-control',
                                'label' => 'Razón Social <span class="text-danger">*</span>',
                                'required' => true,
                                'escape' => false
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $this->Form->control('iva_condicion_id', [
                                'class' => 'form-control select2',
                                'label' => 'Condición de IVA <span class="text-danger">*</span>',
                                'options' => $ivaCondiciones,
                                'empty' => 'Seleccione una opción',
                                'required' => true,
                                'escape' => false
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->Form->control('telefono', [
                                'class' => 'form-control',
                                'label' => 'Teléfono'
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <?= $this->Form->control('direccion', [
                                'class' => 'form-control',
                                'label' => 'Dirección <span class="text-danger">*</span>',
                                'required' => true,
                                'escape' => false
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $this->Form->control('cp', [
                                'class' => 'form-control',
                                'label' => 'Código Postal <span class="text-danger">*</span>',
                                'required' => true,
                                'escape' => false
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <?= $this->Form->control('pais_id', [
                                'class' => 'form-control select2',
                                'label' => 'País <span class="text-danger">*</span>',
                                'id' => 'pais-id',
                                'options' => $paises,
                                'empty' => 'Seleccione un país',
                                'required' => true,
                                'escape' => false
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $this->Form->control('provincia_id', [
                                'class' => 'form-control select2',
                                'label' => 'Provincia <span class="text-danger">*</span>',
                                'id' => 'provincia-id',
                                'options' => $provincias,
                                'empty' => 'Seleccione provincia',
                                'required' => true,
                                'escape' => false
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $this->Form->control('localidad', [
                                'class' => 'form-control',
                                'label' => 'Localidad <span class="text-danger">*</span>',
                                'required' => true,
                                'escape' => false
                            ]) ?>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <?= $this->Form->button(__('Guardar Cambios'), [
                            'class' => 'btn btn-success'
                        ]) ?>
                    </div>
                    
                    <?= $this->Form->end() ?>
                </div>
            </div>
            <div class="card border-info">
                <p class="text-info"><?= __('Los campos que contengan <span class="text-danger">*</span> son obligatorios de completar para poder guardar la edición del Proveedor.') ?></p>
            </div>
        </div>
    </div>
</section>

<?php $this->Html->scriptStart(['block' => true]); ?>
<script>
$(document).ready(function() {
    // Formateo de CUIT
    $('#cuit-input').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        if (value.length > 2) value = value.substring(0, 2) + '-' + value.substring(2);
        if (value.length > 11) value = value.substring(0, 11) + '-' + value.substring(11);
        $(this).val(value.substring(0, 13));
    });

    // Carga dinámica de provincias
    $('#pais-id').change(function() {
        const paisId = $(this).val();
        const provinciaSelect = $('#provincia-id');
        
        if (paisId) {
            $.get('/provincias/getByPais/' + paisId, function(data) {
                provinciaSelect.empty().append('<option value="">Seleccione provincia</option>');
                $.each(data, function(key, value) {
                    provinciaSelect.append($('<option>').val(key).text(value));
                });
                // Mantener el valor seleccionado si corresponde al país
                const currentProvinciaId = <?= $proveedore->provincia_id ?: 'null' ?>;
                if (currentProvinciaId && data[currentProvinciaId]) {
                    provinciaSelect.val(currentProvinciaId);
                }
            });
        } else {
            provinciaSelect.empty().append('<option value="">Seleccione un país primero</option>');
        }
    });

    // Validación antes de enviar
    $('form').submit(function(e) {
        if (!$('#pais-id').val()) {
            alert('Seleccione un país');
            e.preventDefault();
            return false;
        }
        if (!$('#provincia-id').val()) {
            alert('Seleccione una provincia');
            e.preventDefault();
            return false;
        }
        return true;
    });
});
</script>
<?php $this->Html->scriptEnd(); ?>