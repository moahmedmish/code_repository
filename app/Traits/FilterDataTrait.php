<?php

namespace App\Traits;

trait FilterDataTrait
{
    /**
     * @param $data array
     *
     * @param $sortBy
     *
     * @return array
     */
    public function sortASC(array $data, $sortBy)
    {
        return collect($data)->sortBy($sortBy)->values()->all();
    }

    /**
     * @param $collection
     * @param $limit
     * @return mixed
     */
    public function limitData($collection , $limit)
    {
        return $collection->take($limit);
    }

    public function filterByLanguage($collection ,$column ,$language)
    {
        return $collection->where($column,$language);
    }

}
