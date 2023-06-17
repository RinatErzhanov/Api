<?php

namespace App\Console\Commands\Tasks;

use App\Models\Task;
use App\Services\TasksService;
use Illuminate\Console\Command;

class UpdatingStatusesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:status-update {user} {status}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Перевод всех задач в указанный статус по пользователю';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $userId = $this->argument('user');
        $status = $this->argument('status');

        if (empty($userId) || !ctype_digit($userId)) {
            $this->error('Некорректный id клиента');
            return;
        }
        if (!in_array($status, TasksService::STATUSES)) {
            $this->error('Некорректный статус');
            return;
        }


        $numberChanges = Task::where('user_id', $userId)->update(['status' => $status]);

        $this->info('Количество затронутых записей: '.$numberChanges);
    }
}
