<?php

namespace App\Exceptions;

use App\Exceptions\ExceptionTrait;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

  use ExceptionTrait;

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
      return $this->apiException($request, $exception);
    }
    return parent::render($request, $exception);
  }
}
