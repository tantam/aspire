<?php
/**
 * Created by PhpStorm.
 * User: tam
 * Date: 6/11/18
 * Time: 5:23 PM
 */

namespace Modules\Loan\Repositories;



use App\Repositories\BaseRepository;
use Modules\Loan\Entities\Loan;
use Modules\Loan\Entities\Repayment;
use Modules\User\Entities\User;
/**
 * Class LoanRepository
 * @package Modules\Loan\Repositories
 *
 * @method  Loan find($id)
 * @method  Loan create($data)
 * @method  Loan update($model, array $data)
 * @method  bool|null destroy($model)
 * @method  \Illuminate\Database\Eloquent\Collection || Loan[] all
 */
interface LoanRepository extends BaseRepository
{
    /**
     * @param User $user
     * @param $data
     * @return Loan
     */
    public function createLoan(User $user, $data);

    /**
     * @param User $user
     * @return mixed
     */
    public function getLoansByUser(User $user);

    /**
     * @param User $user
     * @param $loan_id
     * @return mixed
     */
    public function findLoanByUser(User $user, $loan_id);

    /**
     * @param Loan $loan
     * @param Repayment $repayment
     * @return mixed
     */
    public function payRepayment(Loan $loan, Repayment $repayment);
}
