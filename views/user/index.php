<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';


?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>    

   
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
          //   'balance',
            [
                'attribute' => 'balance',
                'value' => function($model) {
                    return \Yii::$app->formatter->asCurrency($model->balance, 'usd');
                }
            ],
            'created_at:datetime',
        ],
    ]);
    ?>
</div>
