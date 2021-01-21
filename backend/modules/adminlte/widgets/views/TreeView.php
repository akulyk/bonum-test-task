<?php
use yii\web\View;

/**
 * @var View $this
 * @var array $items
 */

function renderItem ($item) {
    $html = '<li class="'.(is_string($item['class']) ? $item['class'] : implode(' ',$item['class'])).'">
                    <a href="'.$item['url'].'" class="nav-link'.($item['is_active'] ? ' active' : '').'">
                       ' .$item['icon'];
     $html .= '<p>'.$item['label'];
     if (!empty($item['items'])){
          $html .= '<i class="right fas fa-angle-left"></i>';
      }
     $html .= '</p></a>';
     if (!empty($item['items'])){
        $html .='<ul class="nav nav-treeview">';
        foreach ($item['items'] as $subItem){
            $html .= renderItem($subItem);
        }
        $html .= '</ul>';
    }
    $html .= '</li>';
    return $html;
}
?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <?php foreach ($items as $item):?>
           <?=renderItem($item)?>
        <?php endforeach ?>
    </ul>
</nav>
