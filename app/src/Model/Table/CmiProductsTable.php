<?php
namespace App\Model\Table;

use App\Model\Entity\CmiProduct;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CmiProducts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\BelongsTo $ProductTypes
 * @property \Cake\ORM\Association\BelongsTo $Products
 */
class CmiProductsTable extends Table
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

        $this->table('cmi_products');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('CmiLinkProductDocuments', [
              'bindingKey' => 'product_id',
              'foreignKey' => 'actual_product_id',
        ]);
        // Add the behaviour to your table
        $this->addBehavior('Search.Search');
        $this->searchManager()
          ->add('q', 'Search.Like', [
            'before' => true,
            'after' => true,
            'field' => [$this->aliasField('description')]
          ])
          ->add('foo', 'Search.Callback', [
            'callback' => function ($query, $args, $manager) {}
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
            ->allowEmpty('description');

        $validator
            ->allowEmpty('url_name');

        $validator
            ->allowEmpty('url');

        $validator
            ->allowEmpty('full_url');

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
        return $rules;
    }

    public function findByUrl(Query $query, array $options)
    {
        $cmi_full_url = $options['url'];
        return $query->where(['full_url' => $cmi_full_url]);
    }
}
