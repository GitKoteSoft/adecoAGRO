<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="container mt-4">
    <!-- Título de la sección -->
    <h2 class="text-center mb-4">Detalle del Usuario</h2>

    <!-- Uso una Card con datos del usuario -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Usuario: <?= h($user->username) ?></h5>

            <table class="table table-bordered">
                <tr>
                    <th>Rol</th>
                    <td><?= h($user->rol) ?></td>
                </tr>
                <tr>
                    <th>Id</th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th>Creado</th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th>Modificado</th>
                    <td><?= h($user->modified) ?></td>
                </tr>
            </table>

            <!-- Boton de Editar -->
            <div class="d-flex justify-content-between mt-4">
                <?= $this->Html->link(
                    '<i class="fas fa-edit"></i> Editar',
                    ['action' => 'edit', $user->id],
                    ['escape' => false, 'class' => 'btn btn-warning']
                ) ?>
            <!-- Boton de Eliminar -->
                <?= $this->Form->postLink(
                    '<i class="fas fa-trash"></i> Eliminar',
                    ['action' => 'delete', $user->id],
                    [
                        'confirm' => __('¿Estás seguro que querés eliminar al usuario #{0}?', $user->id),
                        'escape' => false,
                        'class' => 'btn btn-danger'
                    ]
                ) ?>
                <!-- Boton de Volver -->
                <?= $this->Html->link(
                    '<i class="fas fa-arrow-left"></i> Volver',
                    ['action' => 'index'],
                    ['escape' => false, 'class' => 'btn btn-secondary']
                ) ?>
            </div>
        </div>
    </div>
</div>
