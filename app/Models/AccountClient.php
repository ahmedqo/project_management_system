<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountClient extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'account_client';

    protected $fillable = [
        'client',
        'account',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client', 'id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account', 'id');
    }
}
