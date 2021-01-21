<?php declare(strict_types=1);

namespace common\widgets;

use yii\base\Widget;

/**
 * Class BaseViewWidget
 * @package common\widgets
 */
class BaseViewWidget extends Widget
{
    public ?string $viewName = null;

    protected array $viewBag = [];

    /**
     * Executes the widget.
     * @return string the result of widget execution to be outputted.
     * @throws \ReflectionException
     */
    public function run()
    {
        return $this->defaultRender();
    }

    protected function getViewBag(): array
    {
        return $this->viewBag;
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    protected function defaultRender()
    {
        $this->resolveViewName();

        return $this->render($this->viewName, $this->getViewBag());
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    protected function resolveViewName(): string
    {
        if (!$this->viewName) {
            // default View name should be equally to name of widget class
            $this->viewName = (new \ReflectionClass($this))->getShortName();
        }
        return $this->viewName;
    }

}
