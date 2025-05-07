<div class="row">
    <!-- Sidebar AdminLTE -->
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><?= __('Acciones') ?></h3>
            </div>
            <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <?= $this->Html->link(
                            __('Listar Usuarios'),
                            ['action' => 'index'],
                            ['class' => 'nav-link']
                        ) ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="col-md-9">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title"><?= __('Agregar Nuevo Usuario') ?></h3>
            </div>
            
            <div class="card-body">
                <?= $this->Form->create($user, ['class' => 'form-horizontal']) ?>

                <div class="form-group">
                    <label class="col-sm-2 control-label"><?= __('Nombre de Usuario') ?></label>
                    <div class="col-sm-12">
                        <?= $this->Form->control('username', [
                            'label' => false,
                            'class' => 'form-control',
                        ]) ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label"><?= __('Contraseña') ?></label>
                    <div class="col-sm-12">
                        <?= $this->Form->control('password', [
                            'label' => false,
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label"><?= __('Rol') ?></label>
                    <div class="col-sm-12">
                        <?= $this->Form->control('rol', [
                            'label' => false,
                            'class' => 'form-control',
                            'options' => [
                                'Administrador' => 'Administrador',
                                'Usuario' => 'Usuario'
                            ],
                            'empty' => 'Seleccione un rol...'
                        ]) ?>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <?= $this->Form->button(__('Guardar Usuario'), [
                        'class' => 'btn btn-success btn-flat'
                    ]) ?>
                </div>

                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>