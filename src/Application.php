<?php

namespace App;

/**
 * Class Application
 * @package App
 */
class Application
{

    protected $data;
    protected $headers;
    protected $columnsLength;


    public function __construct()
    {
        $model = new Model();
        $data = $model->getData();
        $this->data = $data['arr'];
        $this->headers = $data['headers'];

        $this->getHeadersLength();
        $this->getMaxColumnLength();

        $view = new View(['arr' => $this->data, 'headers' => $this->headers, 'columns_length' => $this->columnsLength]);
        $view->render();
    }

    private function getHeadersLength()
    {
        foreach ($this->headers as $k => $header) {
            $this->columnsLength[$k] = strlen($header);
        }
    }

    private function getMaxColumnLength()
    {
        foreach ($this->data as $row) {
            foreach ($row as $row_k => $row_v) {
                if ($row_v !== false && strlen($row_v) > $this->columnsLength[$row_k]) {
                    $this->columnsLength[$row_k] = strlen($row_v);
                }
            }
        }
    }


}