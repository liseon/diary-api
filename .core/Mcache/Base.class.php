<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Игорь
 * Date: 30.03.14
 * Time: 13:52
 * To change this template use File | Settings | File Templates.
 */

class Mcache extends Pattern_Singleton
{
    const STD_FLAG = 0;

    const EXPIRE_TIME_MIN = 60;

    const EXPIRE_TIME_HOUR = 3600;

    const EXPIRE_STD = self::EXPIRE_TIME_HOUR;

    /**
     * @var Memcache
     */
    private $memcache;

    protected function __construct() {
        if (is_null($this->memcache)) {
            $this->memcache = new Memcache;
            if (!$this->memcache->connect("localhost",11211)) {
                Error::fatal("Memcache connection fail!", Error::MEMCACHE_CONN_FAIL);
            }
        }
    }

    /**
     * @return Mcache
     */
    public static function getInstance() {
        return parent::getInstance();
    }

    public static function add($key, $val, $expire = self::EXPIRE_STD) {
        return self::getInstance()->memcache->add($key, $val, self::STD_FLAG, $expire);
    }

    public static function get($key) {
        return self::getInstance()->memcache->get($key);
    }

    public static function delete($key) {
        return self::getInstance()->memcache->delete($key);
    }
}