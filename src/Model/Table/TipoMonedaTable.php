<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TipoMoneda Model
 *
 * @method \App\Model\Entity\TipoMoneda get($primaryKey, $options = [])
 * @method \App\Model\Entity\TipoMoneda newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TipoMoneda[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TipoMoneda|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TipoMoneda saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TipoMoneda patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TipoMoneda[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TipoMoneda findOrCreate($search, callable $callback = null, $options = [])
 */
class TipoMonedaTable extends Table
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

        $this->setTable('tipo_moneda');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('codigo')
            ->maxLength('codigo', 3)
            ->requirePresence('codigo', 'create')
            ->notEmptyString('codigo');

        $validator
            ->scalar('divisa')
            ->maxLength('divisa', 50)
            ->requirePresence('divisa', 'create')
            ->notEmptyString('divisa');

        $validator
            ->scalar('simbolo')
            ->maxLength('simbolo', 3)
            ->allowEmptyString('simbolo');

        return $validator;
    }
}
