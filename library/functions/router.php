<?php

/**
 * This file is part of the miniCMS package.
 * (c) since 2005 BATMUNKH Moltov <contact@batmunkh.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * Router deer PATH shalgaad include hiih file iig onooj ugnu
 */
function set_include_file($file) {

    $file = \Config::set('load_file', DIR_MODULE . 'user' . DS . 'profile.php');

    return $file;
}
