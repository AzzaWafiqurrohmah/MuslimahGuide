<?php

namespace MuslimahGuide\trait;

trait APIResponser
{
    public function success(string $message = '')
    {
        $response = [
            'status' => 1,
            'message' => $message
        ];

        header('Content-Type: application/json');
        echo json_encode($response, JSON_UNESCAPED_UNICODE); // Menghindari karakter non-ASCII di-escape
    }

    public function successValue(string $value ,string $message = '', string $dataKey = 'data')
    {
        $response = [
            'status' => 1,
            'message' => $message,
            $dataKey => $value
        ];

        header('Content-Type: application/json');
        echo json_encode($response, JSON_UNESCAPED_UNICODE); // Menghindari karakter non-ASCII di-escape
    }

    public function successArray(array $data = [], string $message = '')
    {
        $response = [
            'status' => 1,
            'message' => $message,
            'data' => $data
        ];

        header('Content-Type: application/json');
        echo json_encode($response, JSON_UNESCAPED_UNICODE); // Menghindari karakter non-ASCII di-escape
    }

    public function error(string $message = '')
    {
        $response = [
            'status' => 0,
            'message' => $message
        ];

        header('Content-Type: application/json');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
}
