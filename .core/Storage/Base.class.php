<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Игорь
 * Date: 30.03.14
 * Time: 18:55
 * To change this template use File | Settings | File Templates.
 */

class Storage extends Pattern_Singleton
{
    /**
     * @var Mongo
     */
    private $connection;

    private $DB;

    protected function __construct() {
        $this->connection = new Mongo();
    }

    private function __destruct() {
        $this->connection->close();
    }

    /**
     * @param $name
     * @return Storage
     */
    public static function getInstance($name) {
        $instance = parent::getInstance();
        $instance->selectDB($name);

        return $instance;
    }

    private function selectDB($name) {
        $this->DB = $this->connection->$name;
    }
}