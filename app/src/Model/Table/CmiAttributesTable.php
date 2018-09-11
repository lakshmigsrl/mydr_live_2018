<?php
namespace App\Model\Table;

use App\Model\Entity\CmiAttribute;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CmiAttributes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\BelongsTo $Attributes
 * @property \Cake\ORM\Association\BelongsTo $SelectionTypes
 */
class CmiAttributesTable extends Table
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

        $this->table('cmi_attributes');
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
            ->allowEmpty('description');

        $validator
            ->integer('include_in_quick_search')
            ->allowEmpty('include_in_quick_search');

        $validator
            ->integer('include_in_advance_search')
            ->allowEmpty('include_in_advance_search');

        $validator
            ->integer('include_in_identa_quick_search')
            ->allowEmpty('include_in_identa_quick_search');

        $validator
            ->integer('include_in_identa_advanced_search')
            ->allowEmpty('include_in_identa_advanced_search');

        $validator
            ->integer('multi_value')
            ->allowEmpty('multi_value');

        $validator
            ->allowEmpty('property_value');

        $validator
            ->integer('is_numeric')
            ->allowEmpty('is_numeric');

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
        //$rules->add($rules->existsIn(['attribute_id'], 'Attributes'));
        //$rules->add($rules->existsIn(['selection_type_id'], 'SelectionTypes'));
        return $rules;
    }
}
