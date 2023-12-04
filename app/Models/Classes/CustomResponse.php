<?php

namespace App\Models\Classes;

class CustomResponse
{
    public $status;
    public $data;
    public $message;

    public function __construct(
        $status,
        $data,
        $message
    ) {
        $this->status = $status;
        $this->data = $data;
        $this->message = $message;
    }
}
