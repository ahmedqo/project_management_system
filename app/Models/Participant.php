<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation',
        'employee'
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee', 'id');
    }
}
