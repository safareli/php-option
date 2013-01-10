<?php
namespace spec\option;
use PHPSpec2\ObjectBehavior;
use option\Some as Real;

class Some extends ObjectBehavior {

    const VALUE       = "value";
    const ALTERNATIVE = "alternative";

    function let() {
        $this->beConstructedWith(self::VALUE);
    }

    function it_should_be_initializable() {
        $this->shouldHaveType("option\Some");
    }

    function it_should_return_false_for_isEmpty() {
        $this->isEmpty()->shouldReturn(false);
    }

    function it_should_return_true_for_nonEmpty() {
        $this->nonEmpty()->shouldReturn(true);
    }

    function it_should_return_the_value_for_get() {
        $this->get()->shouldReturn(self::VALUE);
    }

    function it_should_return_the_value_for_getOrElse() {
        $this->getOrElse(self::ALTERNATIVE)->shouldReturn(self::VALUE);
    }

    function it_should_return_this_for_orElse() {
        $this->orElse(new Real(self::ALTERNATIVE))->shouldReturn($this);
    }

    function it_should_return_null_for_orNull() {
        $this->orNull()->shouldReturn(self::VALUE);
    }

    function it_should_run_the_callable_for_map() {
        $this->map(function($value) {
            return "mapped";
        })->get()->shouldReturn("mapped");
    }

}
