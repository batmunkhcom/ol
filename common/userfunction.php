<?php

function generatePassword($password, $salt, $algorithm = 'md5') {

        $pass = '';

        switch ($algorithm) {
            case 'md5':
                $pass = md5($password . $salt);
                break;

            //default n md5
            default:
                $pass = md5($password . $salt);
                break;
        }

        return $pass;
    }
?>
