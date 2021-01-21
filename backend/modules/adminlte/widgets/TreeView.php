<?php declare(strict_types=1);

namespace backend\modules\adminlte\widgets;

use backend\components\enums\RoutesEnum;
use common\helpers\ActiveRouteHelper;
use common\widgets\BaseViewWidget;
use Yii;
use yii\helpers\Url;

class TreeView extends BaseViewWidget
{

    public function init(): void
    {
        parent::init();
        $this->viewBag['items'] = $this->initItems();
    }

    protected function initItems(): array
    {
        $baseItems = $this->getItems();
        $this->makeActiveItem($baseItems);
        return $baseItems;
    }

    protected function makeActiveItem(&$items): void
    {
        foreach ($items as $i => &$item) {
            $item['class'] = ['nav-item'];
            if (!empty($item['items'])) {
                $this->makeActiveItem($item['items']);
                foreach ($item['items'] as $subItem) {
                    if ($subItem['is_active']) {
                        $item['is_active'] = true;
                    }
                }
                $item['class'][] = 'has-treeview';
                if ($item['is_active']) {
                    $item['class'][] = 'menu-open';
                }
            }
        }
    }

    protected function getItems(): array
    {
        return [
            [
                'icon' => '<i class="nav-icon fa fa-list"></i>',
                'label' => Yii::t('admin', 'Clients'),
                'is_active' => $this->isActive('client'),
                'url' => Url::to([RoutesEnum::CLIENTS]),
            ],
            [
                'icon' => '<i class="nav-icon fa fa-list"></i>',
                'label' => Yii::t('admin', 'Companies'),
                'is_active' => $this->isActive('company'),
                'url' => Url::to([RoutesEnum::COMPANIES]),
            ],

        ];
    }

    /**
     * @param string|array $controllerIds
     * @param string|array|null $actionIds
     * @param string|array|null $moduleIds
     * @return bool
     */
    protected function isActive($controllerIds, $actionIds = null, $moduleIds = null): bool
    {
        return ActiveRouteHelper::isActive($controllerIds,$actionIds,$moduleIds);
    }
}
