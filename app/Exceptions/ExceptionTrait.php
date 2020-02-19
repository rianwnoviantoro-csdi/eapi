<?php

  namespace App\Exceptions;

  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
  use Illuminate\Database\Eloquent\ModelNotFoundException;
  
  trait ExceptionTrait {
    public function apiException($request, $e) {
      if ($this->isModel($e)) {
        return $this->modelResponse($e);
      }
      if ($this->isHttp($e)) {
        return $this->httpResponse($e);
      }
      return parent::render($request, $exception);
    }

    protected function isModel($e) {
      return $e instanceof ModelNotFoundException;
    }

    protected function isHttp($e) {
      return $e instanceof NotFoundHttpException;
    }

    protected function modelResponse($e) {
      return response()->json([
        'error' => 'Product model not found',
      ], Response::HTTP_NOT_FOUND);
    }

    protected function httpResponse($e) {
      return response()->json([
        'error' => 'Incorect route',
      ], Response::HTTP_NOT_FOUND);
    }
  }
  