<?php
namespace App\Model\Table;

use App\Model\Entity\Tool;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tools Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Authors
 * @property \Cake\ORM\Association\BelongsTo $Publishers
 */
class ToolsTable extends Table
{
    var $constant_options = [
      'status' => [
        0 => 'Unpublished',
        1 => 'Published'
      ]
    ];
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('tools');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Authors', [
          'foreignKey' => 'author_id',
        ]);

        // Add the behaviour to your table
        $this->addBehavior('Search.Search');

        $this->searchManager()
          ->add('author_id', 'Search.Value')
          ->add('status', 'Search.Value', ['field' => $this->aliasField('status'),'name' => 'status'])
          ->add('q', 'Search.Like', [
            'before' => true,
            'after' => true,
            'field' => [$this->aliasField('title')]
          ])
          ->add('foo', 'Search.Callback', [
            'callback' => function ($query, $args, $manager) {
                // Modify $query as required
            }
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('url', 'create')
            ->notEmpty('url');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->requirePresence('body', 'create')
            ->notEmpty('body');

        $validator
            ->requirePresence('keywords', 'create')
            ->notEmpty('keywords');

        $validator
            ->requirePresence('reference', 'create')
            ->notEmpty('reference');

        $validator
            ->requirePresence('image', 'create')
            ->notEmpty('image');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->requirePresence('dilhma_code', 'create')
            ->notEmpty('dilhma_code');

        $validator
            ->integer('type')
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->dateTime('review')
            ->requirePresence('review', 'create')
            ->notEmpty('review');

        $validator
            ->dateTime('reviewed')
            ->requirePresence('reviewed', 'create')
            ->notEmpty('reviewed');

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
        //$rules->add($rules->existsIn(['author_id'], 'Authors'));
        //$rules->add($rules->existsIn(['publisher_id'], 'Publishers'));
        return $rules;
    }

    public function beforeFind( $event, $query,  $options, $primary) {

        // Front side article add this query, if dont use this add admin => true, check Admin/ArticlesController:index
        if(!isset($options['admin']) && $primary !== false){
            $query->where([
              'Tools.status' =>1
            ]);
        }
    }
}
