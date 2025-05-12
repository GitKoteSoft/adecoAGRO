<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrdenDetalles Model
 *
 * @property \App\Model\Table\OrdenCompraTable&\Cake\ORM\Association\BelongsTo $OrdenCompra
 *
 * @method \App\Model\Entity\OrdenDetalle get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrdenDetalle newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrdenDetalle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrdenDetalle|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrdenDetalle saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrdenDetalle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrdenDetalle[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrdenDetalle findOrCreate($search, callable $callback = null, $options = [])
 */
class OrdenDetallesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('orden_detalles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('OrdenCompra', [
            'foreignKey' => 'orden_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('descripcion_producto')
            ->maxLength('descripcion_producto', 255)
            ->requirePresence('descripcion_producto', 'create')
            ->notEmptyString('descripcion_producto');

        $validator
            ->decimal('cantidad')
            ->requirePresence('cantidad', 'create')
            ->notEmptyString('cantidad');

        $validator
            ->decimal('precio_unitario')
            ->requirePresence('precio_unitario', 'create')
            ->notEmptyString('precio_unitario');

        $validator
            ->decimal('bonificacion')
            ->notEmptyString('bonificacion');

        $validator
            ->decimal('subtotal_sin_iva')
            ->requirePresence('subtotal_sin_iva', 'create')
            ->notEmptyString('subtotal_sin_iva');

        $validator
            ->decimal('iva')
            ->notEmptyString('iva');

        $validator
            ->decimal('subtotal_con_iva')
            ->requirePresence('subtotal_con_iva', 'create')
            ->notEmptyString('subtotal_con_iva');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['orden_id'], 'OrdenCompra'));

        return $rules;
    }
}
