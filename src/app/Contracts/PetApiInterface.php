<?php

declare(strict_types=1);

namespace App\Contracts;

use App\DTOs\PetDto;
use Illuminate\Support\Collection;

/**
 * Interfejs opisujący operacje na zasobie /pet znajdującym się w Swagger Petstore.
 */
interface PetApiInterface
{
    public function addPet(PetDto $pet): void;

    public function getPetById(int $id): ?PetDto;

    /**
     * Zwraca kolekcję zwierzaków o wskazanych statusach.
     *
     * @param  string|array<int,string>  $status
     * @return Collection<PetDto>
     */
    public function findByStatus(string|array $status): Collection;

    public function updatePet(PetDto $pet): void;

    public function deletePet(int $id): void;
} 