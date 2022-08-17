<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Jobs\HashTaskJob;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class TaskController extends Controller
{
    public function get()
    {
        try {
            $tasks = TaskService::getAll();

            return response()->json([
                "status" => 200,
                "message" => Lang::get("message.task.get.success"),
                "data" => $tasks
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => Lang::get("message.task.get.error"),
            ]);
        }
    }

    public function create(TaskRequest $request)
    {
        try {
            $task = TaskService::create([
                "frequency" => $request->frequency,
                "string" => $request->string,
                "repetitions" => $request->repetitions,
                "algorithm" => $request->algorithm,
                "salt" => $request->salt,
            ]);

            HashTaskJob::dispatch($task);

            return response()->json([
                "status" => 201,
                "message" => Lang::get("message.task.create.success"),
                "data" => $task
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => Lang::get("message.task.create.error")
            ]);
        }
    }

    public function status($id)
    {
        try {
            $task = TaskService::get($id);

            if ($task)
                return response()->json([
                    "status" => 200,
                    "message" => Lang::get("message.task.status.success"),
                    "data" => $task->statusData
                ]);
            return response()->json([
                "status" => 404,
                "message" => Lang::get("message.task.status.notFound"),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => Lang::get("message.task.status.error"),
            ]);
        }
    }

    public function stop($id)
    {
        try {
            TaskService::setStatusStop($id);

            return response()->json([
                "status" => 200,
                "message" => Lang::get("message.task.stop.success"),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => Lang::get("message.task.stop.error"),
            ]);
        }
    }
}
