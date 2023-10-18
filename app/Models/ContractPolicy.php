<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractPolicy extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'contract_policy';

    protected $fillable = [
        'contract',
        'policy',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract', 'id');
    }

    public function policy()
    {
        return $this->belongsTo(Policy::class, 'policy', 'id');
    }
}
