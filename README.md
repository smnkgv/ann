##Simple PHP7 artificial neural network

Simple ANN implementation (single-layer only for now).
Include test example to recognize images with letters in open-sans font.

###Usage:
```
vendor/bin/codecept run unit tests/unit/lib/NetworkTest.php --debug
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
  real / recognized: u / u
  real / recognized: R / R
  real / recognized: l / l
  real / recognized: 6 / 6
  real / recognized: 9 / 9
  real / recognized: N / N
  real / recognized: C / C
  real / recognized: b / b
  real / recognized: 0 / 0
  real / recognized: k / k
  real / recognized: A / A
  real / recognized: f / f
  real / recognized: v / v
  real / recognized: T / T
  real / recognized: a / a
  real / recognized: m / m
  real / recognized: H / H
  real / recognized: P / P
  real / recognized: E / E
  real / recognized: O / O
  real / recognized: h / h
  real / recognized: 2 / 2
  real / recognized: g / g
  real / recognized: q / q
  real / recognized: 1 / 1
  real / recognized: p / p
  real / recognized: B / B
  real / recognized: y / y
  real / recognized: e / e
  real / recognized: W / W
  real / recognized: i / i
  real / recognized: c / c
  real / recognized: V / V
  real / recognized: 7 / 7
  real / recognized: S / S
  real / recognized: D / D
  real / recognized: z / z
  real / recognized: I / I
  real / recognized: Q / Q
  real / recognized: U / U
  real / recognized: s / s
  real / recognized: r / r
  real / recognized: j / j
  real / recognized: L / L
  real / recognized: K / K
  real / recognized: x / x
  real / recognized: 4 / 4
  real / recognized: M / M
  real / recognized: 8 / 8
  real / recognized: n / n
  real / recognized: w / w
  real / recognized: F / F
  real / recognized: 3 / 3
  real / recognized: J / J
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
