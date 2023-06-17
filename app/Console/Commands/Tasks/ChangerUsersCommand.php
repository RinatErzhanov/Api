<?php

namespace App\Console\Commands\Tasks;

use App\Models\Task;
use App\Models\User;
use Illuminate\Console\Command;

class ChangerUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:change-user {userId} {taskId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Сменить права на задачу указывая идентификатор задачи и идентификатор пользователя';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $userId = $this->argument('userId');
        $taskId = $this->argument('taskId');

        if (empty($userId) || !ctype_digit($userId) || !User::find($userId)) {
            $this->error('Некорректный id клиента');
            return;
        }

        /** @var Task $task */
        $task = Task::find($taskId);
        if (!$task) {
            $this->error("Задача с id = $taskId не найдена");
            return;
        }
        $task->setAttribute('user_id', $userId);
        $task->save();

        $this->info('Успех');
    }
}
