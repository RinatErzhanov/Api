<?php

namespace App\Services;

use App\DTO\TaskDTO;
use App\Models\Task;

class TasksService
{
    private const STATUS_NEW = 'new';

    /**
     * @param TaskDTO $taskDTO
     * @return int
     */
    public function create(TaskDTO $taskDTO): int
    {
        $task = new Task();
        $task->setAttribute('user_id', $taskDTO->userId);
        $task->setAttribute('tags', $taskDTO->tags);
        $task->setAttribute('name', $taskDTO->name);
        $task->setAttribute('description', $taskDTO->description);
        $task->setAttribute('updated_at', null);
        $task->setAttribute('status', self::STATUS_NEW);
        $task->save();

        return $task->getAttribute('id');
    }
}
