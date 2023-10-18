<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'client',
        'manager',
        'name',
        'dueDate',
        'budget',
        'status',
        'description'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client', 'id');
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager', 'id');
    }
}
