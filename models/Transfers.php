<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "transfers".
 *
 * @property string $from
 * @property string $to
 * @property number $amount
 * @property int $date
 */
class Transfers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transfers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from', 'to', 'amount'], 'required'],
            [['date'], 'integer'],
            [['amount'], 'number', 'min' =>0.01],
            [['from', 'to'], 'string', 'max' => 25],
        ];
    }
    
public function behaviors()
{
    return [
        // Other behaviors
        [
            'class' => TimestampBehavior::class,
            'createdAtAttribute' => 'date',
            'updatedAtAttribute' => false,
            'value' => date(time()),
        ],
    ];   
}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'from' => 'From',
            'to' => 'To',
            'amount' => 'Сумма',
            'date' => 'Date',
        ];
    }
}
