<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrdenCompra Model
 *
 * @property \App\Model\Table\ProveedoresTable&\Cake\ORM\Association\BelongsTo $Proveedores
 * @property \App\Model\Table\TipoMonedaTable&\Cake\ORM\Association\BelongsTo $TipoMoneda
 *
 * @method \App\Model\Entity\OrdenCompra get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrdenCompra newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrdenCompra[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrdenCompra|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrdenCompra saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrdenCompra patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrdenCompra[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrdenCompra findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrdenCompraTable extends Table
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

        $this->setTable('orden_compra');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Proveedores', [
            'foreignKey' => 'proveedor_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('TipoMoneda', [
            'foreignKey' => 'moneda_id',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('OrdenDetalles', [
            'foreignKey'    => 'orden_id',
            'dependent'     => true,     // borro tambien a hijos si borro orden de compra.
            'cascadeCallbacks' => true,  // aplico dependents correctamente
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
            ->date('fecha_emision')
            ->requirePresence('fecha_emision', 'create')
            ->notEmptyDate('fecha_emision');

        $validator
            ->date('fecha_vencimiento')
            ->allowEmptyDate('fecha_vencimiento');

        $validator
            ->scalar('observaciones')
            ->allowEmptyString('observaciones');

        $validator
            ->scalar('forma_pago')
            ->maxLength('forma_pago', 50)
            ->requirePresence('forma_pago', 'create')
            ->notEmptyString('forma_pago');

        $validator
            ->scalar('forma_envio')
            ->maxLength('forma_envio', 50)
            ->requirePresence('forma_envio', 'create')
            ->notEmptyString('forma_envio');

        $validator
            ->scalar('estado')
            ->allowEmptyString('estado');

        $validator
            ->decimal('total_orden_compra')
            ->requirePresence('total_orden_compra', 'create')
            ->notEmptyString('total_orden_compra');

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
        $rules->add($rules->existsIn(['proveedor_id'], 'Proveedores'));
        $rules->add($rules->existsIn(['moneda_id'], 'TipoMoneda'));

        return $rules;
    }
}
