<?php

return [
    'except' => ['admin.*', 'user.*'],
    'groups' => [
        'admin' => ['admin.*'],
        'user' => ['user.*']
    ]
];
