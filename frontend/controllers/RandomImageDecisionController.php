<?php

declare(strict_types=1);

namespace frontend\controllers;

use Codeception\Util\HttpCode;
use common\models\RandomImageDecision;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

final class RandomImageDecisionController extends Controller
{
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'save' => ['post'],
                    'check-image-id' => ['get'],
                ],
            ],
        ];
    }

    public function beforeAction($action): bool
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return parent::beforeAction($action);
    }

    public function actionSave(): array
    {
        $request = Yii::$app->request;

        $model = new RandomImageDecision();

        if ($model->load($request->post(), '') && !$model->save()) {
            Yii::$app->response->statusCode = HttpCode::UNPROCESSABLE_ENTITY;
            return ['errors' => $model->getErrors()];
        }

        return [];
    }

    public function actionCheckImageId(int $id): array
    {
        return [
            'exists' => RandomImageDecision::find()->where(['image_id' => $id])->exists(),
        ];
    }
}
