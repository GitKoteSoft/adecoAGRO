<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Proveedore $proveedore
 */
?>

<!-- Main content -->
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
                        <?= $this->Html->link(__('Editar Proveedor'), ['action' => 'edit', $proveedore->id], ['class' => 'btn btn-warning btn-block mb-2']) ?>
                        <?= $this->Form->postLink(__('Eliminar Proveedor'), ['action' => 'delete', $proveedore->id], ['class' => 'btn btn-danger btn-block mb-2','confirm' => __('¿Está seguro de eliminar este proveedor? # {0}', $proveedore->id)]) ?>
                        <?= $this->Html->link(__('Lista de Proveedores'), ['action' => 'index'], ['class' => 'btn btn-info btn-block mb-2']) ?>
                        <?= $this->Html->link(__('Nuevo Proveedor'), ['action' => 'add'], ['class' => 'btn btn-primary btn-block mb-2']) ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="col-md-9">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title text-bold text-lg">Razón Social: <?= h($proveedore->razon_social) ?> <br> ID: <?= h($proveedore->id) ?></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-box bg-light">
                                <span class="info-box-icon"><i class="fas fa-id-card"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"><?= __('CUIT') ?></span>
                                    <span class="info-box-number"><?= h($proveedore->cuit) ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text"><?= __('Condición IVA') ?></span>
                                    <span class="info-box-number">
                                        <?= $proveedore->has('iva_condicion') ? h($proveedore->iva_condicion->descripcion) : 'No definido' ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><?= __('Información de Contacto') ?></h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3"><?= __('Dirección') ?></dt>
                                <dd class="col-sm-9"><?= h($proveedore->direccion) ?></dd>

                                <dt class="col-sm-3"><?= __('Código Postal') ?></dt>
                                <dd class="col-sm-9"><?= h($proveedore->cp) ?></dd>

                                <dt class="col-sm-3"><?= __('Localidad') ?></dt>
                                <dd class="col-sm-9"><?= h($proveedore->localidad) ?></dd>

                                <dt class="col-sm-3"><?= __('Provincia') ?></dt>
                                <dd class="col-sm-9">
                                    <?= $proveedore->has('provincia') ? h($proveedore->provincia->nombre) : '' ?>
                                </dd>

                                <dt class="col-sm-3"><?= __('País') ?></dt>
                                <dd class="col-sm-9">
                                    <?= $proveedore->has('paise') ? h($proveedore->paise->nombre) : '' ?>
                                </dd>

                                <dt class="col-sm-3"><?= __('Teléfono') ?></dt>
                                <dd class="col-sm-9"><?= h($proveedore->telefono) ?></dd>
                            </dl>
                        </div>
                    </div>

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><?= __('Metadatos') ?></h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3"><?= __('Creado') ?></dt>
                                <dd class="col-sm-9"><?= h($proveedore->created) ?></dd>

                                <dt class="col-sm-3"><?= __('Modificado') ?></dt>
                                <dd class="col-sm-9"><?= h($proveedore->modified) ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>