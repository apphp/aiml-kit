<?php

namespace Apphp\MLKit\Math\Linear;

use Random\RandomException;

/**
 * Scalar class provides a comprehensive set of mathematical operations for scalar values
 *
 * This class includes basic arithmetic operations, scalar-vector operations,
 * mathematical functions, trigonometric operations, random number generation,
 * comparison operations, and bitwise operations. All methods are static and
 * designed for high precision mathematical computations.
 *
 * @package Apphp\MLKit\Math\Linear
 */
class Scalar {
    /**
     * Adds two floating-point numbers
     *
     * @param float $a First number
     * @param float $b Second number
     * @param int|null $precision Number of decimal places to round to.
     * @return float Sum of the two numbers
     */
    public static function add(float $a, float $b, ?int $precision = 10): float {
        if ($precision !== null) {
            return round($a + $b, $precision);
        }

        return $a + $b;
    }

    /**
     * Subtracts second number from the first
     *
     * @param float $a Number to subtract from
     * @param float $b Number to subtract
     * @return float Result of subtraction
     */
    public static function subtract(float $a, float $b): float {
        return $a - $b;
    }

    /**
     * Multiplies two floating-point numbers
     *
     * @param float $a First number
     * @param float $b Second number
     * @return float Product of the two numbers
     */
    public static function multiply(float $a, float $b): float {
        return $a * $b;
    }

    /**
     * Divides first number by the second
     *
     * @param float $a Dividend
     * @param float $b Divisor
     * @return float|string Result of division or 'undefined' if divisor is zero
     */
    public static function divide(float $a, float $b): float|string {
        return $b != 0 ? $a / $b : 'undefined';
    }

    /**
     * Calculates the floating-point remainder (modulo)
     *
     * @param float $a Dividend
     * @param float $b Divisor
     * @param int|null $precision Number of decimal places to round to.
     * @return float Remainder of the division
     */
    public static function modulus(float $a, float $b, ?int $precision = 10): float {
        if ($precision !== null) {
            return round(fmod($a, $b), $precision);
        }

        return fmod($a, $b);
    }

    /**
     * Raises first number to the power of second number
     *
     * @param float $a Base number
     * @param float $b Exponent
     * @return float Result of exponentiation
     */
    public static function power(float $a, float $b): float {
        return $a ** $b;
    }

    /**
     * Multiplies each element of a vector by a scalar value
     *
     * @param float $scalar The scalar value to multiply by
     * @param array<int|float> $vector Array of numbers
     * @return array<int|float> Resulting vector after multiplication
     */
    public static function multiplyVector(float $scalar, array $vector): array {
        return array_map(fn($x) => $x * $scalar, $vector);
    }

    /**
     * Adds a scalar value to each element of a vector
     *
     * @param float $scalar The scalar value to add
     * @param array<int|float> $vector Array of numbers
     * @return array<int|float> Resulting vector after addition
     */
    public static function addToVector(float $scalar, array $vector): array {
        return array_map(fn($x) => $x + $scalar, $vector);
    }

    /**
     * Calculates the absolute value of a number
     *
     * @param float $x Input number
     * @return float Absolute value
     */
    public static function absolute(float $x): float {
        return abs($x);
    }

    /**
     * Rounds a number up to the next highest integer
     *
     * @param float $x Input number
     * @return float Ceiling value
     */
    public static function ceiling(float $x): float {
        return ceil($x);
    }

    /**
     * Rounds a number down to the next lowest integer
     *
     * @param float $x Input number
     * @return float Floor value
     */
    public static function floor(float $x): float {
        return floor($x);
    }

    /**
     * Rounds a number to the nearest integer
     *
     * @param float $x Input number
     * @return float Rounded value
     */
    public static function round(float $x): float {
        return round($x);
    }

    /**
     * Calculates e raised to the power of x
     *
     * @param float $x The exponent
     * @return float e^x
     */
    public static function exponential(float $x): float {
        return exp($x);
    }

    /**
     * Calculates the natural logarithm of a number
     *
     * @param float $x Input number (must be positive)
     * @return float|string Natural logarithm or 'undefined' if x <= 0
     */
    public static function logarithm(float $x): float|string {
        return $x > 0 ? log($x) : 'undefined';
    }

    /**
     * Calculates the square root of the absolute value of a number
     *
     * @param float $x Input number
     * @return float Square root of |x|
     */
    public static function squareRoot(float $x): float {
        return sqrt(abs($x));
    }

    /**
     * Calculates the sine of an angle
     *
     * @param float $angle Angle in radians
     * @param int|null $precision Number of decimal places to round to.
     * @return float Sine value
     */
    public static function sine(float $angle, ?int $precision = 10): float {
        if ($precision !== null) {
            return round(sin($angle), $precision);
        }

        return sin($angle);
    }

    /**
     * Calculates the cosine of an angle
     *
     * @param float $angle Angle in radians
     * @param int|null $precision Number of decimal places to round to.
     * @return float Cosine value
     */
    public static function cosine(float $angle, ?int $precision = 10): float {
        if ($precision !== null) {
            return round(cos($angle), $precision);
        }

        return cos($angle);
    }

    /**
     * Calculates the tangent of an angle
     *
     * @param float $angle Angle in radians
     * @param int|null $precision Number of decimal places to round to.
     * @return float|string Returns 'undefined' for angles where tangent is undefined (π/2 + nπ)
     */
    public static function tangent(float $angle, ?int $precision = 10): float|string {
        // Check if angle is π/2 + nπ where tangent is undefined
        $normalized = fmod($angle, M_PI); // Normalize to [0, π]
        if (abs($normalized - M_PI_2) < 0.00000001) {
            return 'undefined';
        }

        $result = tan($angle);
        if ($precision !== null) {
            return round($result, $precision);
        }

        return $result;
    }

    /**
     * Generates a random integer within specified range
     *
     * @param int $min Lower bound (inclusive)
     * @param int $max Upper bound (inclusive)
     * @return int Random integer
     * @throws RandomException
     */
    public static function randomInt(int $min = 1, int $max = 10): int {
        return random_int($min, $max);
    }

    /**
     * Generates a random integer using Mersenne Twister algorithm
     *
     * @param int $min Lower bound (inclusive)
     * @param int $max Upper bound (inclusive)
     * @return int Random integer
     */
    public static function mtRandomInt(int $min = 1, int $max = 10): int {
        return mt_rand($min, $max);
    }

    /**
     * Generates a random float between 0 and 1 using combined linear congruential generator
     *
     * @return float Random float between 0 and 1
     */
    public static function lcgValue(): float {
        return lcg_value();
    }

    /**
     * Checks if first number is greater than second
     *
     * @param float $a First number
     * @param float $b Second number
     * @return bool True if a > b, false otherwise
     */
    public static function isGreaterThan(float $a, float $b): bool {
        return $a > $b;
    }

    /**
     * Checks if first number is less than second
     *
     * @param float $a First number
     * @param float $b Second number
     * @return bool True if a < b, false otherwise
     */
    public static function isLessThan(float $a, float $b): bool {
        return $a < $b;
    }

    /**
     * Checks if two numbers are equal
     *
     * @param float $a First number
     * @param float $b Second number
     * @return bool True if a == b, false otherwise
     */
    public static function isEqual(float $a, float $b): bool {
        return $a == $b;
    }

    /**
     * Checks if two numbers are not equal
     *
     * @param float $a First number
     * @param float $b Second number
     * @return bool True if a != b, false otherwise
     */
    public static function isNotEqual(float $a, float $b): bool {
        return $a != $b;
    }

    /**
     * Checks if first number is greater than or equal to second
     *
     * @param float $a First number
     * @param float $b Second number
     * @return bool True if a >= b, false otherwise
     */
    public static function isGreaterOrEqual(float $a, float $b): bool {
        return $a >= $b;
    }

    /**
     * Checks if first number is less than or equal to second
     *
     * @param float $a First number
     * @param float $b Second number
     * @return bool True if a <= b, false otherwise
     */
    public static function isLessOrEqual(float $a, float $b): bool {
        return $a <= $b;
    }

    /**
     * Performs bitwise AND operation
     *
     * @param int $a First integer
     * @param int $b Second integer
     * @return int Result of bitwise AND
     */
    public static function bitwiseAnd(int $a, int $b): int {
        return $a & $b;
    }

    /**
     * Performs bitwise OR operation
     *
     * @param int $a First integer
     * @param int $b Second integer
     * @return int Result of bitwise OR
     */
    public static function bitwiseOr(int $a, int $b): int {
        return $a | $b;
    }

    /**
     * Performs bitwise XOR operation
     *
     * @param int $a First integer
     * @param int $b Second integer
     * @return int Result of bitwise XOR
     */
    public static function bitwiseXor(int $a, int $b): int {
        return $a ^ $b;
    }

    /**
     * Performs bitwise NOT operation
     *
     * @param int $a Input integer
     * @return int Result of bitwise NOT
     */
    public static function bitwiseNot(int $a): int {
        return ~$a;
    }

    /**
     * Performs left shift operation
     *
     * @param int $a Number to shift
     * @param int $positions Number of positions to shift
     * @return int Result after left shift
     */
    public static function leftShift(int $a, int $positions = 1): int {
        return $a << $positions;
    }

    /**
     * Performs right shift operation
     *
     * @param int $a Number to shift
     * @param int $positions Number of positions to shift
     * @return int Result after right shift
     */
    public static function rightShift(int $a, int $positions = 1): int {
        return $a >> $positions;
    }
}
