<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrdenCompra Entity
 *
 * @property int $id
 * @property int $proveedor_id
 * @property \Cake\I18n\FrozenDate $fecha_emision
 * @property \Cake\I18n\FrozenDate|null $fecha_vencimiento
 * @property string|null $observaciones
 * @property string $forma_pago
 * @property string $forma_envio
 * @property int $moneda_id
 * @property string|null $estado
 * @property float $total_orden_compra
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Proveedore $proveedore
 * @property \App\Model\Entity\TipoMoneda $tipo_moneda
 */
class OrdenCompra extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'proveedor_id' => true,
        'fecha_emision' => true,
        'fecha_vencimiento' => true,
        'observaciones' => true,
        'forma_pago' => true,
        'forma_envio' => true,
        'moneda_id' => true,
        'estado' => true,
        'total_orden_compra' => true,
        'created' => true,
        'modified' => true,
        'proveedore' => true,
        'tipo_moneda' => true,
        'orden_detalles' => true
    ];
}
