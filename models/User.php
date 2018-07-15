<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "user".
 *
 * @property string $username
 * @property number $balance
 * @property int $created_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    

    public function getId() {
        return $this->getPrimaryKey();
    }

    
    public function validateAuthKey($authKey) {
        throw new NotSupportedException('"validateAuthKey" is not implemented.');;
    }
    
    
    public function getAuthKey() {
        return ;
    }
        /**
     * {@inheritdoc}
     */
    public static function findIdentity($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username' ], 'required'],
            [['balance'], 'number', 'min'=> -1000],
            [['created_at'], 'integer'],
            [['username'], 'string', 'max' => 25],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'balance' => 'Баланс',
            'created_at' => 'Создан',
        ];
    }
    
    
    public function behaviors()
{
    return [
        // Other behaviors
        [
            'class' => TimestampBehavior::class,
            'createdAtAttribute' => 'created_at',
            'updatedAtAttribute' => false,
            'value' => date(time()),
        ],
    ];   
}
}

