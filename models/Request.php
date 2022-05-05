<?php

namespace app\models;

class Request
{
    private $data;

    public function getRawBody()
    {
        $json = file_get_contents('php://input');
        $this->data = json_decode($json, true);
    }

    public function getDocumentData()
    {
        return $this->data;
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    public function getData()
    {
        return $this->data;
    }
}