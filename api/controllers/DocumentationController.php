<?php

declare(strict_types=1);

namespace api\controllers;

use light\swagger\SwaggerAction;
use light\swagger\SwaggerApiAction;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class DocumentationController extends Controller
{
    /**
     * @return array
     */
    public function actions(): array
    {
        return [
            'doc' => [
                'class' => SwaggerAction::class,
                'restUrl' => Url::to(['/documentation/api'], true),
            ],
            'api' => [
                'class' => SwaggerApiAction::class,
                'scanDir' => [
                    Yii::getAlias('@api/swagger'),
                    Yii::getAlias('@app/controllers'),
                    Yii::getAlias('@app/forms'),
                ],
            ],
        ];
    }
}
