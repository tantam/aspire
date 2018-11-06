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
use Modules\Loan\Exceptions\CannotRepaymentLoanException;
use Modules\Loan\Repositories\LoanRepository;
use Modules\Loan\Repositories\RepaymentRepository;
use Modules\User\Entities\User;

class EloquentLoanRepository extends EloquentBaseRepository implements LoanRepository
{
    public function __construct(Loan $model)
    {
        parent::__construct($model);
    }

    public function createLoan(User $user, $data)
    {
        $data['user_id'] = $user->id;
        $data['status'] = Loan::OPEN_STATUS;
        $data['due_date_at'] = strtotime('+'.$data['duration'].' months',strtotime($data['loan_date_at']));

        return $this->create($data);
    }

    public function getLoansByUser(User $user)
    {
        return $this->getModel()->where('user_id',$user->id)->paginate();
    }

    public function findLoanByUser(User $user, $loan_id)
    {
        return $this->getModel()->where('user_id',$user->id)->firstOrFail();
    }

    public function repaymentALoan(Loan $loan, $amount)
    {
        $repayment_amount = $loan->getRepaymentAmount();

        $total_amount_repaid = app(RepaymentRepository::class)->getTotalAmountRePaid($loan);

        if($total_amount_repaid >= $repayment_amount){
            throw new CannotRepaymentLoanException('User cannot make a repayment for a loan that\'s already been repaid.');
        }

        if($total_amount_repaid+$amount > $repayment_amount){
            throw new CannotRepaymentLoanException('Given repayment amount is greater than expected repayment amount.');
        }

        $loan->repayments()->create(['amount'=>$amount,'status'=>Repayment::APPROVED_STATUS]);

        $this->finishLoan($loan);

        return $loan;
    }


    protected function finishLoan(Loan $loan){
        if(app(RepaymentRepository::class)->getTotalAmountRePaid($loan) >= $loan->getRepaymentAmount()){
            $loan->status = Loan::FINISHED_STATUS;
        }

        return $loan;
    }

}
