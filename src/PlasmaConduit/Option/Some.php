<?php
namespace PlasmaConduit\option;
use PlasmaConduit\Option;

class Some implements Option {

    private $_value;

    public function __construct($value) {
        $this->_value = $value;
    }

    public function isEmpty() {
        return false;
    }

    public function nonEmpty() {
        return true;
    }

    public function get() {
        return $this->_value;
    }

    public function getOrElse($default) {
        return $this->_value;
    }

    public function orElse(Option $alternative) {
        return $this;
    }

    public function orNull() {
        return $this->_value;
    }

    public function toLeft($right) {
        //
    }

    public function toRight($left) {
        //
    }

    public function map($f) {
        return new Some($f($this->_value));
    }

}
