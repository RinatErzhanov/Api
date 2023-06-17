<?php

namespace App\Console\Commands\Tasks;

use App\Models\Task;
use App\Services\TasksService;
use Exception;
use Illuminate\Console\Command;

class RemoverTasksCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:remove {userId} {status} {from} {to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Удалить все задачи по пользователю, статусу и датам создания';

    /**
     * Execute the console command.
     * @throws Exception
     */
    public function handle(): void
    {
        extract($this->arguments());

        if (empty($userId) || !ctype_digit($userId)) {
            $this->error('Некорректный id клиента');
            return;
        }
        if (!in_array($status, TasksService::STATUSES)) {
            $this->error('Некорректный статус');
            return;
        }

        $numberChanges = Task::where('user_id', $userId)
            ->where('status', $status)
            ->whereBetween('created_at', [new \DateTime($from), new \DateTime($to)])
            ->delete();

        $this->info('Количество затронутых записей: '.$numberChanges);
    }
}
