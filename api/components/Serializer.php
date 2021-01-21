<?php

declare(strict_types=1);

namespace api\components;

use yii\base\Model;
use yii\rest\Serializer as BaseSerializer;

/**
 * This class extend base rest Serializer and wrap all errors and data in json.
 * Class Serializer.
 */
class Serializer extends BaseSerializer
{
    /**
     * @param Model $model
     *
     * @return array
     */
    protected function serializeModelErrors($model): array
    {
        return ['errors' => parent::serializeModelErrors($model)];
    }
}
