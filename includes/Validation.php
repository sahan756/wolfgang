<?php

class Validation {

    function isEmpty($input) {
        $string = trim($input);
        return empty($string) ? TRUE : FALSE;
    }

    function isTooLong($input, $length) {
        return strlen($input) > $length ? TRUE : FALSE;
    }

    function isNotNumeric($input) {
        return !is_numeric($input) ? TRUE : FALSE;
    }

    function isInvalidAmount($input) {
        if (is_numeric($input)) {            
            if (is_float(floatval($input))) {                
                $amount = explode('.', $input);    
                //var_dump($amount);
                return count($amount) == 2 && strlen($amount[1]) <= 2 ? FALSE : TRUE;
            }
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    function isNotWholeNumber($input){
        return is_numeric($input) && floor($input) == $input ? FALSE : TRUE;
    }
}

?>
