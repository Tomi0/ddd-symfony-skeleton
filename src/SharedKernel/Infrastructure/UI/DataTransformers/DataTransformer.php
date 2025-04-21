<?php

namespace SharedKernel\Infrastructure\UI\DataTransformers;

use SharedKernel\Domain\Models\Entity;

interface DataTransformer
{
    /**
     * @param Entity[] $data
     */
    public function transform(array $data): array;

    public function transformOne(Entity $data): array;
}