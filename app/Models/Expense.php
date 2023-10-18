<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee',
        'type',
        'date',
        'amount',
        'status',
        'description',
        'note',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee', 'id');
    }
}
