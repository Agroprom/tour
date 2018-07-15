<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransfersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transfers';
?>
<div class="transfers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Transfers', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'from',
            'to',
           // 'amount',
            [
                'attribute' => 'amount',
                'value' => function($model) {
                    return \Yii::$app->formatter->asCurrency($model->amount, 'usd');
                }
            ],

            'date:datetime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
