# Funding Circle

[FundingCircle](https://www.fundingcircle.com) Code Challenge 04/12/2017

## Objective:
Generate a multiplication table of the first 10 prime numbers.  The program must run from the command line and print one table to STDOUT.  The first row and column of the table should have the 10 primes, with each cell containing the product of the primes for the corresponding row and column.


## Notes:
- Consider complexity. scalability and running time
- Consider cases where we want *`N`* primes.
- Do not use a library to determine the prime numbers
- Write tests
- Provide instructions for execution of code.

## Installation:
- **Build:** PHP 7.0.14 (Should be compatible with v5.4 and greater)
- **Checkout:** git@github.com:locomotif/FundingCircle.git
- **Execute:** using command line

### Execute Default Behavior
```php
# php main.php // executed default behavior N = 10
```
#### Example Output
![Prime Multiplication Table](https://github.com/locomotif/FundingCircle/images/PrimeMultiplicationTable.png)

### Execute for target `N`
***constraint***: `2 <= N <= 100000`

```php
# php main.php 1000
```
Executing the upper bound can take approximately 53s, with k = 100.
![Prime Multiplication Table](https://github.com/locomotif/FundingCircle/images/MillerRabin_Test_accuracy_factor.png)

### Output Primes only for `N`

```php
# php main.php 1000 notable
```

## TDD
To facilitate the execution of the script on your end, I didn't leverage any dependencies so all that is needed is current version of php (7.0 is the version I used, however I believe it should be compatible with php 5.4 and greater.

I coded a basic test suite that can be executed by:

```php
# php main.php test // execute test suite
```
