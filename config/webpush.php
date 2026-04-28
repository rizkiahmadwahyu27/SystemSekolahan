<?php

return [
    'vapid' => [
        'subject' => env('VAPID_EMAIL'),
        'publicKey' => env('VAPID_PUBLIC_KEY'),
        'privateKey' => env('VAPID_PRIVATE_KEY'),
    ],
];