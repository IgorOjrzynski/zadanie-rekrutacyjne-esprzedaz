<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\PetApiInterface;
use App\DTOs\PetDto;
use Illuminate\Support\Collection;
use PetstoreClient\Api\PetApi;
use PetstoreClient\ApiException;

/**
 * Implementacja interfejsu, cienka  nakładka na wygenerowany PetApi.
 */
final class PetApiService implements PetApiInterface
{
    public function __construct(
        private readonly PetApi $client,
    ) {}

    public function addPet(PetDto $pet): void
    {
        $this->client->addPet($pet->toModel());
    }

    public function getPetById(int $id): ?PetDto
    {
        try {
            $model = $this->client->getPetById($id);
        } catch (ApiException) {
            return null; // brak zwierzaka lub błąd – zwracamy null (UI obsłuży)
        }

        return PetDto::fromModel($model);
    }

    public function findByStatus(string|array $status): Collection
    {
        $models = $this->client->findPetsByStatus((array) $status);

        return collect($models)
            ->map(static fn ($m) => PetDto::fromModel($m));
    }

    public function updatePet(PetDto $pet): void
    {
        $this->client->updatePet($pet->toModel());
    }

    public function deletePet(int $id): void
    {
        $this->client->deletePet($id);
    }
} 