<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ApiErrorResponse implements Responsable
{

    public function __construct(protected Throwable $e, protected array $message = [], protected int $status = Response::HTTP_INTERNAL_SERVER_ERROR, protected array $headers = [])
    {

    }

    public function toResponse($request)
    {
        $response = ['message' => $this->message];
        if ($this->e && config('app.debug')) {
            $response['debug'] = ['message' => $this->e->getMessage(),
                'file' => $this->e->getFile(),
                'line' => $this->e->getLine()];
        }
        return response()->json($response, $this->status, $this->headers);
    }

}
