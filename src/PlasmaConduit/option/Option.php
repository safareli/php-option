<?php
namespace PlasmaConduit\option;

interface Option {

    public function isEmpty();
    public function nonEmpty();
    public function get();
    public function getOrElse($default);
    public function orElse($alternative);
    public function orNull();
    public function toLeft($right);
    public function toRight($left);
    public function map($mapper);
    public function flatMap($flatMapper);
    public function filter($predicate);

}