<?php
/**
 * Created by PhpStorm.
 * User: tam
 * Date: 6/11/18
 * Time: 5:52 PM
 */

namespace Modules\Loan\Repositories\Eloquent;


use App\Exceptions\AppException;
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
        $data['due_date'] = strtotime('+' . $data['duration'] . ' months', strtotime($data['loan_date']));

        $loan = $this->create($data);

        $this->generateRepayments($loan);

        return $loan;
    }

    public function getLoansByUser(User $user)
    {
        return $this->getModel()->where('user_id', $user->id)->paginate();
    }

    public function findLoanByUser(User $user, $loan_id)
    {
        return $this->getModel()->where('user_id', $user->id)->firstOrFail();
    }

    protected function generateRepayments(Loan $loan)
    {
        $total_repayment_amount = $loan->getRepaymentAmount();

        $number_of_repayment = round($loan->duration / $loan->repayment_frequency);

        $repayment_amount = $total_repayment_amount / $number_of_repayment;

        for ($i = 1; $i <= $number_of_repayment; $i++) {

            $repayment_month = $i*$loan->repayment_frequency;
            $repayment_due_date = date('Y-m-d', strtotime("+{($repayment_month)} months"));

            if (strtotime($repayment_due_date) > strtotime($loan->due_date)) {
                $repayment_due_date = $loan->due_date;
            }

            $loan->repayments()->create([
                'amount' => $repayment_amount,
                'status' => Repayment::UNPAID_STATUS,
                'due_date' => $repayment_due_date,
            ]);
        }

        return $loan;
    }

    public function payRepayment(Loan $loan, Repayment $repayment)
    {
        if($repayment->status == Repayment::PAID_STATUS){
            throw new AppException("This repayment have been repaid");
        }
        $repayment->status = Repayment::PAID_STATUS;
        $repayment->save();
        $this->finishLoan($loan);
        return $loan;
    }


    protected function finishLoan(Loan $loan)
    {
        if (app(RepaymentRepository::class)->getModel()->where('loan_id', $loan->id)->where('status', Repayment::UNPAID_STATUS)->count() == 0) {
            $loan->status = Loan::FINISHED_STATUS;
            $loan->save();
        }

        return $loan;
    }

}
