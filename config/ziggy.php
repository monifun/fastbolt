<?php

return [
    'except' => ['admin.*', 'user.*', 'api.*', 'debugbar.*', 'ignition.*', 'telescope'],
    'groups' => [
        'admin' => ['admin.*', 'logout'],
        'user' => ['user.*', 'logout']
    ]
];
