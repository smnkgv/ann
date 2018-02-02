##PHP 7.1 ANN

An example of a simple artificial neural network (only single-layer for now).

###Usage:
```
$ . docker.sh build
$ . docker.sh up
docker# vendor/bin/codecept run unit tests/unit/lib/NetworkTest.php --debug
```

###Result:
```
Unit Tests (1) ----------------------------------------------------------------------------------------------------
Modules: Asserts, \Helper\Unit
-------------------------------------------------------------------------------------------------------------------
- NetworkTest: Image recognition network
  Train iteration: 1000
  Train iteration: 2000
  Train iteration: 3000
  Train iteration: 4000
  ...
  Train iteration: 111000
  Train iteration: 112000
  Train iteration: 113000
  Train iteration: 114000
  Train iteration: 115000
  Total iterations: 115320
  real / recognized: 5 / 5
  real / recognized: Z / Z
  real / recognized: d / d
  real / recognized: X / X
  ...
  real / recognized: G / G
  real / recognized: t / t
  real / recognized: o / o
  real / recognized: Y / Y
  Accuracy: 100%
✔ NetworkTest: Image recognition network (65.78s)
-------------------------------------------------------------------------------------------------------------------


Time: 1.09 minutes, Memory: 34.00MB

OK (1 test, 2 assertions)
```
