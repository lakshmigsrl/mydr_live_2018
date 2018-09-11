<?php
namespace App\Model\Table;

use App\Model\Entity\Author;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Authors Model
 *
 * @property \Cake\ORM\Association\HasMany $Articles
 */
class AuthorsTable extends Table
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

        $this->table('authors');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Url');

        $this->addBehavior('Timestamp');

        $this->hasMany('Articles', [
            'foreignKey' => 'author_id'
        ]);
        $this->hasMany('Tools', [
          'foreignKey' => 'author_id'
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

        return $validator;
    }

    public function beforeSave($event, $entity, $options)
    {
        // without any URL filed updatem make slug
        if ($entity->url === "") {
            $entity->url = $this->generateUrl($entity->name);
        }
    }
}
