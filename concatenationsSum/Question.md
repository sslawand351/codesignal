# ConcatenationsSum

Given an array of positive integers `a`, your task is to calculate the sum of every possible `a[i] . a[j]`, where `a[i] . a[j]` is the concatenation of the string representations of `a[i]` and `a[j]` respectively.

## Example

* For `a = [10, 2]`, the output should be `concatenationsSum(a) = 1344`.
```
a[0].a[0] = 10 . 10 = 1010
a[0].a[1] = 10 . 2 = 102
a[1].a[0] = 2 . 10 = 210
a[1].a[1] = 2 . 2 = 22
```
So the sum is equal to `1010 + 102 + 210 + 22 = 1344`
