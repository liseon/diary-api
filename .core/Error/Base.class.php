<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Игорь
 * Date: 29.03.14
 * Time: 13:53
 * To change this template use File | Settings | File Templates.
 */

class Error
{
    const CLASS_NOT_FOUND = 404;

    const MEMCACHE_CONN_FAIL = 101;

    const MONGO_CONN_FAIL = 201;

    const API_FATAL_TEXT = "Fatal error!";

    private static $errors = array(
        self::CLASS_NOT_FOUND => "Not Found!",
        self::MEMCACHE_CONN_FAIL => API_FATAL_TEXT,
        self::MONGO_CONN_FAIL => API_FATAL_TEXT,
    );

    public static function getErrorTextByCode($code) {
        return isset(self::$errors[$code]) ? self::$errors[$code] : false;
    }

    /**
     * @param $comment
     * @param $code
     */
    public static function fatal($comment, $code) {
        trigger_error("{$comment} ErrorCode: {$code}");
        $response = Response::getInstance();
        $response->setError(self::getErrorTextByCode($code), $code);

        $response->output();
    }
}