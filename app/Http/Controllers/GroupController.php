<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Jobs\HashTaskJob;
use App\Services\GroupService;
use App\Services\TaskService;
use Illuminate\Support\Facades\Lang;

class GroupController extends Controller
{
    public function create(GroupRequest $request)
    {
        try {
            $tasks = json_decode($request->tasks, true);

            $group = GroupService::create($request->name);

            foreach ($tasks as $task) {
                if (!in_array($task["algorithm"], hash_algos()))
                    return response()->json([
                        "status" => 404,
                        "message" => Lang::get("message.group.create.notFoundAlg"),
                        "data" => $task["algorithm"]
                    ]);
            }

            foreach ($tasks as $task) {
                $newTask =  TaskService::create([
                    "frequency" => $task["frequency"],
                    "string" => $task["string"],
                    "repetitions" => $task["repetitions"],
                    "algorithm" => $task["algorithm"],
                    "salt" => $task["salt"],
                    "status" => 1,
                    "group" => $group->id

                ]);
                HashTaskJob::dispatch($newTask)->onQueue("high");
            }

            return response()->json([
                "status" => 201,
                "message" => Lang::get("message.group.create.success"),
                "data" => $group
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => Lang::get("message.group.create.error")
            ]);
        }
    }

    public function status($id)
    {
        try {
            $group = GroupService::get($id);

            if ($group)
                return response()->json([
                    "status" => 200,
                    "message" => Lang::get("message.group.status.success"),
                    "data" => $group->statusData
                ]);
            return response()->json([
                "status" => 404,
                "message" => Lang::get("message.group.status.notFound"),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => Lang::get("message.group.status.error"),
            ]);
        }
    }

    public function stop($id)
    {
        try {
            GroupService::setStatusStop($id);

            return response()->json([
                "status" => 200,
                "message" => Lang::get("message.group.stop.success"),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => Lang::get("message.group.stop.error"),
            ]);
        }
    }
}
