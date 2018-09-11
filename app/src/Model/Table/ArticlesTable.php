<?php
namespace App\Model\Table;

use App\Model\Entity\Article;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Articles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Sections
 * @property \Cake\ORM\Association\BelongsTo $Sources
 * @property \Cake\ORM\Association\BelongsTo $Authors
 * @property \Cake\ORM\Association\BelongsTo $Footers
 */
class ArticlesTable extends Table
{
    var $constant_options = [
        'medical_type' => [
            'anatomy' => 'Anatomy',
            'all_about_your_condition' => 'All About Your Condition',
            'medical_tests' => 'Medical Tests',
            'nutrition' => 'Nutrition',
            'symptoms' => 'Symptoms',
            'treatments' =>'Treatments',
            'exercise_fitness' => 'Exercise & Fitness',
            'pharmacy_self_care' => 'Pharmacy Self-care'
        ],
        'format_type' => [
            '' => 'None',
            'animation' => 'Animation',
            'heath_story' => 'Health Story',
            'illustrated_article' => 'Illustrated Article',
            'news' => 'News',
            'special_feature' => 'Special Feature',
            'standard_article' => 'Standard Article',
            'disease_index' => 'Disease Index',
            'mandatory' => 'Mandatory',
            'fast_facts' => 'Fast Facts',
            'quiz' => 'Quiz',
            'health_tools' => 'Health Tools',
            'risk_assessment' => 'Risk Assessment',
            'event' => 'Event',
            'slideshow' => 'Slideshow',
            'video' => 'Video'
        ],
        'log_type' => [
            'clinical_review' => 'Clinical Review',
            'editorial_review' => 'Editorial Review',
            'image_add' => 'Image: Add',
            'image_amend' => 'Image: Amend',
            'image_delete' => 'Image: Delete',
            'minor_update_editorial' => 'Minor Update: Editorial',
            'minor_update_rx' => 'Minor Update: Rx',
            'original_input' => 'Original Input',
            'original_write' => 'Original Write',
            'proofread' => 'Proofread',
            'taking_in_cr_amends' => 'Taking in CR amends',
            'treatment_major_review' => 'Treatment/Major Review',
            'managing_ed_approval' => 'Managing Ed. Approval',
        ],
      'status' => [
            0 => 'Blank',
            1 => 'Published',
            2 => 'Unpublished',
            3 => 'Disabled',
      ],
      'audience' => [
            0 => '',
            1 => 'Child',
            2 => 'Youth',
            3 => 'Adult'
      ],
      'hi_status' => [
          0 => '',
          1 => 'notRegistered',
          2 => 'Registered'
      ],
      'gender' => [
          0 => '',
          1 => 'Male',
          2 => 'Female',
          3 => 'Either'
      ],
      'licensable' => [
          0 => '',
          1 => 'yes',
          2 => 'no'
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

        $this->table('articles');
        $this->displayField('title');
        $this->primaryKey('id');
        $this->addBehavior('Url');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Sections', [
            'foreignKey' => 'section_id',
        ]);
        $this->belongsTo('Sources', [
            'foreignKey' => 'source_id',
        ]);
        $this->belongsTo('Authors', [
            'foreignKey' => 'author_id',
        ]);
        $this->belongsTo('Footers', [
            'foreignKey' => 'footer_id',
        ]);
        $this->belongsToMany('RelatedArticles', [
          'className' => 'Articles',
          'conditions' => ['RelatedArticles.status' => 1],
          'targetForeignKey' => 'related_article_id',
        ]);
        $this->belongsToMany('Topics', [
            'foreignKey' => 'article_id',
            'targetForeignKey' => 'topic_id',
            'joinTable' => 'articles_topics'
        ]);
        $this->hasOne('Homepages');
        $this->hasMany('ArticleLogs');


        // Add the behaviour to your table
        $this->addBehavior('Search.Search');

        $this->searchManager()
          ->add('id', 'Search.Value', ['field' => $this->aliasField('id'),'name' => 'id'])
          ->add('section_id', 'Search.Value')
          ->add('author_id', 'Search.Value')
          ->add('hi_status', 'Search.Value')
          ->add('format_type', 'Search.Value')
          ->add('medical_type', 'Search.Value')
          ->add('status', 'Search.Value', ['field' => $this->aliasField('status'),'name' => 'status'])
//          ->add('next_review', 'Search.Compare', ['field' => $this->aliasField('next_review'),'name' => 'next_review'
////              , 'defaultValue' => "2016-01-01"
//          ])
          ->add('q', 'Search.Like', [
            'before' => true,
            'after' => true,
//            'field' => [$this->aliasField('title'), $this->aliasField('body'), $this->aliasField('abstract')]
            'field' => [$this->aliasField('title')]
          ])
          ->add('foo', 'Search.Callback', [
            'callback' => function ($query, $args, $manager) {
                // Modify $query as required
            }
          ]);
    }

    public function getLatestArticles(array $options=['limit' => 6]){

        return $this->find('all',[
            'conditions' => ['format_type' => 'news'],
            'order' => ['reviewed' => 'DESC'],
            'contain' => 'Sections',
            'limit' => $options['limit'],
        ])->select(['id', 'title', 'url', 'Sections.url']);
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
            ->requirePresence('body', 'create')
            ->notEmpty('body');

        $validator
            ->requirePresence('format_type', 'create')
            ->notEmpty('format_type');

        $validator
            ->requirePresence('hi_status', 'create')
            ->notEmpty('hi_status');

        $validator
            ->dateTime('next_review')
            ->requirePresence('next_review', 'create')
            ->notEmpty('next_review');

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
        $rules->add($rules->existsIn(['section_id'], 'Sections'));
        $rules->add($rules->existsIn(['source_id'], 'Sources'));
        $rules->add($rules->existsIn(['author_id'], 'Authors'));
        $rules->add($rules->existsIn(['footer_id'], 'Footers'));
//        $rules->add($rules->existsIn(['legacy_id'], 'Legacies'));
        return $rules;
    }

    public function beforeSave($event, $entity, $options)
    {
        // without any URL filed updatem make slug
        if (empty($entity->url)) {
            $entity->url = $this->generateUrl($entity->title);
        }else{
            $entity->url = $this->generateUrl($entity->url);
        }
    }

    public function beforeFind( $event, $query,  $options, $primary) {

        // Front side article add this query, if dont use this add admin => true, check Admin/ArticlesController:index
        if(!isset($options['admin'])){
            if($primary !== false){
            $query->where([
              $this->aliasField('status') => 1,
              'OR' => [
                [
                  'Articles.start_date <=' => date("Y-m-d H:i:s"),'Articles.end_date >=' => date("Y-m-d H:i:s"),
                ],
                [
                  'Articles.start_date is' => null, 'Articles.end_date is' => null,
                ]
              ]
            ]);
            }
        }
    }
}
