<?php
/**
 * Created by PhpStorm.
 * Loan: tam
 * Date: 6/11/18
 * Time: 5:21 PM
 */

namespace Modules\Loan\Http\Controllers\Api;


use App\Http\Controllers\ApiController;

use Modules\Loan\Http\Requests\CreateLoanRequest;
use Modules\Loan\Http\Requests\RepaymentALoanRequest;
use Modules\Loan\Repositories\LoanRepository;
use Modules\Loan\Transformers\LoanResource;
use Modules\User\Repositories\UserRepository;

class LoanController extends ApiController
{
    /**
     * @var LoanRepository
     */
    protected $loanRepository;
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * LoanController constructor.
     * @param LoanRepository $loanRepository
     * @param UserRepository $userRepository
     */
    public function __construct(LoanRepository $loanRepository, UserRepository $userRepository)
    {
        $this->loanRepository = $loanRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Get loan list by user id with pagination
     * @param  integer $user_id
     * @return mixed
     */
    public function listByUser($user_id){

        $user = $this->userRepository->find($user_id);

        $users = $this->loanRepository->getLoansByUser($user);

        return $this->responseSuccess(LoanResource::collection($users));
    }
    /**
     *
     * Create new user
     *
     * @param CreateLoanRequest $request
     * @param integer $user_id
     * @return mixed
     */
    public function create(CreateLoanRequest $request, $user_id){

        $input = $request->validated();

        $user = $this->userRepository->find($user_id);

        $loan = $this->loanRepository->createLoan($user, $input);

        return $this->responseSuccess(new LoanResource($loan));
    }

    /**
     * Get loan detail by ID

     * @param integer $user_id
     * @param $loan_id
     * @return mixed
     */
    public function show($user_id, $loan_id){


        $user = $this->userRepository->find($user_id);

        $loan = $this->loanRepository->findLoanByUser($user, $loan_id);

        return $this->responseSuccess(new LoanResource($loan));
    }

    public function repayment($user_id, $loan_id, RepaymentALoanRequest $request ){

        $input = $request->validated();

        $amount = $input['amount'];

        $user = $this->userRepository->find($user_id);
        $loan = $this->loanRepository->findLoanByUser($user, $loan_id);

        $loan = $this->loanRepository->repaymentALoan($loan,$amount);

        $loan->load('repayments');

        return $this->responseSuccess(new LoanResource($loan));

    }

}
