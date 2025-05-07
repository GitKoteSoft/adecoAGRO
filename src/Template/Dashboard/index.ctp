<?= $this->Html->css('style_home') ?>

<div style="position: relative; min-height: 100vh;">
  <?= $this->element('Animaciones/particlesHome') ?>

  <div class="dashboard-home">
    <!-- Logo superpuesto como marca de agua -->
    <?= $this->Html->image('Logo - AdecoAGRO - Dashboard.png', [
        'class'=>'marcadeagua-logo',
        'alt'=>'Logo central Home AdecoAGRO',
    ]) ?>
  </div>
</div>