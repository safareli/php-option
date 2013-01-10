<?php
namespace PlasmaConduit\option;

interface Option {

    public function isEmpty();
    public function nonEmpty();
    public function get();
    public function getOrElse($default);
    public function orElse(Option $alternative);
    public function orNull();
    public function toLeft($right);
    public function toRight($left);
    public function map($f);

}