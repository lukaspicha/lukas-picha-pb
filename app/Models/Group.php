<?php

namespace Models;
class Group implements \Iterator {
    
    private $position;
    private $data;

    private static $instance = false;

    public static function getInstance($data) {
        if(self::$instance === false){ 
            self::$instance = new Group($data); 
        } 
        return self::$instance; 
    }

    private function __construct($data = []) {
        $this->data = $data;
        $this->position = 0;
    }

    public function current() : Person {
        $row = $this->data[$this->position];
        return new Person($row['id'], $row['firstname'], $row['lastname'], $row['sex'], $row['birthday']);
    }

    public function key() {
        return $this->current()->getIteratorKey();
    }

    public function next(){
        ++$this->position;
    }

    public function rewind() {
        return $this->position = 0;
    }

    public function valid() : bool { 
       return isset($this->data[$this->position]);
    }

    public function count() : int
    {        
        return count($this->data);
    }
}