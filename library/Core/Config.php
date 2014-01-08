<?php

/**
 * This file is part of the miniCMS package.
 * (c) since 2005 BATMUNKH Moltov <contact@batmunkh.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Buh tohirgoonuudiig aguulna
 *
 * @package    miniCMS
 * @subpackage -
 * @author     BATMUNKH Moltov <contact@batmunkh.com>
 * @version    SVN: $Id
 *
 * @property array $data Config iin set,get utguudiig aguulna
 * @property array $data[routes] ali module/action haash zaagdsan route iin tohirgoo
 * @property array $data[GET] $_GET huvisagchuud
 * @property array $data[POST] $_POST huvisagchuud
 * @property array $data[component_all] buh component uud
 * @property array $data[component_enabled] buh component uud
 */
class Config extends Core {

    public static $data = array();

    public function __construct($config = array()) {

        //undsen tohirgoonii utguud
        Config::$data = $config;
        foreach ($config as $k => $v) {
            define(strtoupper($k), $v);
        }
    }

    static function get($key = '', $value = null) {

        if (!is_null($value) && $value != '') {
            self::set($key, $value);
        }

        if (isset(self::$data[$key])) {

            return self::$data[$key];
        } else {

            return null;
        }
    }

    static function set($key = '', $value = '') {

        self::$data[$key] = $value;
        return;
    }

}