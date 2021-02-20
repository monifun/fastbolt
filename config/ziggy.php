<?php

return [
    'except' => ['admin.*', 'user.*'],
    'groups' => [
        'admin' => ['admin.*', 'logout'],
        'user' => ['user.*', 'logout']
    ]
];
