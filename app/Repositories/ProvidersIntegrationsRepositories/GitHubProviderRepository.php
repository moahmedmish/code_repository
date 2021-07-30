<?php

namespace App\Repositories\ProvidersIntegrationsRepositories;

use App\Helpers\GitHubDataSourceMock;
use App\Interfaces\ProvidersIntegrationsInterface;
use App\Traits\FilterDataTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class GitHubProviderRepository implements ProvidersIntegrationsInterface
{
    use FilterDataTrait;
    /**
     * THIS METHOD FIRE CURL REQUEST TO THIS PROVIDER WEB SERVICE TO RETURN DATA ACCORDING FORM REQUEST.
     *
     * @param $data
     *
     * @return mixed|void
     */
    public function getData($filterData)
    {

        //FETCH DATA FROM THIRD PARTY API
        $results = $this->getProviders($filterData);

        $collectionData = collect($results);

        if (array_key_exists('limit', $filterData)) {
            $collectionData = $this->limitData($collectionData, $filterData['limit']);
        }

        if (array_key_exists('language', $filterData)) {
            $collectionData = $this->filterByLanguage($collectionData, 'language', $filterData['language']);
        }

        //FORMAT RESPONSE
        return $this->formatProviderResponse($collectionData);
    }



    /**
     * THIS METHOD TO MAP RESULT DATA TO BE COMPATIBLE WITH OUR SERVICE.
     *
     * @param $finalProviderResults
     *
     * @return array|mixed
     */
    public function formatProviderResponse($result)
    {
        $res = [];
        foreach ($result as $item){
            $provider = [];
            $provider['id'] = $item['id'];
            $provider['node_id'] = $item['node_id'];
            $provider['full_name'] = $item['full_name'];
            $provider['language'] = $item['language'];
            $provider['created_at'] = Carbon::parse($item['created_at'])->format('Y-m-d');
            $provider['star'] = $item['stargazers_count'];
            $provider['html_url'] = $item['html_url'];
            $provider['description'] = $item['description'];
            $res[] = $provider;
        }
        return $res;
    }

    public function getProviders($data)
    {
      if(env('APP_ENV')=='testing'){
          // MOCK CURL REQUEST BASED FACTORY GENERATOR TO TEST OUR CYCLE AND LOGIC IN OUR CODE
          //WE DO NOT DEPEND THE THIRD PARTY TO TEST CODE IT HELP US IF HAPPEN ISSUE
          return GitHubDataSourceMock::generateFakeData();
      }else{
          $base_url = config("repositories_integration_providers.providers.github.base_url");

          $url = $base_url.'?q=created:>'.$data['created_at'].'&sort=stars&order='.$data['order'];
          $response = Http::get($url);
          $responseData =  json_decode($response->body(), true);
          return $responseData['items'];
      }
    }
}
