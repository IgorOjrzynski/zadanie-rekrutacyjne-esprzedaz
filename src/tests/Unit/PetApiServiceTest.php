<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\DTOs\PetDto;
use App\Services\PetApiService;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PetstoreClient\Api\PetApi;
use PHPUnit\Framework\TestCase;

class PetApiServiceTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function test_add_pet_delegates_to_client(): void
    {
        $client = Mockery::mock(PetApi::class);
        $client->shouldReceive('addPet')->once();

        $service = new PetApiService($client);
        $service->addPet(new PetDto(1, 'Puszek', 'available'));
    }

    public function test_get_pet_by_id_handles_exception(): void
    {
        $client = Mockery::mock(PetApi::class);
        $client->shouldReceive('getPetById')->andThrow(new \PetstoreClient\ApiException());

        $service = new PetApiService($client);
        $this->assertNull($service->getPetById(999));
    }
}
