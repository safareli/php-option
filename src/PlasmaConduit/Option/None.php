<?php
namespace PlasmaConduit\option;
use PlasmaConduit\option\Option;
use Exception;

class None implements Option {

    public function __construct($value) { /**/ }

    public function isEmpty() {
        return true;
    }

    public function nonEmpty() {
        return false;
    }

    public function get() {
        throw new Exception("None#get() should never be called");
    }

    public function getOrElse($default) {
        return $default;
    }

    public function orElse(Option $alternative) {
        return $alternative;
    }

    public function orNull() {
        return null;
    }

    public function toLeft($right) {
        //
    }

    public function toRight($left) {
        //
    }

    public function map($f) {
        return $this;
    }

}
