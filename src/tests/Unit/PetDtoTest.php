<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\DTOs\PetDto;
use PetstoreClient\Model\Pet;
use PHPUnit\Framework\TestCase;

class PetDtoTest extends TestCase
{
    public function test_from_and_to_model_mapping(): void
    {
        $model = new Pet();
        $model->setId(123);
        $model->setName('Burek');
        $model->setStatus('available');
        $model->setPhotoUrls(['https://example.com/dog.jpg']);

        $dto = PetDto::fromModel($model);

        $this->assertSame(123, $dto->id);
        $this->assertSame('Burek', $dto->name);
        $this->assertSame('available', $dto->status);
        $this->assertSame(['https://example.com/dog.jpg'], $dto->photo_urls);

        $modelBack = $dto->toModel();
        $this->assertEquals($model, $modelBack);
    }
} 