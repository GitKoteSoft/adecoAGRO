<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Proveedore $proveedore
 */
?>

<section class="content">
    <div class="row">
        
        <!-- Sidebar -->
        <div class="col-md-2">
            <!-- Botón Nuevo Proveedor -->
            <?= $this->Html->link(__('Lista de Proveedores'), ['action' => 'index'], ['class' => 'btn btn-primary btn-lg mb-3']) ?>
        </div>

        <!-- Formulario principal -->
        <div class="col-md-10">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title"><?= __('Agregar Nuevo Proveedor') ?></h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($proveedore, ['class' => 'form-horizontal']) ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <?= $this->Form->control('cuit', [
                                'class' => 'form-control',
                                'label' => 'CUIT <span class="text-danger">*</span>',
                                'required' => true,
                                'escape' => false,
                                'placeholder' => 'Escriba el CUIT sin guiones y sin espacios. Ej: 30123456781',
                                'id' => 'cuit-input',
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
                            <?= $this->Form->control('localidad', [
                                'class' => 'form-control',
                                'label' => 'Localidad <span class="text-danger">*</span>',
                                'required' => true,
                                'escape' => false
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $this->Form->control('provincia_id', [
                                'class' => 'form-control select2',
                                'label' => 'Provincia <span class="text-danger">*</span>',
                                'required' => true,
                                'escape' => false,
                                'options' => $provincias,
                                'empty' => 'Seleccione una provincia'
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $this->Form->control('pais_id', [
                                'class' => 'form-control select2',
                                'label' => 'País <span class="text-danger">*</span>',
                                'required' => true,
                                'escape' => false,
                                'options' => $paises,
                                'empty' => 'Seleccione un país'
                            ]) ?>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <?= $this->Form->button(__('Guardar Proveedor'), [
                            'class' => 'btn btn-success'
                        ]) ?>
                    </div>
                    
                    <?= $this->Form->end() ?>
                </div>
            </div>
            <div class="card border-info">
                <p class="text-info"><?= __('Los campos que contengan <span class="text-danger">*</span> son obligatorios de completar para poder registrar al Proveedor.') ?></p>
            </div>
        </div>
    </div>
</section>

<?php $this->Html->scriptStart(['block' => true]); ?>
<script>
$(document).ready(function() {
    // Inicializar select2 para mejores dropdowns
    $('.select2').select2({
        theme: 'bootstrap4'
    });
});

$(document).ready(function() {
    $('#cuit-input').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        if (value.length > 2) {
            value = value.substring(0, 2) + '-' + value.substring(2);
        }
        if (value.length > 11) {
            value = value.substring(0, 11) + '-' + value.substring(11);
        }
        $(this).val(value.substring(0, 13));
        
        // Habilitar IVA si CUIT tiene 13 caracteres (incluyendo guiones)
        $('#iva-condicion-id').prop('disabled', value.length < 13);
    });
});

$('#pais-id').change(function() {
    const paisId = $(this).val();
    const provinciaSelect = $('#provincia-id');
    
    provinciaSelect.prop('disabled', !paisId);
    
    if (paisId) {
        $.get('/provincias/getByPais/' + paisId, function(data) {
            provinciaSelect.empty();
            provinciaSelect.append('<option value="">Seleccione provincia</option>');
            
            $.each(data, function(key, value) {
                provinciaSelect.append('<option value="' + key + '">' + value + '</option>');
            });
        });
    } else {
        provinciaSelect.empty().append('<option value="">Primero seleccione un país</option>');
    }
});

</script>
<?php $this->Html->scriptEnd(); ?>