<?php
namespace App\Model\Table;

use App\Model\Entity\CmiProductSurvey;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CmiProductSurveys Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CmiProducts
 */
class CmiProductSurveysTable extends Table
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

        $this->table('cmi_product_surveys');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        // Add the behaviour to your table
        $this->addBehavior('Search.Search');
        $this->searchManager()
          ->add('q', 'Search.Like', [
            'before' => true,
            'after' => true,
            'field' => [$this->aliasField('cmi_full_url')]
          ]);

        $this->belongsTo('CmiProducts', [
            'foreignKey' => 'cmi_product_id',
            'joinType' => 'INNER'
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
            ->allowEmpty('cmi_full_url');

        $validator
            ->allowEmpty('answer1');

        $validator
            ->allowEmpty('answer2');

        $validator
            ->allowEmpty('answer3');

        $validator
            ->allowEmpty('data1');

        $validator
            ->allowEmpty('data2');

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
        $rules->add($rules->existsIn(['cmi_product_id'], 'CmiProducts'));
        return $rules;
    }
}
