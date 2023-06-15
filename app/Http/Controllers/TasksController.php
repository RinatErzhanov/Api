<?php

namespace App\Http\Controllers;

use App\DTO\TaskDTO;
use App\Models\Task;
use App\Services\TasksService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $userId = auth()->user()->getKey();
        $tasks = Task::where('user_id', $userId)->get();

        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, TasksService $task): JsonResponse
    {
        $params = $request->request;

        $taskDTO = new TaskDTO(
            auth()->user()->getKey(),
            $params->get('tags'),
            $params->get('name'),
            $params->get('description'),
        );

        $id = $task->create($taskDTO);

        return response()->json(['id' => $id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(Task::findorFail($id));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $task = Task::find($id);
        $task->update($request->request->all());

        return response()->json([], 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $task = Task::find($id);
        $task->delete();

        return response()->json([], 204);
    }
}
