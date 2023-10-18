<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation',
        'employee',
        'content',
        'isRead',
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
