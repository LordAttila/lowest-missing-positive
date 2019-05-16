<?php

class FindIt
{

    /**
     * Generate random unique numbers in the given range
     * @param int $min The lowest value of the range. (can be negative)
     * @param int $max The greatest value of the range. (can be negative)
     * @param int $piece How much numbers will be generated.
     * @return mixed array or FALSE.
     * There is some exeption when return with FALSE:
     * If $min and $max are both negative and $max lower than $min.
     * $piece is not a positive number.
     * If range of $min and $max is lower than $piece.
     */
    public static function generateNumbers($min, $max, $piece)
    {
        if ($min > $max || $piece < 0 || count(range($min, $max)) < $piece) {
            return FALSE;
        }

        $array = [];
        while (count($array) < $piece) {
            $rand = rand($min, $max);
            if (!in_array($rand, $array)) {
                array_push($array, $rand);
            }
        }
        return $array;
    }

    /**
     * Find the lowest missing number between 0 and max value of the given array
     * @param array $numbers
     * @return mixed int or FALSE.
     * There is some exeption when return with FALSE:
     * If $numbers is not an array.
     * The range contains only negative numbers.
     * There is no missing number.
     */
    public static function find($numbers)
    {
        if (!is_array($numbers) || max($numbers) < 1) {
            return FALSE;
        }

        $missingNumbers = range(1, max($numbers));

        foreach ($numbers as $number) {
            //skip negative numbers and 0
            if ($number < 1) {
                continue;
            }
            //find existing numbers and remove them from return-array
            if (in_array($number, $missingNumbers)) {
                //remove the existing number from the return-array
                unset($missingNumbers[$number - 1]);
            }
        }

        if(empty($missingNumbers)){
            return FALSE;
        }

        return min($missingNumbers);
    }
}
