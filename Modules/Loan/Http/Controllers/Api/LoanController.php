<?php
/**
 * Created by PhpStorm.
 * Loan: tam
 * Date: 6/11/18
 * Time: 5:21 PM
 */

namespace Modules\Loan\Http\Controllers\Api;


use App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use Modules\Loan\Http\Requests\CreateLoanRequest;
use Modules\Loan\Repositories\LoanRepository;
use Modules\Loan\Repositories\RepaymentRepository;
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
     * @var RepaymentRepository
     */
    protected $repaymentRepository;

    /**
     * LoanController constructor.
     * @param LoanRepository $loanRepository
     * @param UserRepository $userRepository
     * @param RepaymentRepository $repaymentRepository
     */
    public function __construct(LoanRepository $loanRepository, UserRepository $userRepository, RepaymentRepository $repaymentRepository)
    {
        $this->loanRepository = $loanRepository;
        $this->userRepository = $userRepository;
        $this->repaymentRepository = $repaymentRepository;
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
        $loan->load('repayments');
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

        $loan->load('repayments');

        return $this->responseSuccess(new LoanResource($loan));
    }

    public function payRepayment($user_id, $loan_id, $repayment_id){

        $user = $this->userRepository->find($user_id);
        $loan = $this->loanRepository->findLoanByUser($user, $loan_id);
        $repayment = $this->repaymentRepository->getModel()->where('id',$repayment_id)->where('loan_id', $loan->id)->firstOrFail();


        $loan = $this->loanRepository->payRepayment($loan,$repayment);

        $loan->load('repayments');

        return $this->responseSuccess(new LoanResource($loan));

    }

}
