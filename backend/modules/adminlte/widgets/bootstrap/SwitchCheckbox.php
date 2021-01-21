<?php declare(strict_types=1);
namespace backend\modules\adminlte\widgets\bootstrap;

use common\widgets\BaseViewWidget;
use yii\base\Model;

class SwitchCheckbox extends BaseViewWidget{

    public Model $model;
    public string $attribute;
    public string $labelText = '&nbsp';
    public string $onText = 'On';
    public string $offText = 'Off';
    public string $offColor = 'danger';
    public string $onColor ='success';

    public function init()
    {
        parent::init();
        $this->viewBag['model'] = $this->model;
        $this->viewBag['attribute'] = $this->attribute;
        $this->viewBag['offColor'] = $this->offColor;
        $this->viewBag['onColor'] = $this->onColor;
        $this->viewBag['labelText'] = $this->labelText;
        $this->viewBag['onText'] = $this->onText;
        $this->viewBag['offText'] = $this->offText;
    }
}
