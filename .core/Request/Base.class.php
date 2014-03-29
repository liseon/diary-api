<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Игорь
 * Date: 29.03.14
 * Time: 14:02
 * To change this template use File | Settings | File Templates.
 */

class Request extends Pattern_Singleton {

    private $host;

    private $method;

    private $apiVersion;

    private $controller;

    private $action = "default";

    protected function __construct() {
        $this->host =  $_SERVER['HTTP_HOST'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        if (preg_match("/^(.+)(\?.*)$/", $_SERVER['REQUEST_URI'], $uri)) {
            $uri = $uri[1];
        } else {
            $uri = $_SERVER['REQUEST_URI'];
        }
        $uri = explode("/", $uri);
        if ($uri[1] == "api" && preg_match('/^v(\d)$/', $uri[2], $ver)) {
            $this->apiVersion = $ver[1];
            $this->controller = $uri[3];
            $this->action = isset($uri[4]) && $uri[4] != "" ? $uri[4] : $this->action;
        }
    }

    /**
     * @return Request
     */
    public static function getInstance() {
        return parent::getInstance();
    }

    public static function getApiVersion() {
        return self::getInstance()->apiVersion;
    }

    public static function getController() {
        return ucfirst(self::getInstance()->controller);
    }

    public static function getAction() {
        return ucfirst(self::getInstance()->action);
    }
}