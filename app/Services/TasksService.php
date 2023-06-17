<?php

namespace App\Services;

use App\DTO\TaskDTO;
use App\Models\Task;

class TasksService
{
    private const STATUS_NEW        = 'new';
    private const STATUS_IN_PROCESS = 'in_process';
    private const STATUS_CLOSED     = 'closed';

    public const STATUSES = [
        self::STATUS_NEW,
        self::STATUS_IN_PROCESS,
        self::STATUS_CLOSED,
    ];

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
