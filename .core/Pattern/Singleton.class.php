<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Игорь
 * Date: 29.03.14
 * Time: 14:12
 * To change this template use File | Settings | File Templates.
 */

abstract class Pattern_Singleton {

    private static $instances;

    private function __construct(){
    }

    public static function getInstance() {
        $class = get_called_class();
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class();
        }

        return self::$instances[$class];
    }

}