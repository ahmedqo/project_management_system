<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Termination extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee',
        'reason',
        'date',
        'description'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee', 'id');
    }
}
