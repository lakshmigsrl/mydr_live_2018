<?php
namespace App\Model\Table;

use App\Model\Entity\CmiProductAttribute;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CmiProductAttributes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\BelongsTo $ProductTypes
 * @property \Cake\ORM\Association\BelongsTo $Products
 * @property \Cake\ORM\Association\BelongsTo $Attributes
 * @property \Cake\ORM\Association\BelongsTo $Values
 */
class CmiProductAttributesTable extends Table
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

        $this->table('cmi_product_attributes');
        $this->displayField('id');
        $this->primaryKey('id');

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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('sort_order')
            ->allowEmpty('sort_order');

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
        //$rules->add($rules->existsIn(['country_id'], 'Countries'));
        //$rules->add($rules->existsIn(['product_type_id'], 'ProductTypes'));
        //$rules->add($rules->existsIn(['product_id'], 'Products'));
        //$rules->add($rules->existsIn(['attribute_id'], 'Attributes'));
        //$rules->add($rules->existsIn(['value_id'], 'Values'));
        return $rules;
    }
}
