<?php

namespace Core;

abstract class Logger
{
    protected string $message;
    protected int $message_type;
    protected string $destination;
    protected string $additional_headers;

    public function __construct(string $message, int $message_type=0, string $destination='', string $additional_headers='')
    {
        $this->message = $message;
        $this->message_type = $message_type;
        $this->destination = $destination;
        $this->additional_headers = $additional_headers;
        $this->save_log();
    }

    protected function save_log(): void
    {
        error_log($this->message, $this->message_type, $this->destination, $this->additional_headers);
    }
}