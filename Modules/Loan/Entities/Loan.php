<?php

namespace Modules\Loan\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

class Loan extends Model
{
    const OPEN_STATUS = 1;
    const CLOSED_STATUS = 0;
    const FINISHED_STATUS = 2;

    protected $dates  = ['loan_date_at', 'due_date_at'];

    protected $fillable = [
        'user_id',
        'amount',
        'duration',
        'repayment_frequency',
        'interest_rate',
        'arrangement_fee',
        'status',
        'loan_date_at',
        'due_date_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function repayments()
    {
        return $this->hasMany(Repayment::class, 'loan_id');
    }

    public function getRepaymentAmount()
    {
        return round((($this->amount*($this->interest_rate/100))+$this->amount),2);
    }
}
