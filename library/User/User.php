<?php

/**
 * This file is part of the miniCMS package.
 * (c) since 2005 BATMUNKH Moltov <contact@batmunkh.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class User {
    
    private $_siteKey;
    
    public function __construct() {
        $this->siteKey = 'secret';
    }
    
    public static function generatePassword($password, $salt, $algorithm = 'md5') {

        $pass = '';

        switch ($algorithm) {
            case 'md5':
                $pass = md5($password . $salt);
                break;
            case 'sha512':
                $pass = md5($password . $salt);
                break;
            //default n md5
            default:
                $pass = md5($password . $salt);
                break;
        }

        return $pass;
    }
    
    protected function hashData($data)
    	{
            return hash_hmac('sha512', $data, $this->_siteKey);
	}

    
    public static function findByEmail($email){
        
    }
    
    public static function findByFbId($fbid){
        
    }
    
    public static function findByPhone($phone){
        
    }
    
    public function createUser($email, $password)
    {			
            //Generate users salt
            $user_salt = $this->randomString();

            //Salt and Hash the password
            $password = $user_salt . $password;
            $password = $this->hashData($password);

            //Create verification code
            $code = $this->randomString();

            //Commit values to database here.
    //	$created = …

            if($created != false){
                    return true;
            }

            return false;
    }
    
    private function randomString($length = 50)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $string = '';    

        for ($p = 0; $p < $length; $p++) {
                $string .= $characters[mt_rand(0, strlen($characters))];
        }

        return $string;
    }
    
    protected function hashData($data)
    {
        return hash_hmac('sha512', $data, $this->_siteKey);
    }


}
