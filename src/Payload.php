<?php

namespace Syrelia\Auth;

class Payload {

    private $value;
    
    private function __construct($value) {
        $this->value = $value;
    }
    
    public static function create($value) {
        return new self($value);
    }
    
    public function value() {
        return $this->value;
    }

}