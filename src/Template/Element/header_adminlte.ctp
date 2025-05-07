<nav class="main-header navbar navbar-expand navbar-dark" style="background-color: #025736; height: 65px;">

  <!-- sidebar -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link text-white" data-widget="pushmenu" href="#"><i class="fas fa-bars fa-lg"></i></a>
    </li>
  </ul>

  <!-- Center: título -->
  <ul class="navbar-nav mx-auto">
    <li class="nav-item d-none d-sm-inline-block">
      <span class="nav-link font-weight-bold text-white text-center" style= "margin-bottom: 20px">
        Iván Koteski – Developer Web FullStack
        <br>
        Prueba Técnica AdecoAGRO: Módulo de Compra a Proveedores
      </span>
    </li>
  </ul>

  <!-- Right: usuario y logout -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <?php
            $username = $this->request->getSession()->read('Auth.User.username');
        ?>
        <span class="nav-link text-white"><?= h($username) ?></span>
    </li>

    <li class="nav-item">
      <?= $this->Html->link(
            '<i class="fas fa-sign-out-alt"></i>',
            ['controller'=>'Users','action'=>'logout'],
            ['escape'=>false,'class'=>'btn btn-danger btn-lg ml-3','title'=>'Cerrar Sesión']
      ) ?>
    </li>
  </ul>

</nav>
