##Simple PHP7 artificial neural network

Simple ANN implementation (single-layer perceptron).
Developed to recognize images with letters (there are examples with sans font).

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
  Train iteration: 1
  Train iteration: 2
  Train iteration: 3
  Train iteration: 4
  Train iteration: 5
  Train iteration: 6
  Train iteration: 7
  Train iteration: 8
  Train iteration: 9
  Train iteration: 10
  Train iteration: 11
  Train iteration: 12
  Train iteration: 13
  Train iteration: 14
  Train iteration: 15
  Train iteration: 16
  Train iteration: 17
  Train iteration: 18
  Train iteration: 19
  Train iteration: 20
  Train iteration: 21
  Train iteration: 22
  Train iteration: 23
  Train iteration: 24
  Train iteration: 25
  Train iteration: 26
  Train iteration: 27
  Train iteration: 28
  Train iteration: 29
  Train iteration: 30
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
