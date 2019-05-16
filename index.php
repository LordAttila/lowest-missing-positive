<?php

/**
 * Generate random unique numbers in the given range
 * @param int $min The lowest value of the range. (can be negative)
 * @param int $max The greatest value of the range. (can be negative)
 * @param int $piece How much numbers will be generated.
 * @return mixed array of elements or FALSE.
 * There is some exeption when return with FALSE:
 * If $min and $max are both negative and $max lower than $min.
 * $piece is not a positive number.
 * If summ value of (absolute)$min and (absolute)$max is lower than $piece.
 */
function generateNumbers($min, $max, $piece)
{
    $calc = abs($min) + abs($max);
    if($min > $max || $piece < 0 || $calc < $piece){
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
 */
function find($numbers){
    if(!is_array($numbers) || max($numbers) < 1){
        return FALSE;
    }

    $missingNumbers = [];
    for ($i=1; $i < max($numbers); $i++) { 
        array_push($missingNumbers, $i);
    }

    foreach ($numbers as $number) {
        //skip negative numbers and 0
        if($number < 1){
            continue;
        }
        //find existing numbers and remove them from return-array
        if(in_array($number, $missingNumbers)){
            //remove the existing number from the return-array
            unset($missingNumbers[$number-1]);
        }
    }

    return min($missingNumbers);
}
