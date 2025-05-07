<!-- Este div va a ser el fondo animado de particulas muy copado -->
<div id="particles-js" style="position:absolute; top:0; left:0; width:100%; height:100%; z-index: 0; pointer-events:auto;"></div>

<?php
echo $this->Html->script('https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js', ['block' => true]);

echo $this->Html->scriptBlock("document.addEventListener('DOMContentLoaded', function () {

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
                    value: '#025736'
                },
                shape: {
                    type: 'circle',
                    stroke: {
                        width: 2,
                        color: '#191919'
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
                    color: '#025736',
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
});");
?>
