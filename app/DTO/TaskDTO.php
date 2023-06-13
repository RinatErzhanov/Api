<?php

namespace App\DTO;

final class TaskDTO
{
    /**
     * @param int $userId
     * @param string $tags
     * @param string $name
     * @param string $description
     */
    public function __construct(
        public readonly int $userId,
        public readonly string $tags,
        public readonly string $name,
        public readonly string $description,
    )
    {
    }
}
