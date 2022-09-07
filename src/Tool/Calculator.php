<?php
namespace App\Tool;

use Exception;

class Calculator
{
    /**
     * Addition operation
     *
     * @param float $left
     * @param float $right
     * @return float
     */
    public static function add(float $left, float $right): float {
        return $left + $right;
    }

    /**
     * Subtraction operation
     *
     * @param float $left
     * @param float $right
     * @return float
     */
    public static function subtract(float $left, float $right): float {
        return $left - $right;
    }

    /**
     * Multiplication operation
     *
     * @param float $left
     * @param float $right
     * @return float
     */
    public static function multiply(float $left, float $right): float {
        return $left * $right;
    }

    /**
     * Division operation
     *
     * @param float $left
     * @param float $right
     * @return float
     * @throws Exception
     */
    public static function divide(float $left, float $right): float {
        if($right === 0.0) {
            throw new Exception('You should not divide by zero!');
        }
        return $left / $right;
    }

}