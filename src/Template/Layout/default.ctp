<!DOCTYPE html>
<html>

  <head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AdecoAGRO: <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>

    <!-- AdminLTE & dependencias CSS -->
    <?= $this->Html->css([
      'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css',
      'https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.1/css/OverlayScrollbars.min.css',
      'https://adminlte.io/themes/v3/dist/css/adminlte.min.css',
      'style_content'
    ]) ?>
  </head>


  <body class="hold-transition layout-fixed layout-navbar-fixed">
    <?php
      // Detectar acción de login/logout para no mostrar AdminLTE
      $isLogin = $this->request->getParam('controller') === 'Users'
              && in_array($this->request->getParam('action'), ['login','logout']);
    ?>

    <?php if (!$isLogin): ?>
      <div class="wrapper">
      
      <!-- Header -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <?= $this->element('header_adminlte') ?>
      </nav>

      <!-- Sidebar -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <?= $this->element('sidebar_adminlte') ?>
      </aside>

      <!-- Contenido principal -->
      <div class="content-wrapper">
        <section class="content pt-3 px-3">
          <?= $this->Flash->render() ?>
          <?= $this->fetch('content') ?>
        </section>
      </div>

    </div>

    <?php else: ?>
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    <?php endif; ?>

    <!-- AdminLTE y sus respectivas Librerías y Dependencias JS -->
    <?= $this->Html->script([
      'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js',
      'https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.1/js/jquery.overlayScrollbars.min.js',
      'https://adminlte.io/themes/v3/dist/js/adminlte.min.js'
    ]) ?>
    <?= $this->fetch('script') ?>
  </body>
</html>