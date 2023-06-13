<?php

namespace App\Http\Controllers;

use App\DTO\TaskDTO;
use App\Models\Task;
use App\Services\TasksService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        return Task::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, TasksService $task): array
    {
        $params = $request->request;

        $taskDTO = new TaskDTO(
            $params->get('user_id'),
            $params->get('tags'),
            $params->get('name'),
            $params->get('description'),
        );

        $id = $task->create($taskDTO);

        return ['id' => $id];
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Task
    {
        return Task::findorFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): array
    {
        $task = Task::find($id);
        $task->update($request->request->all());

        return [];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): array
    {
        $task = Task::find($id);
        $task->delete();

        return [];
    }
}
