<?php
namespace App\Model\Table;

use App\Model\Entity\CmiIssue;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CmiIssues Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Issues
 */
class CmiIssuesTable extends Table
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

        $this->table('cmi_issues');
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
            ->allowEmpty('issue');

        $validator
            ->integer('data_version')
            ->allowEmpty('data_version');

        $validator
            ->dateTime('dat_data_version')
            ->allowEmpty('dat_data_version');

        $validator
            ->allowEmpty('copyright');

        $validator
            ->dateTime('dat_release')
            ->allowEmpty('dat_release');

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
        //$rules->add($rules->existsIn(['issue_id'], 'Issues'));
        return $rules;
    }
}
