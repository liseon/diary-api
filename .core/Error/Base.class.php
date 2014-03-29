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

    private static $errors = array(
        self::CLASS_NOT_FOUND => "Not Found!",
    );

    public static function getErrorTestByCode($code) {
        return isset(self::$errors[$code]) ? self::$errors[$code] : false;
    }

    /**
     * @param $comment
     * @param $code
     */
    public static function fatal($comment, $code) {
        trigger_error("{$comment} ErrorCode: {$code}");
        $response = Response::getInstance();
        $response->setError(self::getErrorTestByCode($code), $code);

        $response->output();
    }
}