<?php
declare(strict_types=1);
namespace common\helpers;

use Yii;

class ActiveRouteHelper {

    /**
     * @param string|array $controllerIds
     * @param string|array|null $actionIds
     * @param string|array|null $moduleIds
     * @return bool
     */
    public static function isActive($controllerIds, $actionIds = null, $moduleIds = null): bool
    {
        $controllerIds = self::normalize($controllerIds);
        $actionIds = $actionIds === null ? [] : self::normalize($actionIds);
        $moduleIds = $moduleIds === null ? [] : self::normalize($moduleIds);

        return self::compare($controllerIds,$actionIds,$moduleIds);
    }

    protected static function normalize($item): array
    {
        if(is_string($item))
        {
            return  [$item];
        }

        return $item;
    }

    protected static function compare(array $controllerIds, array $actionIds, array $moduleIds): bool
    {
        $result = in_array(Yii::$app->controller->id, $controllerIds);
        if (!empty($actionIds)) {
            $result = $result && in_array(Yii::$app->controller->action->id, $actionIds);
        }
        if (!empty($moduleIds)) {
            $result = $result && in_array(Yii::$app->controller->module->id, $moduleIds);
        }
        return $result;
    }
}
