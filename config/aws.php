<?php

use Aws\Laravel\AwsServiceProvider;

return [

    'credentials' => [
        'key'    => env('AWS_KEY'),
        'secret' => env('AWS_SECRET'),
    ],

    'region' => env('AWS_REGION', 'eu-central-1'),
    'version' => 'latest',
    'ua_append' => [
        'L5MOD/' . AwsServiceProvider::VERSION,
    ],
    'sns' => [
        'region' => env('AWS_REGION', 'eu-central-1'),
    ],

];