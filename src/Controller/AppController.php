<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize(); // Llama al método initialize() del padre (Controller), que prepara el ciclo de vida del controlador

        // Carga el componente RequestHandler, que permite detectar si una petición es Ajax, JSON, XML, etc.
        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false, // Evita que RequestHandler interfiera con redirecciones automáticas
        ]);

        // Carga el componente Flash, que permite mostrar mensajes temporales (como errores o confirmaciones)
        $this->loadComponent('Flash');

        // Carga el componente Auth para gestionar la autenticación y autorización
        $this->loadComponent('Auth', [
            'authenticate' => [ // Define el método de autenticación
                'Form' => [ // Usamos un formulario clásico con username y password
                    'fields' => [
                        'username' => 'username', // Campo para el usuario (en la tabla users)
                        'password' => 'password'  // Campo para la contraseña (también en la tabla users)
                    ]
                ]
            ],
            'loginAction' => [ // Dónde está la pantalla de login
                'controller' => 'Users', // En el controlador Users
                'action' => 'login'      // Acción login()
            ],
            'loginRedirect' => [ // A dónde redirigir si el login fue exitoso
                'controller' => 'Users',
                'action' => 'index'
            ],
            'logoutRedirect' => [ // A dónde redirigir luego de hacer logout
                'controller' => 'Users',
                'action' => 'login'
            ],
            'authError' => 'Por favor, iniciá sesión para continuar.' // Mensaje si el usuario no está autorizado
        ]);

        // Permite acceder a ciertas acciones sin estar logueado (acá solo a la acción display del PagesController)
        $this->Auth->allow(['display']);

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }
}
