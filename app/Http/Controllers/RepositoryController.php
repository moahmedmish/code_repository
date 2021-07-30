<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterDataRequest;
use App\Services\RepositoryIntegrationServices;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RepositoryController extends Controller
{
    /*
     * @var OBJECT repositoryIntegrationServices
     * */
    private $repositoryIntegrationServices;

    /**
     * INJECT SEARCH Repository Code SERVICES TO ACCESS THOSE SERVICES.
     *
     * HotelsController constructor.
     *
     * @param RepositoryIntegrationServices $hotelIntegrationServices
     */
    public function __construct(RepositoryIntegrationServices $repositoryIntegrationServices)
    {
        $this->repositoryIntegrationServices = $repositoryIntegrationServices;
    }

    /**
     * GET DATA FROM Code Repository.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(FilterDataRequest $request,$code_repository)
    {
        $finalResults = $this->repositoryIntegrationServices->filterData($request->all(),$code_repository);

        if (! $finalResults && count($finalResults)) {
            return $this->_ReturnJsonResponse('Failed Operation : Something Went Wrong ...!', [], [], Response::HTTP_BAD_REQUEST);
        }

        return $this->_ReturnJsonResponse('Successfully Operation.', [], $finalResults, Response::HTTP_OK);
    }
}
