<?php

namespace App\Http\Controllers;

use App\Models\Task;
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
    public function store(Request $request): array
    {
        $params = $request->request;

        $task = new Task();
        $task->setAttribute('user_id', $params->get('user_id'));
        $task->setAttribute('tags', $params->get('tags'));
        $task->setAttribute('name', $params->get('name'));
        $task->setAttribute('description', $params->get('description'));
        $task->setAttribute('updated_at', null);
        $task->save();

        return ['id' => $task->getAttribute('id')];
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
