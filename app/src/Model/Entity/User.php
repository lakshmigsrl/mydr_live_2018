<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity.
 *
 * @property int $id
 * @property string $login
 * @property \Cake\I18n\Time $last_login
 * @property int $title
 * @property string $fname
 * @property string $initials
 * @property string $lname
 * @property string $nickname
 * @property string $email
 * @property bool $email_status
 * @property string $homepage
 * @property string $pwd
 * @property string $tmp_pwd
 * @property \Cake\I18n\Time $tmp_pwd_expiry
 * @property string $salt
 * @property string $hint
 * @property \Cake\I18n\Time $dob
 * @property string $addr1
 * @property string $addr2
 * @property string $city
 * @property string $state
 * @property string $postcode
 * @property string $country
 * @property bool $updates
 * @property bool $newsletters
 * @property bool $thirdpartyoffers
 * @property bool $surveys
 * @property bool $samples
 * @property bool $trials
 * @property bool $reports
 * @property bool $forums
 * @property string $gender
 * @property string $type
 * @property bool $status
 * @property string $otherhealth
 * @property bool $terms
 * @property \Cake\I18n\Time $update
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $deleted
 * @property int $oldid
 * @property \App\Model\Entity\UserHistory[] $user_history
 * @property \App\Model\Entity\UserLogin[] $user_logins
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    /**
     * パスワード保存時のハッシュ化
     * @param  string $password パスワード文字列
     * @return string           ハッシュ化されたパスワード
     */
    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }
}
