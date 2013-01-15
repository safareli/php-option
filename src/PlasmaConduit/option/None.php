<?php
namespace PlasmaConduit\option;
use PlasmaConduit\option\Option;
use Exception;

class None implements Option {

    /**
     * This constructor does absolutely nothing
     */
    public function __construct() { /**/ }

    /**
     * This function is used to signify if the Option type is empty. This is
     * the `None` class and the class type carries this information so this
     * method will always return true.
     *
     * @return {Boolean} - Always true
     */
    public function isEmpty() {
        return true;
    }

    /**
     * This function is used to signify if the Option type is not empty. This
     * is the `None` class and the class type carries this information so this
     * method will always return false.
     *
     * @return {Boolean} - Always false
     */
    public function nonEmpty() {
        return false;
    }

    /**
     * This method should never be called because you can't get a value from
     * nothing. So this throws unconditionally.
     *
     * @throws {Exception}
     */
    public function get() {
        throw new Exception("None#get() should never be called");
    }

    /**
     * This function will return the wrapped value if the `Option` type is
     * `Some` and if it's `None` it will return `$default` instead. Seeing how
     * this is the `None` class, this will always return the `$default`
     *
     * @ param {Any} $default - The default value if no value is present
     * @ return {Any}         - The `$default` value
     */
    public function getOrElse($default) {
        if (is_callable($default)) {
            return $default();
        } else {
            return $default;
        }
    }

    /**
     * This function takes an alternative `Option` type and if this `Option`
     * type is `None` it returns the alternative type. However, this is the
     * `None` class so it will always return `$alternative`.
     *
     * @param {Option} $alternative - The alternative Option
     * @return {Option}             - Always returns `$alternative`
     */
    public function orElse(Option $alternative) {
        return $alternative;
    }

    /**
     * For those moments when you just need either a value or null. This
     * function returns the wrapped value when called on the `Some` class and
     * returns null when called on the `None` class. This is the `None` class
     * so it will always return null
     *
     * @return {null} - Always null
     */
    public function orNull() {
        return null;
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
     * be called and instead we return `None` immediately. This is the `None`
     * class, so it will never call the `$mapper` and will return `None`
     * immediately.
     *
     * @param {callable} $mapper - Function to disregard
     * @return {Option}          - Always `None`
     */
    public function map($mapper) {
        if (!is_callable($mapper)) {
            throw new Exception("Can't call Some#map with a non callable.");
        }
        return $this;
    }

    /**
     * This takes a callable and completely disregards it, returning `None`
     * immediately.
     *
     * @return {Option} - Always `None`
     */
    public function flatMap($flatMapper) {
        if (!is_callable($flatMapper)) {
            throw new Exception("Can't call Some#flatMap with a non callable.");
        }
        return $this;
    }

    /**
     * This function takes a callable as a predicate, disregards it and returns
     * `None` immediately
     *
     * @return {Option} - Always `None`
     */
    public function filter($predicate) {
        if (!is_callable($predicate)) {
            throw new Exception("Can't call Some#filter with a non callable.");
        }
        return $this;
    }

}
