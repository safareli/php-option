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
use PlasmaConduit\option\Option;
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

// Fetch the user "Joseph". If the "Joseph" exists update the last time
// that "Joseph" was seen and echo "Joseph". If the "Joseph" doesn't exist
// do not update the last time any user was seen and print out "No such user."
// instead.
echo fetchUser("Joseph")->map("updateLastSeen")->getOrElse("No such user.");
```

Documentation
-------------
Both `Some` and `None` implement the `Option` interface which is as follows:
```
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

#### Some#isEmpty()

#### Some#nonEmpty()

#### Some#get()

#### Some#getOrElse($default)

#### Some#orElse(Option $alternative)

#### Some#orNull()

#### Some#toLeft($right)

#### Some#toRight($left)

#### Some#map(callable $f)

### None
This class is representitive of the absence of a value within an `Option`
container.

#### None#__construct($value)

#### None#isEmpty()

#### None#nonEmpty()

#### None#get()

#### None#getOrElse($default)

#### None#orElse(Option $alternative)

#### None#orNull()

#### None#toLeft($right)

#### None#toRight($left)

#### None#map(callable $f)


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