<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class ApiSuccessResponse implements Responsable
{
    public function __construct(protected mixed $data, protected array $message = [], protected int $status = Response::HTTP_OK, protected array $headers = [])
    {

    }

    public function toResponse($request)
    {
        return response()->json(['data' => $this->data, 'message' => $this->message], $this->status, $this->headers);
    }
}
