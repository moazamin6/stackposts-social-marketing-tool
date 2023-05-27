<?php
return [
    'id' => 'memberships',
    'folder' => 'core',
    'name' => 'Memberships',
    'author' => 'Stackcode',
    'author_uri' => 'https://stackposts.com',
    'desc' => 'Customize system interface',
    'icon' => 'fad fa-id-card-alt',
    'color' => '#e90a7b',
    'role' => 1,
    'menu' => [
        'tab' => 5,
        'type' => 'top',
        'position' => 1000,
        'name' => 'Memberships',
        'sub_menu' => [
            'position' => 2000,
            'id' => 'plans',
            'name' => 'Plans',
            'icon' => 'fad fa-box-open',
            'color' => '#009ef7'
        ]
    ]
];