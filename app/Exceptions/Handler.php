<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class Handler extends ExceptionHandler {
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
     * @param  \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report (Exception $exception) {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function render ($request, Exception $exception) {
        return $this->prepareJsonResponse($request, $exception);
    }

    /**
     * Convert the given exception to an array.
     *
     * @param  \Exception $e
     * @return array
     */
    protected function convertExceptionToArray (Exception $e) {
        $message = $e->getMessage();
        return config('app.debug') ? [
            'success'   => false,
            'msg'       => $message,
            'exception' => get_class($e),
            'file'      => $e->getFile(),
            'line'      => $e->getLine(),
            'trace'     => collect($e->getTrace())->map(function ($trace) {
                return Arr::except($trace, ['args']);
            })->all(),
        ] : [
            'success' => false,
            'msg'     => $message ?: 'Server Error',
        ];
    }

    /**
     * Prepare a JSON response for the given exception.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return JsonResponse
     */
    protected function prepareJsonResponse ($request, Exception $e) {
        $code = $e->getCode();
        return new JsonResponse(
            $this->convertExceptionToArray($e),
            $code ?: 500,
            [],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        );
    }
}
