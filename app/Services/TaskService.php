<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public static function getAll()
    {
        return Task::all();
    }


    public static function get($id)
    {
        return Task::find($id);
    }

    public static function create($data)
    {
        return Task::create([
            "frequency" => $data["frequency"],
            "string" => $data["string"],
            "repetitions" => $data["repetitions"],
            "algorithm" => $data["algorithm"],
            "salt" => $data["salt"],
            "status" => 1,
            "group" => isset($data["group"]) ? $data["group"] : NULL
        ]);
    }

    public static function setStatusStop($id)
    {
        $task = Task::find($id);
        $task->status = 3;
        $task->save();

        return $task;
    }

    public static function setStatusStopByGroup($id)
    {
        $tasks = Task::where("group", $id)->get();

        foreach ($tasks as $task) {
            $task->status = 3;
            $task->save();
        }

        return $task;
    }

    public static function setStatusComplete($id)
    {
        $task = Task::find($id);
        $task->status = 2;
        $task->save();
        if ($task->group) GroupService::setStatusComplete($task->group);

        return $task;
    }

    public static function updateResult($id, $result)
    {
        $data = Task::find($id);
        $data->result_string = $result;
        $data->save();

        return $data;
    }
}
