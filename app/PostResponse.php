<?php

namespace App;


class PostResponse
{
    public $status;
    public $comment;

    public function __construct($status, $comment) {
        $this->status = $status;
        $this->comment = $comment;
    }
}
