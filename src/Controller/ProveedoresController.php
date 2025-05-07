<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Proveedores Controller
 *
 * @property \App\Model\Table\ProveedoresTable $Proveedores
 *
 * @method \App\Model\Entity\Proveedore[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProveedoresController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    /*public function index()
    {
        $this->paginate = [
            'contain' => ['Provincias', 'Paises'],
        ];
        $proveedores = $this->paginate($this->Proveedores);

        $this->set(compact('proveedores'));
    }*/
    public function index()
    {
        $proveedores = $this->Proveedores->find('all', [
            'contain' => ['Provincias', 'Paises', 'IvaCondiciones']
        ]);
        
        $this->paginate = [
            'contain' => ['Provincias', 'Paises', 'IvaCondiciones'],
            'limit' => 10 // límite de paginación
        ];
        
        $proveedores = $this->paginate($this->Proveedores);
        $this->set(compact('proveedores'));
    }


    /**
     * View method
     *
     * @param string|null $id Proveedore id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $proveedore = $this->Proveedores->get($id, [
            'contain' => ['Provincias', 'Paises', 'IvaCondiciones'],
        ]);

        $this->set(compact('proveedore'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    /* add() original creado con bake */
    /*public function add()
    {
        $proveedore = $this->Proveedores->newEntity();
        if ($this->request->is('post')) {
            $proveedore = $this->Proveedores->patchEntity($proveedore, $this->request->getData());
            if ($this->Proveedores->save($proveedore)) {
                $this->Flash->success(__('The proveedore has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The proveedore could not be saved. Please, try again.'));
        }
        $provincias = $this->Proveedores->Provincias->find('list', ['limit' => 200]);
        $paises = $this->Proveedores->Paises->find('list', ['limit' => 200]);
        $this->set(compact('proveedore', 'provincias', 'paises'));
    }*/

    public function add()
    {
        $proveedore = $this->Proveedores->newEntity();
        if ($this->request->is('post')) {
            $proveedore = $this->Proveedores->patchEntity($proveedore, $this->request->getData());
            if ($this->Proveedores->save($proveedore)) {
                $this->Flash->success(__('Proveedor guardado.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Error al intentar guardar el Proveedor.'));
        }
        // acá coloco los selects de paises, provincias e IVA ─────────────────
        $paises     = $this->Proveedores->Paises->find('list', ['keyField'=>'id','valueField'=>'nombre']);
        $provincias = $this->Proveedores->Provincias->find('list', ['keyField'=>'id','valueField'=>'nombre']);
        /*$tiposIva   = [
            'RI' => 'Responsable Inscripto',
            'CF' => 'Consumidor Final',
            'EX' => 'Exento',
            'MT' => 'Monotributista'
        ];*/
        $ivaCondiciones = $this->Proveedores->IvaCondiciones->find('list', [
            'keyField' => 'id',
            'valueField' => 'descripcion'
        ])->toArray();
               
        //$this->set(compact('proveedor','paises','provincias','tiposIva'));
        $this->set(compact('proveedore','paises','provincias','ivaCondiciones'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Proveedore id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /* edit() original creado con bake */
    /*
    public function edit($id = null)
    {
        $proveedore = $this->Proveedores->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $proveedore = $this->Proveedores->patchEntity($proveedore, $this->request->getData());
            if ($this->Proveedores->save($proveedore)) {
                $this->Flash->success(__('The proveedore has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The proveedore could not be saved. Please, try again.'));
        }
        $provincias = $this->Proveedores->Provincias->find('list', ['limit' => 200]);
        $paises = $this->Proveedores->Paises->find('list', ['limit' => 200]);
        $this->set(compact('proveedore', 'provincias', 'paises'));
    }*/

    public function edit($id = null)
    {
        // 1. Obtener el proveedor existente CON las relaciones necesarias
        $proveedore = $this->Proveedores->get($id, [
            'contain' => ['IvaCondiciones', 'Provincias', 'Paises'] // Cargar relaciones
        ]);

        // 2. Procesar el POST/PUT
        if ($this->request->is(['patch', 'post', 'put'])) {
            $proveedore = $this->Proveedores->patchEntity($proveedore, $this->request->getData());
            if ($this->Proveedores->save($proveedore)) {
                $this->Flash->success(__('El Proveedor ha sido guardado con éxito.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El Proveedor no se pudo guardar. Inténtelo de nuevo.'));
        }

        // 3. Preparar datos para los selects
        $paises = $this->Proveedores->Paises->find('list', [
            'keyField' => 'id',
            'valueField' => 'nombre',
            'order' => ['nombre' => 'ASC']
        ])->toArray();

        // Cargar solo provincias del país actual del proveedor
        $provincias = $this->Proveedores->Provincias->find('list', [
            'keyField' => 'id',
            'valueField' => 'nombre',
            'conditions' => ['pais_id' => $proveedore->pais_id],
            'order' => ['nombre' => 'ASC']
        ])->toArray();

        $ivaCondiciones = $this->Proveedores->IvaCondiciones->find('list', [
            'keyField' => 'id',
            'valueField' => 'descripcion',
            'order' => ['descripcion' => 'ASC']
        ])->toArray();

        // 4. Pasar todo a la vista (corrigiendo el nombre de la variable)
        $this->set(compact('proveedore', 'paises', 'provincias', 'ivaCondiciones'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Proveedore id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $proveedore = $this->Proveedores->get($id);
        if ($this->Proveedores->delete($proveedore)) {
            $this->Flash->success(__('El Proveedor a sido eliminado correctamente.'));
        } else {
            $this->Flash->error(__('El Proveedor no pudo ser eliminado. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
