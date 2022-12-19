<?php

namespace App\Lib;

class Response
{
    public static function result($status = true, $message="", $data = [])
    {
        return response()->json([
          "status" => $status,
          "message" => $message,
          "data" => $data
        ]);
    }
}
