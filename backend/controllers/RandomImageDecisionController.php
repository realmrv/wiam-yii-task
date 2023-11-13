<?php

declare(strict_types=1);

namespace backend\controllers;

use backend\auth\PermanentTokenAuth;
use common\models\RandomImageDecision;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Site controller
 */
final class RandomImageDecisionController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => PermanentTokenAuth::class,
            'only' => ['index'],
        ];
        return $behaviors;
    }

    public function actionDelete(int $id): Response
    {
        if (!$model = RandomImageDecision::findOne($id)) {
            throw new NotFoundHttpException("Decision #{$id} not found");
        }

        $model->delete();

        return $this->redirect($this->request->referrer ?: ['index']);
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }
}
