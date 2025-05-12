<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TipoMoneda Entity
 *
 * @property int $id
 * @property string $codigo
 * @property string $divisa
 * @property string|null $simbolo
 */
class TipoMoneda extends Entity
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
        'codigo' => true,
        'divisa' => true,
        'simbolo' => true,
    ];
}
