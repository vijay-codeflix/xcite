<?php

namespace App\Exceptions;

use App\Helpers\ResponseHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use stdClass;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return ResponseHelper::sendError('Data not found', code: Response::HTTP_NOT_FOUND);

            response()->exception(
                [
                    'success' => false,
                    'message' => str_replace('App\\Models\\', '', $exception->getModel()) . ' not found',
                    'result' => new stdClass(),
                ],
                404
            );
        }
        return parent::render($request, $exception);
    }
}
