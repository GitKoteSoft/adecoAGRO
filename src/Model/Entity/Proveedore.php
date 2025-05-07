<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Proveedore Entity
 *
 * @property int $id
 * @property string $cuit
 * @property string $razon_social
 * @property string $iva_condicion_id
 * @property string $direccion
 * @property string $cp
 * @property string $localidad
 * @property int $provincia_id
 * @property int $pais_id
 * @property string|null $telefono
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Provincia $provincia
 * @property \App\Model\Entity\Paise $paise
 */
class Proveedore extends Entity
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
        'cuit' => true,
        'razon_social' => true,
        'iva_condicion_id' => true,
        'direccion' => true,
        'cp' => true,
        'localidad' => true,
        'provincia_id' => true,
        'pais_id' => true,
        'telefono' => true,
        'created' => true,
        'modified' => true,
        'provincia' => true,
        'paise' => true,
    ];
}
