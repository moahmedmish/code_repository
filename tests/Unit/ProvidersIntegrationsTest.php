<?php

namespace Tests\Feature\Hotels;

use App\Enums\RepositoriesEnum;
use App\Factories\Hotels\ProvidersIntegrations\HotelsProvidersIntegrationsFactory;
use App\Factories\RepositoryProvidersIntegrationsFactory;
use Illuminate\Http\Response;
use Tests\TestCase;

class ProvidersIntegrationsTest extends TestCase
{
    public $providers;

    public function setUp():void
    {
        Parent::setUp();
        $this->providers = config("repositories_integration_providers.providers");;
    }

    /**
     * TO CONFIRM THAT ADD SERVICES IF ADD NEW Code Repository
     *
     * @test
     */
    public function it_should_return_one_providers()
    {
        $this->assertCount(1, $this->providers);
    }

    /**
     * CHECK IF TAKE INSTANCE FROM CLASS
     *
     * @test
     */
    public function it_should_make_new_instance_super_easy()
    {
        $providerOb = RepositoryProvidersIntegrationsFactory::getProviderInstance(RepositoriesEnum::GITHUB);
        $this->assertIsObject($providerOb);
    }

    /** @test */
    public function it_should_call_api_and_get_valid_status_code()
    {
        $responses = $this->get(
            '/api/repositories/github?created_at=2020-01-10&order=desc&limit=5'
        );
        $responses->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function it_should_call__api_and_get_valid_json_format()
    {
        $responses = $this->get(
            '/api/repositories/github?created_at=2020-01-10&order=desc&limit=5'
        );

        $responses->assertStatus(Response::HTTP_OK)
                  ->assertJsonStructure(['Message', 'Errors', 'Data']);
    }


    /** @test */
    public function it_should_call_api_and_get_data()
    {
        $responses = $this->get(
            '/api/repositories/github?created_at=2010-01-10&order=desc'
        );

        $responses->assertStatus(Response::HTTP_OK)
                  ->assertJsonStructure(['Message', 'Errors', 'Data'])
                  ->assertJsonCount(5,'Data');
    }

    /** @test */
    public function it_should_call_api_and_get_valid_json_structure_keys()
    {
        $responses = $this->get(
            '/api/repositories/github?created_at=2010-01-10&order=desc'
        );
        $responses->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['Message', 'Errors', 'Data'])
            ->assertJsonStructure([
                'Message',
                'Errors',
                'Data' => [
                   [
                    "id",
                    "node_id",
                    "full_name",
                    "language",
                    "created_at",
                    "star",
                    "html_url",
                    "description"
                   ]
                ],
            ]);
    }


    /** @test */
    public function it_should_call_api_and_sort_by_star_asc()
    {
        $responses = $this->get(
            '/api/repositories/github?created_at=2010-01-10&order=desc'
        );
        $responses->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['Message', 'Errors', 'Data'])
            ->assertJson([
                'Data' => [
                    [
                        'id'=>10,
                        'star'=>10
                    ],
                    [
                        'id'=>9,
                        'star'=>9
                    ],
                ],
            ]);
    }

    /** @test */
    public function it_should_call_api_and_filter_by_language()
    {
        $responses = $this->get(
            '/api/repositories/github?created_at=2010-01-10&order=desc&language=Python'
        );
        $responses->assertStatus(Response::HTTP_OK)
            ->assertJson([
                "Data"=> [
                    [
                        "id"=> 9,
                        "node_id"=>"MDEwOlJlcG9zaXRvcnkyNTQ3NTU3NTc=",
                        "full_name"=> "Palashio/libra",
                        "language"=> "Python",
                        "created_at"=>  "2020-04-10",
                        "star"=> 9,
                        "html_url"=> "https://github.com/Palashio/libra",
                        "description"=> "Ergonomic machine learning for everyone."
                    ],
                    [
                        "id"=> 7,
                        "node_id"=>"MDEwOlJlcG9zaXRvcnkzMzY1MzEzODA=",
                        "full_name"=> "iam-abbas/Reddit-Stock-Trends",
                        "language"=> "Python",
                        "created_at"=> "2021-02-06",
                        "star"=> 7,
                        "html_url"=> "https://github.com/iam-abbas/Reddit-Stock-Trends",
                        "description"=> "Fetch currently trending stocks on Reddit"
                    ],
                ]
            ]);
    }

    /** @test */
    public function it_should_call_api_and_get_valid_status_code_if_it_production()
    {
        config(['app.env' => 'production']);

        $responses = $this->get(
            '/api/repositories/github?created_at=2010-01-10&order=desc&language=Python'
        );
        $responses->assertStatus(Response::HTTP_OK);
    }
}
