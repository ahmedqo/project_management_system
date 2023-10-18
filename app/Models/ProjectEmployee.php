<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectEmployee extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'project_employee';

    protected $fillable = [
        'project',
        'employee',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee', 'id');
    }
}
