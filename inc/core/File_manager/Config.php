<?php
return [
    'id' => 'file_manager',
    'folder' => 'core',
    'name' => 'File manager',
    'author' => 'Stackcode',
    'author_uri' => 'https://stackposts.com',
    'desc' => 'Customize system interface',
    'icon' => 'fad fa-folders',
    'color' => '#5156ff',
    'menu' => [
        'tab' => 3,
        'type' => 'top',
        'position' => 1500,
        'name' => 'File manager'
    ],
    'css' => [
        'Assets/css/file_manager.css'
    ],
    'js' => [
        'Assets/plugins/jquery.lazy/jquery.lazy.min.js',
        'Assets/js/file_manager.js'
    ]
];