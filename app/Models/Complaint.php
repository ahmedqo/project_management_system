<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee',
        'grievance',
        'date',
        'time',
        'location',
        'status',
        'description',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee', 'id');
    }
}
