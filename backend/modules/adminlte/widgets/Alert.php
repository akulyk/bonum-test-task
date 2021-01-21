<?php declare(strict_types=1);

namespace backend\modules\adminlte\widgets;

use common\widgets\BaseViewWidget;
use Yii;

class Alert extends \common\widgets\Alert
{
    public $options = ['class'=>'show'];
    public $timeout = 5;

    public function init()
    {
        $timeout = (int)$this->timeout * 1000;
        $js = <<<JS
        var \$timeout = $timeout;    
        jQuery(function() {
          var alerts = $('.alert');
          setTimeout(function() {
            alerts.removeClass('show');
            alerts.remove();
          },\$timeout);
        });
JS;
        if($timeout) {
            $this->getView()->registerJs($js);
        }
        parent::init();
    }
}
