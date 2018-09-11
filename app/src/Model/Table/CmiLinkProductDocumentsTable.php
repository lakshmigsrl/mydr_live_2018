<?php namespace App\Model\Table;

use App\Model\Entity\CmiLinkProductDocument;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CmiLinkProductDocuments Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\BelongsTo $ProductTypes
 * @property \Cake\ORM\Association\BelongsTo $ActualProducts
 * @property \Cake\ORM\Association\BelongsTo $DocTypes
 */
class CmiLinkProductDocumentsTable extends Table
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

        $this->table('cmi_link_product_documents');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('CmiProducts',[
               'foreignKey' => 'actual_product_id',
               'bindingKey' => 'product_id',
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('document_name');

        $validator
            ->allowEmpty('description');

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
        //$rules->add($rules->existsIn(['actual_product_id'], 'ActualProducts'));
        //$rules->add($rules->existsIn(['doc_type_id'], 'DocTypes'));
        $rules->add($rules->existsIn(['actual_product_id'], 'CmiProducts'));
        return $rules;
    }
}
