<?php

namespace Modules\Loan\Entities;

use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{
    const APPROVED_STATUS = 1;
    const REJECTED_STATUS = 0;

    protected $fillable = [
        'loan_id',
        'amount',
        'status',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id');
    }

}
