<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>        
        <?=
        Html::a('Delete', ['delete', 'username' => $model->username], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            //'balance',
            [
                'attribute' => 'balance',
                'value' => function($model) {
                    return \Yii::$app->formatter->asCurrency($model->balance / 100, 'usd');
                }
            ],
            'created_at:datetime',
        ],
    ])
    ?>

</div>
