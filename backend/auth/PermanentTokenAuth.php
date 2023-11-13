<?php

declare(strict_types=1);

namespace backend\auth;

use Yii;
use yii\base\InvalidConfigException;
use yii\filters\auth\AuthMethod;

final class PermanentTokenAuth extends AuthMethod
{
    public const TOKEN_PARAM = 'permanent-token';

    public function authenticate($user, $request, $response): ?true
    {
        $accessToken = $request->get(self::TOKEN_PARAM);

        if ($accessToken === $this->getToken()) {
            return true;
        }

        if ($accessToken !== null) {
            $this->handleFailure($response);
        }

        return null;
    }

    private function getToken(): string
    {
        if (!$token = Yii::$app->params['permanentToken']) {
            throw new InvalidConfigException('Permanent token is not set');
        }

        return $token;
    }
}
