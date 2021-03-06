<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тэги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tags-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить тэг', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'Title',
                'value' => function($model)
                {
                    return Html::a($model->title , ['/tags/update' , 'id'=> $model->id]);
                },
                'format' => 'raw'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
