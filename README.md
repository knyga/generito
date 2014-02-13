Generito
========================
This library aims to provide a generator instruments with distribution and randomization.


Quick Start
-----------

The library is easy to get up and running quickly.

```php
<?php

use Generito\Generator;

$distribution = (new DistributionFactory)
    ->createDistribution(DistributionTypes::DISCRETE)
    ->setFrequencies($this->frequencies);

$this->generator->setDistribution($distribution)
    ->setHandler(function($value) {
        return array(
            "value" => $value,
            // Get a random 8-character string
            // See https://github.com/rchouinard/rych-random/blob/master/Random.php
            "code" => Random::getRandom()->getRandomString(8, "abcdefghijklmnopqrstuvwxyz0123456789")
            );
    });

$result = $this->generator->generate(2);
```

```
array(2) {
  [0]=>
  array(2) {
    ["value"]=>
    int(14)
    ["code"]=>
    string(8) "q9zosw4f"
  }
  [1]=>
  array(2) {
    ["value"]=>
    int(12)
    ["code"]=>
    string(8) "gvv5jxg1"
  }
}
```


Installation via [Composer](http://getcomposer.org/)
------------

 * Install Composer to your project root:
    ```bash
    curl -sS https://getcomposer.org/installer | php
    ```

 * Add a `composer.json` file to your project:
    ```json
    {
      "require" {
        "knyga/generito": "dev-master"
      }
    }
    ```

 * Run the Composer installer:
    ```bash
    php composer.phar install
    ```


Distributions
----------

The library uses a distribution classes to generate required number of values with required distribution.

### DiscreteDistribution

Returns random value from input according to it's density.

```php
$distribution = new DiscreteDistribution;
$distribution->setFrequencies(array('a' => 100, 'b' => 200, 'c' => 300));
$cnt = array('a' => 0, 'b' => 0, 'c' => 0);

for($i=0;$i<1000;$i++) {
    ++$cnt[$distribution->random()];
}
```

```
array(3) {
  ["a"]=>
  int(139)
  ["b"]=>
  int(352)
  ["c"]=>
  int(509)
}
```

```php
$distribution = new DiscreteDistribution;
$distribution->setFrequencies(array(100, 200, 300));
$cnt = array(0 => 0, 1 => 0, 2 => 0);

for($i=0;$i<1000;$i++) {
    ++$cnt[$distribution->random()];
}
```

```
.array(3) {
  [0]=>
  int(170)
  [1]=>
  int(330)
  [2]=>
  int(500)
}
```

#### FixedDistribution

Returns fixed number of values.

```php
$distribution = new FixedDistribution;
$distribution->setFrequencies(array(100, 200, 300));
$cnt = array(0 => 0, 1 => 0, 2 => 0);

for($i=0;$i<600;$i++) {
    ++$cnt[$distribution->random()];
}
```

```
array(3) {
  [0]=>
  int(100)
  [1]=>
  int(200)
  [2]=>
  int(300)
}
```

```php
$distribution = new FixedDistribution;
$distribution->setFrequencies(array(100, 200, 300));
$distribution->setCount(1000);
$cnt = array(0 => 0, 1 => 0, 2 => 0);

for($i=0;$i<1000;$i++) {
    ++$cnt[$distribution->random()];
}
```

```
array(3) {
  [0]=>
  int(166)
  [1]=>
  int(333)
  [2]=>
  int(501)
}
```

```php
$distribution = new FixedDistribution;
$distribution->setFrequencies(array('a' => 100, 'b' => 200, 'c' => 300));
$cnt = array('a' => 0, 'b' => 0, 'c' => 0);

for($i=0;$i<600;$i++) {
    ++$cnt[$distribution->random()];
}
```

```
array(3) {
  ["a"]=>
  int(100)
  ["b"]=>
  int(200)
  ["c"]=>
  int(300)
}
```

#### ContinuosDistribution

Returns random value from input according to it's density. Despite DiscreteDistribution could return float values.


License
-------

Generito is licensed under the MIT license.
Oleksandr Knyga <oleksandrknyga@gmail.com>