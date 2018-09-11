<?php
namespace App\Model\Table;

use App\Model\Entity\Section;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sections Model
 *
 * @property \Cake\ORM\Association\HasMany $Articles
 */
class SectionsTable extends Table
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

        $this->table('sections');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Articles', [
            'foreignKey' => 'section_id',
            'conditions' => ['Articles.status' => 1],
          ]
        );

        $this->hasMany('SectionSlides');

        $this->belongsToMany('TopArticles', [
            'className' => 'Articles',
            'joinTable' => 'articles_sections',
            'foreignKey' => 'section_id',
            'targetForeignKey' => 'article_id',
            'conditions' => ['TopArticles.status' => 1],
        ]);

        /* Medicines is actually the CmiProducts or CMIs */
        $this->belongsToMany('TopMedicines', [
            'className' => 'CmiProducts',
            'joinTable' => 'cmi_products_sections',
            'foreignKey' => 'section_id',
            'targetForeignKey' => 'cmi_product_id'
        ]);

        $this->belongsToMany('Tools');

        // Add the behaviour to your table
        $this->addBehavior('Search.Search');
        $this->searchManager()
          ->add('q', 'Search.Like', [
            'before' => true,
            'after' => true,
            'field' => [$this->aliasField('name')]
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('url', 'create')
            ->notEmpty('url');

        $validator
            ->requirePresence('keywords', 'create')
            ->notEmpty('keywords');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
}
