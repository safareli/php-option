<?php
namespace spec\option;
use PHPSpec2\ObjectBehavior;
use option\Some;

class None extends ObjectBehavior {

    const VALUE       = "value";
    const ALTERNATIVE = "alternative";

    function let() {
        $this->beConstructedWith(self::VALUE);
    }

    function it_should_be_initializable() {
        $this->shouldHaveType("option\None");
    }

    function it_should_return_true_for_isEmpty() {
        $this->isEmpty()->shouldReturn(true);
    }

    function it_should_return_false_for_nonEmpty() {
        $this->nonEmpty()->shouldReturn(false);
    }

    function it_should_throw_for_get() {
        $this->shouldThrow("\Exception")->duringGet();
    }

    function it_should_return_the_alternative_for_getOrElse() {
        $this->getOrElse(self::ALTERNATIVE)->shouldReturn(self::ALTERNATIVE);
    }

    function it_should_return_this_for_orElse() {
        $this->orElse(new Some(self::ALTERNATIVE))
             ->get()
             ->shouldReturn(self::ALTERNATIVE);
    }

    function it_should_return_null_for_orNull() {
        $this->orNull()->shouldReturn(null);
    }

    function it_should_run_the_callable_for_map() {
        $this->map(function($value) {
            return self::ALTERNATIVE;
        })->orNull()->shouldReturn(null);
    }

}
