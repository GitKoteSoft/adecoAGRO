<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>

<div class="container mt-4">
    <!-- Título -->
    <h2 class="text-center mb-4">Listado de Usuarios</h2>

    <!-- Botón para agregar usuario -->
    <div class="mb-3 text-end">
        <?= $this->Html->link(
            '<i class="fas fa-user-plus"></i> Nuevo Usuario',
            ['action' => 'add'],
            ['escape' => false, 'class' => 'btn btn-success']
        ) ?>
    </div>

    <!-- Tabla de usuarios -->
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-success">
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('username') ?></th>
                        <th><?= $this->Paginator->sort('rol') ?></th>
                        <th><?= $this->Paginator->sort('created') ?></th>
                        <th><?= $this->Paginator->sort('modified') ?></th>
                        <th class="text-center"><?= __('Acciones') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Recorro la Tabla Users y muestro su contenido. -->
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $this->Number->format($user->id) ?></td>
                            <td><?= h($user->username) ?></td>
                            <td><?= h($user->rol) ?></td>
                            <td><?= h($user->created) ?></td>
                            <td><?= h($user->modified) ?></td>
                            <td class="text-center">
                                <!-- Botón Ver -->
                                <?= $this->Html->link(
                                    '<i class="fas fa-eye"></i>',
                                    ['action' => 'view', $user->id],
                                    [
                                        'escape' => false,
                                        'class' => 'btn btn-sm btn-primary me-1',
                                        'data-bs-toggle' => 'tooltip',
                                        'data-bs-placement' => 'top',
                                        'title' => 'Ver Usuario'
                                    ]
                                ) ?>

                                <!-- Botón Editar -->
                                <?= $this->Html->link(
                                    '<i class="fas fa-edit"></i>',
                                    ['action' => 'edit', $user->id],
                                    [
                                        'escape' => false,
                                        'class' => 'btn btn-sm btn-warning me-1',
                                        'data-bs-toggle' => 'tooltip',
                                        'data-bs-placement' => 'top',
                                        'title' => 'Editar Usuario'
                                    ]
                                ) ?>

                                <!-- Botón Eliminar -->
                                <?= $this->Form->postLink(
                                    '<i class="fas fa-trash"></i>',
                                    ['action' => 'delete', $user->id],
                                    [
                                        'confirm' => __('¿Seguro que quieres eliminar este usuario #{0}?', $user->id),
                                        'escape' => false,
                                        'class' => 'btn btn-sm btn-danger',
                                        'data-bs-toggle' => 'tooltip',
                                        'data-bs-placement' => 'top',
                                        'title' => 'Eliminar Usuario'
                                    ]
                                ) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Paginación -->
    <div class="mt-3 d-flex justify-content-between align-items-center">
        <div>
            <?= $this->Paginator->counter([
                'format' => __('Página {{page}} de {{pages}}, mostrando {{current}} registro(s) de {{count}} total')
            ]) ?>
        </div>
        <div>
            <ul class="pagination mb-0">
                <?= $this->Paginator->first('<<') ?>
                <?= $this->Paginator->prev('<') ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next('>') ?>
                <?= $this->Paginator->last('>>') ?>
            </ul>
        </div>
    </div>
</div>