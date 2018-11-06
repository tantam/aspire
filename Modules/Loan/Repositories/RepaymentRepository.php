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
/**
 * Class RepaymentRepository
 * @package Modules\Loan\Repositories
 *
 * @method  Repayment find($id)
 * @method  Repayment create($data)
 * @method  Repayment update($model, array $data)
 * @method  bool|null destroy($model)
 * @method  \Illuminate\Database\Eloquent\Collection || Repayment[] all
 */
interface RepaymentRepository extends BaseRepository
{
    public function getTotalAmountRePaid(Loan $loan);
}
