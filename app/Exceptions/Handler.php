<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler {
  protected $dontReport = [
    
  ];
  
  protected $dontFlash = [
    'password',
    'password_confirmation',
  ];
  
  public function report(Exception $exception) {
    parent::report($exception);
  }
  
  public function render($request, Exception $exception) {
    if ($request->expectsJson()) {
      if ($exception instanceof ModelNotFoundException) {
        return response()->json([
          'error' => 'Product model not found',
        ], Response::HTTP_NOT_FOUND);
      }
      if ($exception instanceof NotFoundHttpException) {
        return response()->json([
          'error' => 'Incorect route',
        ], Response::HTTP_NOT_FOUND);
      }
    }
    // dd($exception);
    return parent::render($request, $exception);
  }
}
