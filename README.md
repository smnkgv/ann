##Simple PHP7 artificial neural network

Simple ANN implementation (single-layer perceptron).
Developed to recognize images with letters (there are examples with sans font).

###Usage:
```
vendor/bin/codecept run unit tests/unit/lib/NetworkTest.php --debug
```
###Result:
```
Unit Tests (1) ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Modules: Asserts, \Helper\Unit
-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
- NetworkTest: Network
  image h looks like sans_h
  image S looks like sans_S
  image Q looks like sans_Q
  image T looks like sans_T
  image 3 looks like sans_3
  image 9 looks like sans_9
  image r looks like sans_r
  image M looks like sans_M
  image y looks like sans_y
  image o looks like sans_o
  image j looks like sans_j
  image W looks like sans_W
  image 5 looks like sans_5
  image C looks like sans_C
  image X looks like sans_X
  image m looks like sans_m
  image J looks like sans_J
  image 6 looks like sans_6
  image R looks like sans_R
  image k looks like sans_k
  image z looks like sans_z
  image x looks like sans_x
  image I looks like sans_I
  image q looks like sans_q
  image p looks like sans_p
  image d looks like sans_d
  image w looks like sans_w
  image b looks like sans_b
  image s looks like sans_s
  image E looks like sans_E
  image A looks like sans_A
  image c looks like sans_c
  image P looks like sans_P
  image 7 looks like sans_7
  image v looks like sans_v
  image U looks like sans_U
  image i looks like sans_i
  image a looks like sans_a
  image 0 looks like sans_0
  image O looks like sans_O
  image V looks like sans_V
  image D looks like sans_D
  image Z looks like sans_Z
  image K looks like sans_K
  image 1 looks like sans_1
  image g looks like sans_g
  image f looks like sans_f
  image 2 looks like sans_2
  image N looks like sans_N
  image Y looks like sans_Y
  image H looks like sans_H
  image e looks like sans_e
  image F looks like sans_F
  image t looks like sans_t
  image 4 looks like sans_4
  image 8 looks like sans_8
  image u looks like sans_u
  image G looks like sans_G
  image L looks like sans_L
  image B looks like sans_B
  image l looks like sans_l
  image n looks like sans_n
  Accuracy: 100%
✔ NetworkTest: Network (53.01s)
```
