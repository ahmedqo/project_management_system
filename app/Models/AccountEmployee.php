<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountEmployee extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'account_employee';

    protected $fillable = [
        'employee',
        'account',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee', 'id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account', 'id');
    }
}
