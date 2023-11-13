<?php

/** @var yii\web\View $this */

use common\models\RandomImageDecision;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Random Image Decisions';
?>
<div class="site-index">
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col">
                <?= GridView::widget([
                    'dataProvider' => new ActiveDataProvider([
                        'query' => RandomImageDecision::find(),
                        'pagination' => [
                            'pageSize' => 20,
                        ],
                    ]),
                    'columns' => [
                        [
                            'attribute' => 'image_id',
                            'label' => 'Image',
                            'format' => 'raw',
                            'value' => fn($data) => "<a target='_blank'
                                href='https://picsum.photos/id/{$data->image_id}/200/300'>{$data->image_id}</a>",
                        ],
                        [
                            'attribute' => 'result',
                            'label' => 'Decision',
                            'format' => 'boolean',
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{delete}',
                            'buttons' => [
                                'delete' => fn($url, $model, $key) => Html::a('Delete', [
                                    '/random-image-decision/delete', 'id' => $model->id
                                ], [
                                    'data-confirm' => 'Are you sure you want to delete this decision?',
                                    'data-method' => 'post',
                                ])
                            ],
                        ],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
