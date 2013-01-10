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

```

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