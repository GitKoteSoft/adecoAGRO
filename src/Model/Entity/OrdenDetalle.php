<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrdenDetalle Entity
 *
 * @property int $id
 * @property int $orden_id
 * @property string $descripcion_producto
 * @property float $cantidad
 * @property float $precio_unitario
 * @property float $bonificacion
 * @property float $subtotal_sin_iva
 * @property float $iva
 * @property float $subtotal_con_iva
 *
 * @property \App\Model\Entity\OrdenCompra $orden_compra
 */
class OrdenDetalle extends Entity
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
        'orden_id' => true,
        'descripcion_producto' => true,
        'cantidad' => true,
        'precio_unitario' => true,
        'bonificacion' => true,
        'subtotal_sin_iva' => true,
        'iva' => true,
        'subtotal_con_iva' => true,
        'orden_compra' => true,
    ];
}
