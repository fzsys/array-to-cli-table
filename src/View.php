<?php

namespace App;

class View
{

    private $data;
    private $tableWidth;

    public function __construct($data)
    {
        $this->data = (array)$data;
        $this->tableWidth = $this->getTableWidth();
    }

    public function render()
    {
        $this->renderHorizontalSeparator('=');

        $this->renderHeader();

        $this->renderHorizontalSeparator('-');

        $this->renderColumns();

        $this->renderHorizontalSeparator('=');
    }

    private function addSpaces($column_key, $word)
    {
        $row_len = $this->data['columns_length'][$column_key];
        $word_len = strlen($word);
        $spaces_len = $row_len - $word_len;
        $spaces = '';
        for ($i = 1; $i <= $spaces_len; $i++) {
            $spaces .= ' ';
        }
        return $spaces;
    }

    private function getTableWidth()
    {
        $width = 0;
        foreach ($this->data['columns_length'] as $str) {
            $width = $width + $str;
            $width += 2;
        }
        $width += count($this->data['headers']) + 1;

        return $width;
    }

    private function renderHorizontalSeparator($char)
    {
        for ($i = 1; $i <= $this->tableWidth; $i++) {
            echo $char;
        }
        echo NL;
    }

    private function renderHeader()
    {
        $c = 1;
        foreach ($this->data['headers'] as $k => $v) {
            if ($c < count($this->data['headers'])) {
                echo '| ' . $this->addSpaces($k, $v) . $v . ' ';
            } else {
                echo '| ' . $this->addSpaces($k, $v) . $v . ' | ' . NL;
            }
            $c++;
        }
    }

    private function renderColumns()
    {
        foreach ($this->data['arr'] as $arr) {
            $c = 1;
            foreach ($arr as $k => $v) {
                $v = $v === false ? '' : $v;
                if ($c < count($arr)) {
                    echo '| ' . $this->addSpaces($k, $v) . $v . ' ';
                } else {
                    echo '| ' . $this->addSpaces($k, $v) . $v . ' | ' . NL;
                }
                $c++;
            }

        }
    }

}