<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignationHasPermission extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'designation_has_permission';

    protected $fillable = [
        'permission',
        'designation'
    ];

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation', 'id');
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission', 'id');
    }
}
