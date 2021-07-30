<?php

namespace App\Services;

use App\Factories\RepositoryProvidersIntegrationsFactory;
use App\Traits\FilterDataTrait;

class RepositoryIntegrationServices
{
    /*
     * USE THIS TRAIT TO FILER RESULT AND SORT ARRAY BY KEY VIA COLLECTION
     * */
    use FilterDataTrait;

    /**
     * THIS SERVICE TO COORDINATE OUR SERVICES API WITH THIRD PARTY PROVIDERS INTEGRATIONS.
     *
     * @param $data
     * @return mixed
     */
    public final function filterData($data,$code_repository)
    {

        //USE FACTORY DESIGN PATTERN IF WE INTEGRATE WITH MORE  CODE REPOSITORY
        $provider = RepositoryProvidersIntegrationsFactory::getProviderInstance($code_repository);

       return $provider->getData($data);

    }

}
