<?php
return [
    'id' => 'tools',
    'folder' => 'core',
    'name' => 'Tools',
    'author' => 'Stackcode',
    'author_uri' => 'https://stackposts.com',
    'desc' => 'Customize system interface',
    'icon' => 'fad fa-pencil-paintbrush',
    'color' => '#36d633',
    'menu' => [
        'tab' => 3,
        'type' => 'top',
        'position' => 1020,
        'name' => 'Tools',
        'icon' => 'fad fa-users',
        'sub_menu' => [
            'position' => 1900,
            'id' => 'group_manager',
            'name' => 'Group manager',
            'icon' => 'fad fa-users',
            'color' => '#ffa500',
        ]
    ]
];