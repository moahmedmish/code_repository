<?php
use App\Enums\RepositoriesEnum;
return [
    /*
    |--------------------------------------------------------------------------
    | Code Repository THIRD PARTY PROVIDERS CONFIGURATIONS.
    |--------------------------------------------------------------------------
    | YOU CAN SET HERE YOUR PROVIDERS HERE. OR NAY BE ADDING NEW ONE LATER.
    */
    'providers' => [
        RepositoriesEnum::GITHUB=>[
            'base_url'=>env('GITHUB_URL','https://api.github.com/search/repositories'),
            'fake_data'=>'github.json',
            'provider'=>'GitHub'
        ],
    ]
];
