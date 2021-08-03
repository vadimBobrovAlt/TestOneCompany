<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends BaseController
{

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'page' => 'integer|min:1',
            'limit' => 'integer|min:1'
        ]);

        if ($validator->fails())
            return $this->sendError('Ошибка валидации', $validator->errors(), 400);
        $data = (object)$validator->valid();
        $limit = $data->limit ?? 2;

        $tasks = Task::simplePaginate($limit);
        return $this->sendResponse($tasks);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required|max:1000',
        ]);

        if ($validator->fails())
            return $this->sendError('Ошибка валидации', $validator->errors(), 400);
        $data = $validator->valid();

        $task = Task::create($data);

        return $this->sendResponse($task, 'Задача успешно создана', 201);
    }


    public function show($id): \Illuminate\Http\JsonResponse
    {
        $task = Task::find($id);
        return $this->sendResponse($task);
    }

    public function update(Request $request, Task $task): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required|max:1000',
        ]);

        if ($validator->fails())
            return $this->sendError('Ошибка валидации', $validator->errors(), 400);
        $data = $validator->valid();

        $task->update($data);

        return $this->sendResponse($task, 'Задача успешно обновлена');
    }


    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return $this->sendResponse(null, 'Задача успешно удалена');
    }
}
