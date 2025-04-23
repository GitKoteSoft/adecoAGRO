<?= $this->Html->css('style_login') ?>
<?= $this->element('Animaciones/particlesLogin') ?>

<!-- contenedor Login -->
<!--<div class="wrapper-login">-->
    <div class="container-login">

        <?= $this->Flash->render() ?>

        <hr>
        <h2 class="iniciar-sesion">Iniciar Sesión</h2>
        <hr>

        <?php
        // Acá creo el formulario con CakePHP, sin pasarle ningún modelo porque es solo login
        echo $this->Form->create();
        ?>

            <div class="form-group">
                <?php
                echo $this->Form->control('username', [
                    'label' => 'Usuario',
                    'class' => 'form-control'
                ]);
                ?>
            </div>

            <div class="form-group">
                <?php
                echo $this->Form->control('password', [
                    'label' => 'Contraseña',
                    'class' => 'form-control'
                ]);
                ?>
            </div>

            <br>

            <div class="text-center">
                <?php
                // Botoncito para enviar el formulario.
                echo $this->Form->button('Ingresar', ['class' => 'btn btn-primary btn-lg']);
                ?>
            </div>

        <?php
        // Cierro el formulario.
        echo $this->Form->end();
        ?>
    </div>
<!--</div>-->