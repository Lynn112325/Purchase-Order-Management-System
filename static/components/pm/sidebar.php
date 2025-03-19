<?php

function render_sidebar()
{

    $sidebar = array(
        [
            'name' => 'Home',
            'url' => 'home',
            'icon' => 'home'
        ],
        [
            'name' => 'Make Order',
            'url' => 'MakeOrder',
            'icon' => 'cart'
        ],
        [
            'name' => 'On Process Orders',
            'url' => 'onprocessorders',
            'icon' => 'run'
        ],
        [
            'name' => 'Order History',
            'url' => 'OrderHistory',
            'icon' => 'history'
        ],
        [
            'name' => 'Inventory',
            'url' => 'inventory',
            'icon' => 'package'
        ],
        [
            'name' => 'Notifications',
            'url' => 'notifications',
            'icon' => 'bell'
        ]
    );

    echo '<div class="col-2">
            <div class="sidebar list-group align-items-center">';

    foreach ($sidebar as $item) {

        echo '<a href="' . $item['url'] . '" class="d-flex align-items-center p-2 list-group-item list-group-item-action">
                    <i class=\'bx bx-' . $item['icon'] . ' ms-1 me-2\'></i>
                    <span class="links_name">' . $item['name'] . '</span>
                </a>';
    }

    echo '</div>
        </div>';
}
