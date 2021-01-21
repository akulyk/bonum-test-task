<?php

declare(strict_types=1);

namespace api\services;

use DomainException;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;

class ModelHandler
{
    /**
     * @param string     $modelName Must be yii\base\Model::class or one of its inheritor
     * @param array|null $errors    Errors which will be set to model
     * @param array|null $data      Array of data passed to the constructor parameters of created model
     *
     * @return Model
     *
     * @throws InvalidConfigException
     */
    public function createModel(string $modelName, ?array $errors, ?array $data): Model
    {
        if ($errors) {
            return $this->createModelWithErrors($modelName, $errors);
        }
        if ($data) {
            return $this->createModelWithData($modelName, $data);
        }

        throw new DomainException('Either errors or token param must be specified');
    }

    /**
     * @param string $modelName
     * @param array|null $errors
     *
     * @return Model
     *
     * @throws InvalidConfigException
     */
    private function createModelWithErrors(string $modelName, ?array $errors): Model
    {
        /** @var Model $resultForm */
        $resultForm = Yii::createObject($modelName);
        $this->checkIsModelObject($resultForm);
        $resultForm->addErrors($errors);

        return $resultForm;
    }

    /**
     * @param string $modelName
     * @param array|null $data
     *
     * @return Model
     *
     * @throws InvalidConfigException
     */
    private function createModelWithData(string $modelName, ?array $data): Model
    {
        /** @var Model $resultForm */
        $resultForm = Yii::createObject($modelName, $data);
        $this->checkIsModelObject($resultForm);

        return $resultForm;
    }

    /**
     * @param object $resultForm
     *
     * @return void
     *
     * @throws DomainException
     */
    private function checkIsModelObject(object $resultForm): void
    {
        if (! $resultForm instanceof Model) {
            throw new DomainException('FormName is not an instance of yii\base\Model');
        }
    }
}
