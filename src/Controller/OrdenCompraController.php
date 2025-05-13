<?php
namespace App\Controller;

use App\Controller\AppController;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * OrdenCompra Controller
 *
 * @property \App\Model\Table\OrdenCompraTable $OrdenCompra
 *
 * @method \App\Model\Entity\OrdenCompra[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdenCompraController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    /*
    public function index()
    {
        $this->paginate = [
            'contain' => ['Proveedores', 'TipoMoneda'],
        ];
        $ordenCompra = $this->paginate($this->OrdenCompra);

        $this->set(compact('ordenCompra'));
    }*/
    public function index()
    {
        $this->paginate = [
            'contain' => [
                'Proveedores' => ['Provincias'],
                'TipoMoneda'
            ]
        ];
         

        $ordenCompra = $this->paginate($this->OrdenCompra);

        $this->set(compact('ordenCompra'));
    }


    /**
     * View method
     *
     * @param string|null $id Orden Compra id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ordenCompra = $this->OrdenCompra->get($id, [
            'contain' => ['Proveedores', 'TipoMoneda', 'OrdenDetalles'],
        ]);

        $this->set('ordenCompra', $ordenCompra);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    /*
    public function add()
    {
        $ordenCompra = $this->OrdenCompra->newEntity();
        if ($this->request->is('post')) {
            $ordenCompra = $this->OrdenCompra->patchEntity($ordenCompra, $this->request->getData());
            if ($this->OrdenCompra->save($ordenCompra)) {
                $this->Flash->success(__('The orden compra has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The orden compra could not be saved. Please, try again.'));
        }
        $proveedores = $this->OrdenCompra->Proveedores->find('list', ['limit' => 200]);
        $tipoMoneda = $this->OrdenCompra->TipoMoneda->find('list', ['limit' => 200]);
        $this->set(compact('ordenCompra', 'proveedores', 'tipoMoneda'));
    }
    */
    /*
    public function add()
    {
        // Creo una entidad OrdenCompra
        $ordenCompra = $this->OrdenCompra->newEntity();

        if ($this->request->is('post')) {
            // cargamos la entidad principal con los datos del formulario
            // y le indico que también procese el sub-array 'orden_detalles', para poder pasarlo todo en un solo save().
            $ordenCompra = $this->OrdenCompra->newEntity($this->request->getData(), [
                'associated' => ['OrdenDetalles']
            ]);            

            // 3. Intentamos guardar tanto la orden como sus detalles
            if ($this->OrdenCompra->save($ordenCompra)) {
                $this->Flash->success(__('La orden de compra se guardó correctamente.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar la orden. Por favor, revisá los datos.'));
        }

        // Preparamos los selects de Proveedores y Moneda
        $proveedores = $this->OrdenCompra->Proveedores
            ->find('list', ['keyField'=>'id', 'valueField'=>'razon_social'])
            ->toArray();

        $tipoMoneda = [];
        $monedas = $this->OrdenCompra->TipoMoneda->find('all')->toArray();
        foreach ($monedas as $m) {
            $tipoMoneda[$m->id] = "{$m->simbolo} – {$m->divisa}";
        }
            

        // Enviamos a la vista la entidad y los arrays para los selects
        $this->set(compact('ordenCompra', 'proveedores', 'tipoMoneda'));
    }
    */
    /*
    public function add()
    {
        $ordenCompra = $this->OrdenCompra->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            // Si se han agregado filas, incluyo el guardado asociado de detalles
            $options = [];
            if (!empty($data['orden_detalles'])) {
                $options['associated'] = ['OrdenDetalles'];
            }
            // Creo la entidad principal (y sus hijos, si aplica)
            $ordenCompra = $this->OrdenCompra->newEntity($data, $options);
            
            if ($this->OrdenCompra->save($ordenCompra)) {
                $this->Flash->success(__('La orden de compra se guardó correctamente.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar la orden. Por favor, revisá los datos.'));
        }

        // Preparar selects
        $proveedores = $this->OrdenCompra->Proveedores
            ->find('list', ['keyField'=>'id', 'valueField'=>'razon_social'])
            ->toArray();
        $tipoMoneda = $this->OrdenCompra->TipoMoneda
            ->find('list', [
                'keyField'=>'id',
                'valueField'=>function($m) {
                    return "{$m->simbolo} – {$m->divisa}";
                }
            ])
            ->toArray();

        $this->set(compact('ordenCompra', 'proveedores', 'tipoMoneda'));
    }
    */
    // src/Controller/OrdenCompraController.php

    public function add()
    {
        // Creamos una entidad vacía de OrdenCompra (CakePHP 3)
        $ordenCompra = $this->OrdenCompra->newEntity();

        if ($this->request->is('post')) {
            // Obtenemos todo el payload
            $data = $this->request->getData();

            // Si vinieron detalles, calculamos sus subtotales y el total de la orden
            if (!empty($data['orden_detalles'])) {
                $totalOrden = 0;
                foreach ($data['orden_detalles'] as $i => $det) {
                    // Cantidad, precio y bonificación del detalle
                    $cant = (float)$det['cantidad'];
                    $pu   = (float)$det['precio_unitario'];
                    $boni = (float)$det['bonificacion'] / 100.0;

                    // Subtotal sin IVA
                    $subSin = $cant * $pu * (1 - $boni);
                    // Subtotal con IVA
                    $ivaPct = (float)$det['iva'] / 100.0;
                    $subCon = $subSin * (1 + $ivaPct);

                    // Inyectamos en el array para que Cake los persista
                    $data['orden_detalles'][$i]['subtotal_sin_iva']   = $subSin;
                    $data['orden_detalles'][$i]['subtotal_con_iva']   = $subCon;

                    // Sumamos al total de la orden
                    $totalOrden += $subCon;
                }
                // Fijamos el total calculado en la cabecera
                $data['total_orden_compra'] = $totalOrden;
            }

            // PatchEntity con asociados para que procese también orden_detalles
            $ordenCompra = $this->OrdenCompra->patchEntity(
                $ordenCompra,
                $data,
                ['associated' => ['OrdenDetalles']]
            );

            // Intentamos guardar todo en un solo save()
            if ($this->OrdenCompra->save($ordenCompra)) {
                $this->Flash->success(__('La orden de compra se guardó correctamente.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('No se pudo guardar la orden. Por favor, revisá los datos.'));
        }

        // Calcular siguiente ID y formatearlo
        $ultimaOrden = $this->OrdenCompra->find()
        ->select(['max' => 'MAX(id)'])
        ->first()
        ->max;
        $proximaOrden = $ultimaOrden + 1;
        $numeroOC = '000-' . str_pad($proximaOrden, 4, '0', STR_PAD_LEFT);

        $this->set(compact('numeroOC'));

        // Preparar selects para la vista
        $proveedores = $this->OrdenCompra->Proveedores
            ->find('list', ['keyField'=>'id','valueField'=>'razon_social'])
            ->toArray();
        $tipoMoneda = $this->OrdenCompra->TipoMoneda
            ->find('list', [
                'keyField'=>'id',
                'valueField'=> function($m) {
                    return "{$m->simbolo} – {$m->divisa}";
                }
            ])
            ->toArray();

        $this->set(compact('ordenCompra','proveedores','tipoMoneda'));
    }

    // Botón Anular Orden Compra
    public function anular($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        
        $ordenCompra = $this->OrdenCompra->get($id);
        
        try {
            // Marcar como Anulado
            $ordenCompra->estado = 'Anulada';
            
            if ($this->OrdenCompra->save($ordenCompra)) {
                $this->Flash->success(__('La Orden de Compra #{0} ha sido anulada.', $id));
            } else {
                $this->Flash->error(__('No se pudo anular la Orden de Compra.'));
            }
        } catch (\Exception $e) {
            $this->Flash->error(__('Error al anular: ') . $e->getMessage());
        }

        return $this->redirect(['action' => 'index']);
    }




    /**
     * Edit method
     *
     * @param string|null $id Orden Compra id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /*
    public function edit($id = null)
    {
        $ordenCompra = $this->OrdenCompra->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ordenCompra = $this->OrdenCompra->patchEntity($ordenCompra, $this->request->getData());
            if ($this->OrdenCompra->save($ordenCompra)) {
                $this->Flash->success(__('The orden compra has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The orden compra could not be saved. Please, try again.'));
        }
        $proveedores = $this->OrdenCompra->Proveedores->find('list', ['limit' => 200]);
        $tipoMoneda = $this->OrdenCompra->TipoMoneda->find('list', ['limit' => 200]);
        $this->set(compact('ordenCompra', 'proveedores', 'tipoMoneda'));
    }
    */
    /*public function edit($id = null)
    {
        // Traigo la orden junto con sus detalles para que aparezcan en el form
        $ordenCompra = $this->OrdenCompra->get($id, [
            'contain' => ['OrdenDetalles']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $ordenCompra = $this->OrdenCompra->patchEntity(
                $ordenCompra,
                $this->request->getData(),
                ['associated' => ['OrdenDetalles']]
            );
            if ($this->OrdenCompra->save($ordenCompra)) {
                $this->Flash->success(__('La orden de compra se actualizó correctamente.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo actualizar. Por favor, revisá los datos.'));
        }

        // Traigo el ID de la OC
        $ultimaOrden = $this->OrdenCompra->find()
        ->select(['max' => 'MAX(id)'])
        ->first()
        ->max;
        $proximaOrden = $ultimaOrden + 1;
        $numeroOC = '000-' . str_pad($proximaOrden, 4, '0', STR_PAD_LEFT);

        $this->set(compact('numeroOC'));

        // Reutilizo los mismos selects
        $proveedores = $this->OrdenCompra->Proveedores
            ->find('list', ['keyField'=>'id', 'valueField'=>'razon_social'])
            ->toArray();
        $tipoMoneda = $this->OrdenCompra->TipoMoneda
            ->find('list', [
                'keyField'=>'id',
                'valueField'=>function($m) {
                    return "{$m->simbolo} – {$m->divisa}";
                }
            ])
            ->toArray();

        $this->set(compact('ordenCompra', 'proveedores', 'tipoMoneda'));
    }
    */



    /**
     * Delete method
     *
     * @param string|null $id Orden Compra id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ordenCompra = $this->OrdenCompra->get($id);

        // Valido el estado (si está aprobado o anulado) antes de eliminar
        if ($ordenCompra->estado === 'Anulada' || $ordenCompra->estado === 'Aprobada') {
            $this->Flash->error(__('No se puede eliminar una Orden de Compra con Estado: {0}.', $ordenCompra->estado));
            return $this->redirect(['action' => 'index']);
        }

        try {
            if ($this->OrdenCompra->delete($ordenCompra)) {
                $this->Flash->success(__('La Orden de Compra #{0} ha sido eliminada.', $id));
            } else {
                $this->Flash->error(__('No se pudo eliminar la Orden de Compra.'));
            }
        } catch (\Exception $e) {
            $this->Flash->error(__('Error al eliminar: ') . $e->getMessage());
        }

        return $this->redirect(['action' => 'index']);
    }



    /**
     * Metodo para Generar el PDF
     */
    public function generarPdf($id = null)
    {
        //Creo una nueva instancia de configuración para DomPDF.
        $options = new \Dompdf\Options();
        $options->setIsRemoteEnabled(true); // Habilito para que DOMpdf pueda cargar imágenes y estilos externos.
        $options->set('chroot', [ROOT . DS . 'webroot']); // con esto, aseguro que dompdf busque dichos archivos solo dentro de la carpeta webroot del proyecto.
        

        //acá traigo los datos de la tabla en base al $id y hago cumplir sus relaciones asociadas.
        $orden = $this->OrdenCompra->get($id, [
            'contain' => [
                'Proveedores' => ['Provincias'],
                'TipoMoneda',
                'OrdenDetalles'
            ]
        ]);

        // Acá realizo el Calculo del Neto Gravado(La suma de los subtotales sin IVA).
        // con Collection convierto el array en coleccion, donde puedo usar metodos para hacer casi lo mismo que haria con foreach.
        $netoGravado = collection($orden->orden_detalles)
        
        // con reduce recorro todos los "detalles" y sumo los subtotales sin iva.
        ->reduce(function($acumulador, $item_detalle) {
            return $acumulador + $item_detalle->subtotal_sin_iva;
        }, 0);

        // Acá calculo el IVA Total (total - netoGravado)
        $ivaTotal = $orden->total_orden_compra - $netoGravado;

    
        $this->viewBuilder()
            ->setClassName('CakePdf.Pdf')
            ->setLayout(false)
            ->setTemplate('pdf_orden_compra')
            ->setOptions([
                'pdfConfig' => [
                    'orientation' => 'portrait',
                    'filename'    => 'OC-' . str_pad($orden->id, 4, '0', STR_PAD_LEFT) . '.pdf',
                    'options'     => $options // Paso las opciones a domPDF
                ]
            ])
            // Paso estas variables a la vista
        ->setVars(compact('orden', 'netoGravado', 'ivaTotal'));
    }
}
