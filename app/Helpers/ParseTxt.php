<?php

namespace Helpers;
class ParseTxt {
    
    protected $data = [];

    public function __construct() {
       
    }

    public function getData() {
        return $this->data;
    }

    public function importFile($filename,  $delimeter = "\n") {
        
        if (!file_exists($filename)) {
            throw new ParseTxt_ImportException("File {$filename} not found");
        }

        try {

            $filedata = file_get_contents($filename, FILE_IGNORE_NEW_LINES);
            $lines = explode($delimeter, $filedata);
            $this->readData($lines);        

        } catch (Exception $e) {
            throw new ParseTxt_ImportException("Import data error", $e);
        }
    }

    protected function readData($lines = []) {
        for ($i = 0; $i < count($lines); $i += 3) {     

            $fullname_array = explode(" ", $lines[$i]);

            $id = crc32($lines[$i]);
            $another_data_array = explode(" ", $lines[$i + 1]);

            $this->data[] = [
                'id'        => $id,
                'firstname' => $fullname_array[0],
                'lastname'  => $fullname_array[1],
                'sex'       => $another_data_array[0] == "muž" ? "m" : "f",
                'birthday'  => new \DateTime($another_data_array[1]),
            ];
        }
    }

   
}

class ParseTxt_ImportException extends \Exception {}