<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Игорь
 * Date: 30.03.14
 * Time: 17:50
 * To change this template use File | Settings | File Templates.
 */

class Core_Project
{

    private static function prodactionHosts() {
        return array(
            "xdiary.ru",
        );
    }

    public static function isDevel() {
        return !in_array(Request::getHost(), self::prodactionHosts());
    }
}