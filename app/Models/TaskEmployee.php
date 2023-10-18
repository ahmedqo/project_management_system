<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskEmployee extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'task_employee';

    protected $fillable = [
        'task',
        'employee',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee', 'id');
    }
}
