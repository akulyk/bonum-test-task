<?php

declare(strict_types=1);

namespace api\components\filters;

use Throwable;
use Yii;
use yii\base\ActionFilter;
use yii\base\InvalidConfigException;
use yii\rest\Action;
use yii\web\UnauthorizedHttpException;
use yii\web\User as CoreUserComponent;

class AccessControlFilter extends ActionFilter
{
    public CoreUserComponent $user;
    public array $rules = [];
    public array $ruleConfig = ['class' => AccessRule::class];

    /**
     * ActionFilter constructor.
     *
     * @param CoreUserComponent $user
     * @param array             $config
     * @throws InvalidConfigException
     */
    public function __construct(CoreUserComponent $user, array $config = [])
    {
        parent::__construct($config);

        $this->user = $user;

        foreach ($this->rules as $i => $rule) {
            if (is_array($rule)) {
                $this->rules[$i] = Yii::createObject(array_merge($this->ruleConfig, $rule));
            }
        }
    }

    /**
     * This method is invoked right before an action is to be executed (after all possible filters.)
     *
     * @param Action $action the action to be executed
     * @return bool whether the action should continue to be executed
     * @throws UnauthorizedHttpException
     * @throws Throwable
     */
    public function beforeAction($action): bool
    {
        $request = Yii::$app->getRequest();
        /** @var $rule AccessRule */
        foreach ($this->rules as $rule) {
            if ($rule->allowsApi($action, $request, $this->user)) {
                return true;
            }
        }

        throw new UnauthorizedHttpException(Yii::t('app', 'Wrong token'));
    }
}
