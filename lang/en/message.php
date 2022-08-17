<?php

return [
    "group" => [
        "create" => [
            "success" => "New group successfully created",
            "notFoundAlg" => "There is no such algorithm",
            "error" =>  "Failed to create new group"
        ],
        "status" => [
            "success" => "Task group status received successfully",
            "notFound" => "This task group does not exist",
            "error" =>  "Failed to get task group status"
        ],
        "stop" => [
            "success" => "Task Group Execution Stopped Successfully",
            "error" =>  "Failed to stop task group execution"
        ],
    ],
    "task" => [
        "get" => [
            "success" => "Task list received successfully",
            "error" =>  "Failed to get task list"
        ],
        "create" => [
            "success" => "New task added successfully",
            "error" =>  "Failed to create new task"
        ],
        "status" => [
            "success" => "Task status received successfully",
            "notFound" => "No such task exists",
            "error" =>  "Failed to get task status"
        ],
        "stop" => [
            "success" => "Task execution successfully stopped",
            "error" =>  "Failed to stop task execution"
        ],
    ],
];
