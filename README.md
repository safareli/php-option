Option
======
Strongly typed alternative to null. The Option type in this package is based
off of the Option typeclass from Scala and the Maybe monad from Haskell.

`Option` itself is just an interface. Two classes in this package implement
the `Option` interface and they are `Some` and `None`. The convention is to
have functions return `Option` types and it will either contain `Some` value
or `None` at all. This creates a type safe alternative to returning null in
the absence of a value.

In addition to the added type safety, the `Option` type is monadic, so
`Option` types are highly composable. This allows you to eliminate a lot of
the typical null checking boiler plate code you'd normally have to write and
encourages you to write in a more expressive style.

```php
<?php
use PlasmaConduit\option\Some;
use PlasmaConduit\option\None;

function fetchUser($username) {
    $user = PsuedoDB::get($username);
    if ($user) {
        return new Some($user);
    } else {
        return new None();
    }
}

function updateLastSeen($username) {
    PsuedoDB::updateLastSeen($username);
    return $username;
}

// Fetch the user "Joseph". If "Joseph" exists update the last time he was seen
// and echo "Joseph". If "Joseph" doesn't exist do not update the last time
// any user was seen and print out "No such user." instead.
echo fetchUser("Joseph")->map("updateLastSeen")->getOrElse("No such user.");
```

Documentation
-------------
Both `Some` and `None` implement the `Option` interface which is as follows:
```php
<?php
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
```

### Some
This class is representitive of the presence of a value within an `Option`
container.

#### Some#__construct($value)
This constructor is the only entry point where the value can be wrapped. In
other words, once a value is wrapped in a `Some` container it is immutable
within that container.

  * @param {Any} $value - The value to wrap

#### Some#isEmpty()
This function is used to signify if the `Option` type is empty. This is
the `Some` class and the class type carries this information so this method
will always return false.

  * @returns {Boolean} - Always false

#### Some#nonEmpty()
This function is used to signify if the `Option` type is not empty. This is
the `Some` class and the class type carries this information so this method
will always return true.

  * @returns {Boolean} - Always true

#### Some#get()
This returns the wrapped value.

  * @ returns {Any} - The wrapped value

#### Some#getOrElse($default)
This function will return the wrapped value if the `Option` type is `Some` and
if it's `None` it will return `$default` instead. Seeing how this is the `Some`
class, this will always return the wrapped value

  * @ param {Any} $default - The default value if no value is present
  * @ returns {Any}        - The wrapped value

#### Some#orElse(Option $alternative)
This function takes an alternative `Option` type and if this `Option` type is
`None` it returns the alternative type. However, this is the `Some` class so
it will always return itself.

  * @param {Option} $alternative - The alternative `Option`
  * @returns {Option}            - Always returns itself

#### Some#orNull()
For those moments when you just need either a value or null. This function
returns the wrapped value when called on the `Some` class and returns `null`
when called on the `None` class. This is the `Some` class so it will always
return the wrapped value

  * @returns {Any|null} - The wrapped value or null

#### Some#toLeft($right)
Not yet implemented

#### Some#toRight($left)
Not yet implemented

#### Some#map(callable $f)
This method takes a callable type (closure, function, etc) and if it's called on
a `Some` instance it will call the function `$f` with the wrapped value and the
value returend by `$f` will be wrapped in a new `Some` container and that new
`Some` container will be returned. If this is called on a `None` container, the
function `$f` will never be called and instead we return `None` immediately.
This is the `Some` class, so it will always call the function and always
return `Some`.

  * @param {callable} $f - Function to call on the wrapped value
  * @returns {Option}    - The newly produced `Some`


### None
This class is representitive of the absence of a value within an `Option`
container.

#### None#__construct($value)
This constructor takes an optional value and completely disregards it

  * @param {Any} $value - A value to do nothing with

#### None#isEmpty()
This function is used to signify if the `Option` type is empty. This is
the `None` class and the class type carries this information so this method
will always return true.

  * @returns {Boolean} - Always true

#### None#nonEmpty()
This function is used to signify if the `Option` type is not empty. This is
the `None` class and the class type carries this information so this method
will always return false.

  * @returns {Boolean} - Always false

#### None#get()
This function should never get called on `None` So it always throws an
excaption

  * @throws - unconditionally
  * @returns {void}

#### None#getOrElse($default)
This function will return the wrapped value if the `Option` type is `Some` and
if it's `None` it will return `$default` instead. Seeing how this is the `None`
class, this will always return the `$default` value

  * @ param {Any} $default - The default value if no value is present
  * @ returns {Any}        - The default value

#### None#orElse(Option $alternative)
This function takes an alternative `Option` type and if this `Option` type is
`None` it returns the alternative type. However, this is the `None` class so
it will always return the `$alternative`.

  * @param {Option} $alternative - The alternative `Option`
  * @returns {Option}            - Always returns `$alternative`

#### None#orNull()
For those moments when you just need either a value or null. This function
returns the wrapped value when called on the `Some` class and returns `null`
when called on the `None` class. This is the `None` class so it will always
return null

  * @returns {null} - Always null

#### None#toLeft($right)
Not yet implemented

#### None#toRight($left)
Not yet implemented

#### None#map(callable $f)
This method takes a callable type (closure, function, etc) and if it's called on
a `Some` instance it will call the function `$f` with the wrapped value and the
value returend by `$f` will be wrapped in a new `Some` container and that new
`Some` container will be returned. If this is called on a `None` container, the
function `$f` will never be called and instead we return `None` immediately.
This is the `None` class, so it will never call `$f` and it will always
immediately return `None`

  * @param {callable} $f - Function to call on the wrapped value
  * @returns {Option}    - The newly produced `Some`

Developing
----------
This section is really only useful if you plan on contributing to this project.
You're going to need composer in the root directory so you can fetch all the
projects dependencies and to setup the autoloader.
```
curl http://getcomposer.org/installer | php
php composer.phar install --dev
```

Testing
-------
This section assumes you already followed the steps in `Developing`
```
bin/phpspec run
```