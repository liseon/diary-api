<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Игорь
 * Date: 30.03.14
 * Time: 17:48
 * To change this template use File | Settings | File Templates.
 */

class Core_Config
{
    const DEVEL_PATH = ".configuration/devel/";

    const PRODACTION_PATH = ".configuration/prodaction/";

    const SUFFIX = ".config.php";

    public static function get($name, $part = null) {
        $path = PROJECT_ROOT_PATH;
        if (Core_Project::isDevel()) {
            $path .= self::DEVEL_PATH;
        } else {
            $path .= self::PRODACTION_PATH;
        }
        $file = $path . $name . self::SUFFIX;

        if (file_exists($file)) {
            $config = include_once($file);
            if (!is_null($part) && isset($config[$part])) {

                return $config[$part];
            }

            return $config;
        }

        return false;
    }
}