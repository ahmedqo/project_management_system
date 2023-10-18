<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee',
        'body',
        'isRead',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee', 'id');
    }
}
