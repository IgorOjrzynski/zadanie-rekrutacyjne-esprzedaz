<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Contracts\PetApiInterface;
use App\DTOs\PetDto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PetControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_view(): void
    {
        $mock = \Mockery::mock(PetApiInterface::class);
        $mock->shouldReceive('findByStatus')->with(['available'])->andReturn(collect([
            new PetDto(1, 'Burek'),
        ]));

        $this->app->instance(PetApiInterface::class, $mock);

        $response = $this->get('/pets');

        $response->assertStatus(200);
        $response->assertViewIs('pets.index');
        $response->assertSee('Burek');
    }
} 