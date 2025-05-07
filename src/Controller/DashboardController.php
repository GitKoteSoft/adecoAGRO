<?php
namespace App\Controller;

class DashboardController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        // Permitimos el acceso a esta página una vez logueado
        $this->Auth->allow(['index']);
    }

    public function index()
    {
        // Pasamos el usuario logueado a la vista
        $this->set('user', $this->Auth->user());
    }
}
