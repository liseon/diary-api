<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Игорь
 * Date: 29.03.14
 * Time: 16:11
 * To change this template use File | Settings | File Templates.
 */

class Response extends Pattern_Singleton
{
    /**
     * @var array
     */
    private $args = array();

    const ERROR_FIELD_CODE = 'error';

    const ERROR_FIELD_TEXT = 'errorDescription';

    protected function __construct() {
    }

    /**
     * @return Response
     */
    public static function getInstance() {
        return parent::getInstance();
    }

    public function setArgs($args) {
        $this->args = array_merge($this->args, $args);
    }

    public function unsetArg($name) {
        unset($this->args[$name]);
    }

    public function issetArg($name) {
        return isset($this->args[$name]);
    }

    public function setError($errorText, $errorCode) {
        $this->setArgs(array(
                self::ERROR_FIELD_CODE => $errorCode,
                self::ERROR_FIELD_TEXT => $errorText,
            ));
    }

    public function serialize() {

        return json_encode($this->args);
    }

    public function output() {
        die($this->serialize());
    }
}