<?php

namespace Modules\Loan\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'duration',
        'repayment_frequency',
        'interest_rate',
        'arrangement_fee',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function repayments()
    {
        return $this->hasMany(Repayment::class, 'loan_id');
    }
}
