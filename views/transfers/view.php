<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Transfers */

$this->title = $model->date;
?>
<div class="transfers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'from',
            'to',
           // 'ammount',
            [
                'attribute' => 'ammount',
                'value' => function($model) {
                    return \Yii::$app->formatter->asCurrency($model->ammount/100, 'usd');
                }
            ],
            'date:datetime',
        ],
    ]) ?>

</div>
