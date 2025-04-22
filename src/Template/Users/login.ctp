<?= $this->Html->css('style_login') ?>

<?php
// Arranco el contenedor con Bootstrap, le doy un ancho de 400px nomás, y un margen arriba así baja un poco
?>
<!-- Este div va a ser el fondo animado de particulas muy copado -->
<div id="particles-js" style="position:fixed; width:100%; height:100%; background-color:#191919; pointer-events: auto; /* permite eventos en ese div */"></div>

<!-- contenedor Login -->
<div class="container" style="max-width: 400px; margin-top: 200px;">
    
    <h2 class="iniciar-sesion">Iniciar Sesión</h2>

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

<?php
    // Cargo la animación copada particles.js desde el CDN, que nunca falla
    echo $this->Html->script('https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js', ['block' => true]);

    // Inicializo la animación copada con configuración embebida (sin usar .json para evitar problemas de rutas)
    echo $this->Html->scriptBlock("
        document.addEventListener('DOMContentLoaded', function () {
            console.log('Particulas On Fire!');

            particlesJS('particles-js', {
                particles: {
                    number: {
                        value: 80,
                        density: {
                            enable: true,
                            value_area: 800
                        }
                    },
                    color: {
                        value: '#ffffff'
                    },
                    shape: {
                        type: 'circle',
                        stroke: {
                            width: 2,
                            color: '#000000'
                        },
                        polygon: {
                            nb_sides: 7
                        },
                        image: {
                            src: 'img/github.svg',
                            width: 100,
                            height: 100
                        }
                    },
                    opacity: {
                        value: 0.5,
                        random: false,
                        anim: {
                            enable: false,
                            speed: 1,
                            opacity_min: 0.1,
                            sync: false
                        }
                    },
                    size: {
                        value: 3.95,
                        random: true,
                        anim: {
                            enable: true,
                            speed: 22,
                            size_min: 7.3,
                            sync: false
                        }
                    },
                    line_linked: {
                        enable: true,
                        distance: 150,
                        color: '#ffffff',
                        opacity: 0.4,
                        width: 1
                    },
                    move: {
                        enable: true,
                        speed: 4,
                        direction: 'none',
                        random: false,
                        straight: false,
                        out_mode: 'out',
                        bounce: false,
                        attract: {
                            enable: false,
                            rotateX: 600,
                            rotateY: 1200
                        }
                    }
                },
                interactivity: {
                    detect_on: 'canvas',
                    events: {
                        onhover: {
                            enable: true,
                            mode: 'grab'
                        },
                        onclick: {
                            enable: true,
                            mode: 'push'
                        },
                        resize: true
                    },
                    modes: {
                        grab: {
                            distance: 400,
                            line_linked: {
                                opacity: 1
                            }
                        },
                        bubble: {
                            distance: 400,
                            size: 40,
                            duration: 2,
                            opacity: 8,
                            speed: 3
                        },
                        repulse: {
                            distance: 200,
                            duration: 0.4
                        },
                        push: {
                            particles_nb: 4
                        },
                        remove: {
                            particles_nb: 2
                        }
                    }
                },
                retina_detect: true
            });
        });
    ");
?>
