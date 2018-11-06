<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        InvalidInputDataException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if(!$request->wantsJson() && !$this->isApiCall($request)){
            return parent::render($request, $exception);
        }
        switch(true) {
            case $exception instanceof InvalidInputDataException:
                $statusCode = 404;
                $errors = [
                    'message'=>$exception->getMessage(),
                    'code'=>$exception->getCode(),
                ];
                break;
            case $exception instanceof ModelNotFoundException:
                $statusCode = 404;
                $errors = [
                    'message'=>'No result found for '.class_basename($exception->getModel()).' with id '.implode('',$exception->getIds()),
                    'code'=>$exception->getCode(),
                ];
                break;
            case $exception instanceof NotFoundHttpException:
                $statusCode = 404;
                $errors = [
                    'message'=>$exception->getMessage(),
                    'code'=>$exception->getCode(),
                ];
                break;
            default:
                $statusCode = 400;
                $errors = [
                    'message'=>$exception->getMessage(),
                    'code'=>$exception->getCode(),
                ];
        }
        if(config('app.debug')){
            $errors['exception'] = $exception->getTrace();
        }
        return response()->json(['error' => $errors], $statusCode);

    }

    /**
     * Determines if request is an api call.
     *
     * If the request URI contains '/api/v'.
     *
     * @param Request $request
     * @return bool
     */
    protected function isApiCall(Request $request)
    {
        return strpos($request->getUri(), '/api/') !== false;
    }
}
