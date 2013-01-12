<?php
namespace PlasmaConduit\option;
use PlasmaConduit\option\Option;
use PlasmaConduit\option\None;
use Exception;

class Some implements Option {

    private $_value;

    /**
     * This constructor is the only entry point where the value can be wrapped.
     * In other words, once a value is wrapped in a `Some` container it is
     * immutable within the container.
     *
     * @param {Any} $value - The value to wrap
     */
    public function __construct($value) {
        $this->_value = $value;
    }

    /**
     * This function is used to signify if the Option type is empty. This is
     * the `Some` class and the class type carries this information so this
     * method will always return false.
     *
     * @return {Boolean} - Always false
     */
    public function isEmpty() {
        return false;
    }

    /**
     * This function is used to signify if the Option type is not empty. This
     * is the `Some` class and the class type carries this information so this
     * method will always return true.
     *
     * @return {Boolean} - Always true
     */
    public function nonEmpty() {
        return true;
    }

    /**
     * This returns the wrapped value.
     *
     * @return {Any} - The wrapped value
     */
    public function get() {
        return $this->_value;
    }

    /**
     * This function will return the wrapped value if the `Option` type is
     * `Some` and if it's `None` it will return `$default` instead. Seeing how
     * this is the `Some` class, this will always return the wrapped value
     *
     * @ param {Any} $default - The default value if no value is present
     * @ return {Any}         - The wrapped value
     */
    public function getOrElse($default) {
        return $this->_value;
    }

    /**
     * This function takes an alternative `Option` type and if this `Option`
     * type is `None` it returns the alternative type. However, this is the
     * `Some` class so it will always return itself.
     *
     * @param {Option} $alternative - The alternative Option
     * @return {Option}             - Always returns itself
     */
    public function orElse(Option $alternative) {
        return $this;
    }

    /**
     * For those moments when you just need either a value or null. This
     * function returns the wrapped value when called on the `Some` class and
     * returns null when called on the `None` class. This is the `Some` class
     * so it will always return the wrapped value
     *
     * @return {Any|null} - The wrapped value or null
     */
    public function orNull() {
        return $this->_value;
    }

    public function toLeft($right) {
        //
    }

    public function toRight($left) {
        //
    }

    /**
     * This method takes a callable type (closure, function, etc) and if it's
     * called on a `Some` instance it will call the function `$mapper` with the
     * wrapped value and the value returend by `$mapper` will be wrapped in a
     * new `Some` container and that new `Some` container will be returned. If
     * this is called on a `None` container, the function `$mapper` will never
     * be called and instead we return `None` immediately. This is the `Some`
     * class, so it will always call the function and always return `Some`.
     *
     * @param {callable} $mapper - Function to call on the wrapped value
     * @return {Option}          - The newly produced Some
     */
    public function map($mapper) {
        if (!is_callable($mapper)) {
            throw new Exception("Can't call Some#map with a non callable.");
        }
        return new Some($mapper($this->_value));
    }

    /**
     * This method takes a callable type that takes the wrapped value of the
     * current `Some` as it's arguments and returns an `Option` type. The
     * `Option` type returned by the passed in callable is returned by this
     * method
     *
     * @param {callable} $flatMapper - Fuction to call on the wrapped value
     * @return {Option}              - The `Option` produced by the flat mapper
     */
    public function flatMap($flatMapper) {
        if (!is_callable($flatMapper)) {
            throw new Exception("Can't call Some#flatMap with a non callable.");
        }
        $flatMapped = $flatMapper($this->_value);
        if (!($flatMapped instanceof Option)) {
            throw new Exception(
                "Function passed to Some#flatMap must retrun Option"
            );
        }
        return $flatMapped;
    }

    /**
     * This function takes a callable as a predicate that takes the wrapped
     * value of the current `Some` as it's argument. If the predicate returns
     * true the current `Some` is returned. If the predicate returns false
     * a new `None` is returned.
     *
     * @param {callable} $predicate - The predicate to check the wrapped value
     * @return {Option}             - `Some` on success `None` on failure
     */
    public function filter($predicate) {
        if (!is_callable($predicate)) {
            throw new Exception("Can't call Some#filter with a non callable.");
        }
        if ($predicate($this->_value)) {
            return $this;
        } else {
            return new None();
        }
    }

}
