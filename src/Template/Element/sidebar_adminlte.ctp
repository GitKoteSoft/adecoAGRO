<aside class="main-sidebar sidebar-dark-primary">

  <!-- Logo AdecoAGRO -->
  <a href="<?= $this->Url->build(['controller'=>'Dashboard','action'=>'index'])?>" class="brand-link d-flex align-items-center p-3" style="background-color: #025736;">
    <?= $this->Html->image('Logo - AdecoAGRO - Chico.png', [
      'class'=>'brand-image',
      'alt'=>'brand-image',
      'style'=>'width: 100%;'
    ]) ?>
  </a>
  
  <!-- Contenedor Sidebar Menú-->
  <div class="sidebar">

    <!-- Sidebar Menú -->
    <nav class="mt-2">

      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        <!-- Inicio -->
        <li class="nav-item">
          <?= $this->Html->link('<i class="nav-icon fas fa-home"></i><p>Inicio</p>',
              ['controller'=>'Dashboard','action'=>'index'],
              ['escape'=>false,'class'=>'nav-link']) ?>
        </li>

        <hr>

        <li class="nav-item has-treeview">
          <!-- Control de Acceso -->
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users-cog"></i><p>Control de Acceso<i class="right fas fa-angle-left"></i></p>
          </a>
          <!-- Administrar Usuarios -->
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <?= $this->Html->link('<i class="far fa-circle nav-icon"></i><p>Administrar Usuarios</p>',
                  ['controller'=>'Users','action'=>'index'],
                  ['escape'=>false,'class'=>'nav-link']) ?>
            </li>
          </ul>
        </li>

        <hr>

        <!-- Entidad -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-building"></i><p>Entidad<i class="right fas fa-angle-left"></i></p>
          </a>
          <!-- Proveedores -->
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <?= $this->Html->link('<i class="far fa-circle nav-icon"></i><p>Proveedores</p>',
                  ['controller'=>'Proveedores','action'=>'index'],
                  ['escape'=>false,'class'=>'nav-link']) ?>
            </li>
          </ul>
        </li>

        <!-- Órdenes de Compra -->
        <li class="nav-item">
          <?= $this->Html->link('<i class="nav-icon fas fa-shopping-cart"></i><p>Órdenes de Compra</p>',
              ['controller'=>'Compras','action'=>'index'],
              ['escape'=>false,'class'=>'nav-link']) ?>
        </li>
      </ul>
    </nav>
  </div>
</aside>
