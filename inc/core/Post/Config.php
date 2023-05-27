<?php
return [
    'id' => 'post',
    'folder' => 'core',
    'name' => 'Composer',
    'author' => 'Stackcode',
    'author_uri' => 'https://stackposts.com',
    'desc' => 'Customize system interface',
    'icon' => 'fad fa-paper-plane',
    'color' => '#ff0000',
    'menu' => [
        'tab' => 1,
        'type' => 'top',
        'position' => 2000,
        'name' => 'Composer'
    ],
    'js' => [
        "Assets/plugins/selectator/fm.selectator.jquery.js",
        "Assets/js/post.js"
    ],
    'css' => [
        "Assets/plugins/selectator/fm.selectator.jquery.css",
        "Assets/css/post.css"
    ],
    'cron' => [
        'name' => 'Composer',
        'uri' => 'post/cron',
        'style' => '* * * * *',
    ]
];