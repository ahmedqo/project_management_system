<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project',
        'name',
        'priority',
        'dueDate',
        'duration',
        'status',
        'description',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project', 'id');
    }
}
