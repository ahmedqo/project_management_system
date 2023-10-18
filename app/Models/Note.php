<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'task',
        'employee',
        'note'
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
