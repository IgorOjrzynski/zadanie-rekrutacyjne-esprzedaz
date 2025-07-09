<?php

declare(strict_types=1);

namespace App\DTOs;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use PetstoreClient\Model\Pet;

/**
 * Nie-mutowalny nośnik danych pomiędzy warstwami aplikacji.
 */
final readonly class PetDto implements Arrayable, JsonSerializable
{
    public function __construct(
        public ?int $id,
        public string $name,
        public ?string $status = null,
        /** @var string[] */
        public array $photo_urls = [],
    ) {}

    public static function fromModel(Pet $model): self
    {
        return new self(
            id:     $model->getId(),
            name:   $model->getName(),
            status: $model->getStatus(),
            photo_urls: $model->getPhotoUrls() ?? [],
        );
    }

    public function toModel(): Pet
    {
        $model = new Pet();
        if ($this->id !== null) {
            $model->setId($this->id);
        }
        $model->setName($this->name);
        $model->setStatus($this->status);
        $model->setPhotoUrls($this->photo_urls);

        return $model;
    }

    public function toArray(): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'status'     => $this->status,
            'photo_urls' => $this->photo_urls,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
