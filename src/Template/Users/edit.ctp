<div class="row">
    <!-- Acciones -->
    <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><?= __('Acciones') ?></h3>
            </div>
            <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">

                    <!-- Botón Eliminar -->
                    <li class="nav-item">
                        <?= $this->Form->postLink(
                            __('Eliminar Usuario'),
                            ['action' => 'delete', $user->id],
                            [
                                'confirm' => __('¿Seguro que deseas eliminar al usuario # {0}?', $user->id),
                                'class' => 'nav-link text-danger',
                                'escape' => false,
                            ]
                        ) ?>
                    </li>

                    <!-- Botón Listar Usuarios -->
                    <li class="nav-item">
                        <?= $this->Html->link(
                            __('Listar Usuarios'),
                            ['action' => 'index'],
                            ['class' => 'nav-link text-info']
                        ) ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="col-md-9">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= __('Editar Usuario') ?></h3>
            </div>
            
            <div class="card-body">
                <?= $this->Form->create($user, ['class' => 'form-horizontal']) ?>
                
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?= __('Nombre de Usuario') ?></label>
                    <div class="col-sm-9">
                        <?= $this->Form->control('username', [
                            'label' => false,
                            'class' => 'form-control',
                            'placeholder' => 'Ej: juan.perez',
                            'templates' => [
                                'inputContainer' => '{{content}}'
                            ]
                        ]) ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?= __('Contraseña') ?></label>
                    <div class="col-sm-9">
                        <?= $this->Form->control('password', [
                            'label' => false,
                            'class' => 'form-control',
                            'value' => '', // Para evitar mostrar hash
                            'placeholder' => 'Dejar vacío para no cambiar la Contraseña'
                        ]) ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?= __('Rol') ?></label>
                    <div class="col-sm-9">
                        <?= $this->Form->control('rol', [
                            'label' => false,
                            'class' => 'form-control custom-select',
                            'options' => [
                                'Administrador' => 'Administrador',
                                'Usuario' => 'Usuario'
                            ]
                        ]) ?>
                    </div>
                </div>

                <div class="card-footer text-right bg-white">
                    <?= $this->Form->button(__('Guardar Cambios'), [
                        'class' => 'btn btn-success btn-flat',
                        'escape' => false,
                    ]) ?>
                </div>

                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>