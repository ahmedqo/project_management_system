<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'phone',
        'identity',
        'firstName',
        'lastName',
        'address',
        'state',
        'city',
        'zipcode',
        'identityType',
        'birthDate',
        'gender',
        'status',
        'department',
        'designation',
        'insurance',
        'password',
        'photo',
        'bg'
    ];

    protected $hidden = [
        'password',
    ];

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department', 'id');
    }

    public function insurance()
    {
        return $this->belongsTo(Insurance::class, 'insurance', 'id');
    }
}
