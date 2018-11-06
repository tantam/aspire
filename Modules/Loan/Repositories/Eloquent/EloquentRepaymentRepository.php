<?php
/**
 * Created by PhpStorm.
 * User: tam
 * Date: 6/11/18
 * Time: 5:52 PM
 */

namespace Modules\Loan\Repositories\Eloquent;


use App\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Loan\Entities\Loan;
use Modules\Loan\Entities\Repayment;
use Modules\Loan\Repositories\RepaymentRepository;

class EloquentRepaymentRepository extends EloquentBaseRepository implements RepaymentRepository
{
    public function __construct(Repayment $model)
    {
        parent::__construct($model);
    }

    public function getTotalAmountRePaid(Loan $loan)
    {
        $total = $this->getModel()->where('loan_id',$loan->id)->where('status',Repayment::APPROVED_STATUS)->sum('amount');
        return round($total,2);
    }


}
