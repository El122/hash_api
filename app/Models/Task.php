<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ["frequency", "string", "result_string", "repetitions", "algorithm", "salt", "status", "group"];

    public function statusData()
    {
        return $this->hasOne(TaskStatus::class, "id", "status");
    }
}
