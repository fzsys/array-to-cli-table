<?php

namespace App;

class Model
{

    private $dataArray;
    private $headerList = [];

    public function __construct()
    {
        $source_file = $this->getSourceFileFromDir(DATA_PATH);

        $this->dataArray = include_once(DATA_PATH . '/' . $source_file);

        $this->createHeaderList();
        $this->sortData();

    }

    private function getSourceFileFromDir($dir)
    {
        $files = scandir($dir);
        foreach ($files as $k => $file) {
            if ($file == '.' || $file == '..') {
                unset($files[$k]);
            }
        }
        if (count($files) > 1) {
            die("In the \"data\" folder should be only one .php file with source array\r\n");
        }
        return array_values($files)[0];
    }

    private function createHeaderList()
    {
        foreach ($this->dataArray as $sub_arr) {
            foreach ($sub_arr as $k => $v) {
                if (in_array($k, $this->headerList)) {
                    continue;
                }
                array_push($this->headerList, $k);
            }
        }
        sort($this->headerList);
    }

    private function sortData()
    {
        foreach ($this->dataArray as $arr_k => $arr) {
            $new_arr = [];
            foreach ($arr as $k => $v) {
                if (in_array($k, $this->headerList)) {
                    $new_arr[array_search($k, $this->headerList)] = $v;
                }
            }

            for ($i = 0; $i <= count($this->headerList) - 1; $i++) {
                if (!array_key_exists($i, $new_arr)) {
                    $new_arr[$i] = false;
                }
            }

            ksort($new_arr);

            unset($this->dataArray[$arr_k]);
            $this->dataArray[$arr_k] = $new_arr;
        }
    }

    public function getData()
    {
        return ['arr' => $this->dataArray, 'headers' => $this->headerList];
    }

}