<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class GitHubDataSourceMock
{
    /**
     * GENERATE FAKE DATA TO TEST CYCLE AT FEATURE TEST
     *
     * @return array[]
     */
    public static function generateFakeData()
    {
        $name =  config("repositories_integration_providers.providers.github.fake_data");
        $fake_data = Storage::disk('local')->get('json/'.$name);
        $responseData =  json_decode($fake_data, true);
        return $responseData['items'];
    }
}


