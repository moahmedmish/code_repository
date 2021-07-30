<?php

namespace App\Interfaces;

interface ProvidersIntegrationsInterface
{
    /**
     * THIS METHOD TO MAKE CURL REQUEST ( GET DATA FROM DATA SOURCE [ PROVIDER ] ).
     *
     * @return mixed
     */
    public function getData($filterData);

    /**
     * THIS METHOD TO MAP REQUEST DATA TO BE COMPATIBLE BASED PROVIDER.
     *
     * @param $data
     * @return mixed
     */
    public function formatProviderResponse($data);

}
