<?php

namespace App\Services;

class HashService
{
    static public function startHash($data)
    {
        $counter = 0;
        $seconds = $data->frequency / 1000;
        $resultString = $data->string;

        while ($counter < $data->repetitions && $data->status === 1) {
            $resultString = hash($data->algorithm, $resultString . "_" . $data->salt);
            ++$counter;
            TaskService::updateResult($data->id, $resultString);
            sleep($seconds);
        }

        TaskService::setStatusComplete($data->id);
    }
}
