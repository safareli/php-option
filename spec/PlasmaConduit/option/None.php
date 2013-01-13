<?php
namespace spec\PlasmaConduit\option;
use PHPSpec2\ObjectBehavior;
use PlasmaConduit\option\Some as RealSome;

class None extends ObjectBehavior {

    const VALUE       = "value";
    const ALTERNATIVE = "alternative";

    function let() {
        $this->beConstructedWith(self::VALUE);
    }

    function it_should_be_initializable() {
        $this->shouldHaveType("PlasmaConduit\option\None");
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
        $this->orElse(new RealSome(self::ALTERNATIVE))
             ->get()
             ->shouldReturn(self::ALTERNATIVE);
    }

    function it_should_return_null_for_orNull() {
        $this->orNull()->shouldReturn(null);
    }

    function it_should_not_run_the_callable_for_map() {
        $this->map(function($value) {
            return self::ALTERNATIVE;
        })->orNull()->shouldReturn(null);
    }

    function it_should_throw_when_map_is_called_with_number() {
        $this->shouldThrow()->duringMap(123);
    }

    function it_should_return_None_for_flatMap() {
        $this->flatMap(function($value) {
            return $value;
        })->shouldHaveType("PlasmaConduit\option\None");
    }

    function it_should_throw_when_flatMap_is_called_with_number() {
        $this->shouldThrow()->duringFlatMap(123);
    }

    function it_should_return_None_for_filter() {
        $this->filter(function($value) {
            return !!$value;
        })->shouldHaveType("PlasmaConduit\option\None");
    }

    function it_should_throw_when_filter_is_called_with_number() {
        $this->shouldThrow()->duringFilter(123);
    }

}
