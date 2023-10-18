<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'client',
        'title',
        'firstName',
        'lastName',
        'email',
        'phone',
        'function',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client', 'id');
    }
}
