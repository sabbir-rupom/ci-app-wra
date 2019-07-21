<?php
/**
 * Sidebar menu definitions in array
 */
$sideMenuList = [
    [
        'title' => 'Dashboard',
        'activeSlug' => 'ds',
        'link' => base_url('admin/dashoard'),
        'iconClass' => 'fa fa-dashboard',
        'child' => null
    ], [
        'title' => 'Users',
        'iconClass' => 'fa fa-users',
        'activeSlug' => 'us',
        'link' => base_url('admin/user/list'),
        'child' => null
    ], [
        'title' => 'Items',
        'activeSlug' => 'it',
        'link' => '#itemSection',
        'iconClass' => 'fa fa-cubes',
        'child' => [
            [
                'title' => 'Add New',
                'link' => base_url('admin/item/add'),
                'iconClass' => 'fa fa-plus'
            ], [
                'title' => 'Show List',
                'link' => base_url('admin/item/list'),
                'iconClass' => 'fa fa-list-ul'
            ]
        ]
    ], [
        'title' => 'Settings',
        'iconClass' => 'fa fa-cogs',
        'activeSlug' => 'st',
        'link' => base_url('admin/settings'),
        'child' => null
    ]
];
?>

<aside class="sidebar">
    <div class="sidebar-header text-center">
        Admin Panel <span class="fa fa-font hide"></span>
    </div>
    <ul class="list-group list-group-flush sidebar-menu">
        <?php
        foreach ($sideMenuList as $menu) {
            /**
             * Check for current menu
             */
            $active = false;
            if (isset($activeMenu) && $menu['activeSlug'] == $activeMenu) {
                $active = true;
            }

            echo '<li class="list-group-item list-group-item-action px-0 menu-item">';

            /**
             * Check if menu has sub-menu or not
             */
            if (is_array($menu['child'])) {
                /**
                 * Prepare Sub-menu html contents
                 */
                $childID = str_replace('#', '', $menu['link']);
                $childMenuContent = '<div class="collapse ' . ($active ? 'show' : '') . '" id="' . $childID . '">';
                $childMenuContent .= '<div class="list-group child-menu">';
                foreach ($menu['child'] as $child) {
                    $childMenuContent .= '<a href="' . $child['link'] . '" class="list-group-item menu-item">';
                    $childMenuContent .= '<span class="fa ' . (isset($child['iconClass']) ? $child['iconClass'] : 'fa-circle-o') . '"></span> <span class="name">' . $child['title'] . '</span>';
                    $childMenuContent .= '</a>';
                }
                $childMenuContent .= '</div>';

                // collapsible menu link tag
                echo '<a class="' . ($active ? 'active' : 'collapsed') . '" '
                . 'data-toggle="collapse" href="' . $menu['link'] . '" role="button" '
                . 'aria-expanded="' . ($active ? 'true' : 'false') . '" '
                . 'aria-controls="' . $childID . '">';
            } else {
                $childMenuContent = '';
                echo '<a class=" ' . ($active ? 'active' : '') . '" href="' . $menu['link'] . '">';
            }

            echo '<span class="' . $menu['iconClass'] . '"></span> '
            . '<span class="name">' . $menu['title'] . '</span> '
            . (empty($childMenuContent) ? '' : '<span class="mr-3 caret"></span>');

            echo '</a>' . $childMenuContent . '</li>';
        }
        ?>

        <!--  CODE SAMPLE 
        
        <li class="list-group-item list-group-item-action px-0 menu-item">
            <a href="#">
                <span class="fa fa-font"></span> <span class="name">Menu 1</span>
            </a>
        </li>
        <li class="list-group-item list-group-item-action px-0 menu-item">
            <a class="collapsed" data-toggle="collapse" href="#menuSection" role="button" aria-expanded="true" aria-controls="menuSection">
                <span class="fa fa-font"></span> <span class="name">Menu 2</span> <span class="mr-3 caret"></span>
            </a>
            <div class="collapse" id="menuSection">
                <ul class="list-group child-menu">
                    <a href="#" class="list-group-item menu-item">
                        <span class="fa fa-circle-o"></span> <span class="name">Child 1</span>
                    </a>
                    <a href="#" class="list-group-item menu-item">
                        <span class="fa fa-circle-o"></span> <span class="name">Child 2</span>
                    </a>
                </ul>
            </div>
        </li>
        
        -->
    </ul>
</aside>