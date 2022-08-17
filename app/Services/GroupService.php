<?php

namespace App\Services;

use App\Models\Group;

class GroupService
{
    public static function get($id)
    {
        return Group::find($id);
    }

    public static function create($name)
    {
        return Group::create(["name" => $name, "status" => 1]);
    }

    public static function setStatusComplete($id)
    {
        $group = Group::find($id);
        $group->status = 2;
        $group->save();

        return $group;
    }

    public static function setStatusStop($id)
    {
        $task = Group::find($id);
        $task->status = 3;
        $task->save();
        TaskService::setStatusStopByGroup($id);

        return $task;
    }
}
