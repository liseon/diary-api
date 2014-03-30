<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Игорь
 * Date: 30.03.14
 * Time: 13:22
 *
 * Модель для управления текущей сессией.
 * 1) Сессия для авторизации. Хранится в Мемкэше n секунд
 * 2) После авторизации сессия привязывается к пользователю и хранится в БД
 * 3) Ключ сессии будет выдаваться в ответе после каждого запроса с верной авторизацией.
 *      При этом, ключ сессии может менять при каждом запросе или быть статичным на весь период сессии.
 *      Это будет зависеть от версии API. В версии 1 сделаем статичный ключ, т.к. это удобнее для
 *      отлкадки тестового приложения.
 */

class Api_Session extends Pattern_Singleton
{
    /**
     * Строковый ключ текущей сессии
     *
     * @var string
     */
    private $sid;

    const MEMCACHE_KEY_PREFIX = "tempsid_";

    const SOLT = "ddsuIop";

    /**
     * @var bool
     */
    private $isAuth = false;

    protected function __construct() {
        if (Request::issetParam(Api_ParamNames::SID)) {

        } else {
            $this->sid = self::createTemporarySid();
        }

        Response::getInstance()->setArg(Api_ParamNames::IS_AUTH, $this->isAuth);
        Response::getInstance()->setArg(Api_ParamNames::SID, $this->sid);
    }

    /**
     * @return Api_Session
     */
    public static function getInstance() {
        return parent::getInstance();
    }

    private static function createTemporarySid() {
        $sid = self::createHash();
        $key = self::getMemcacheKey($sid);
        Mcache::add($key, Request::getIp());

        return $sid;
    }

    private static function getMemcacheKey($hash) {
       return self::MEMCACHE_KEY_PREFIX . $hash;
    }

    private static function createHash() {
        $string = rand(1,10000000) . Request::getIp() . self::SOLT;

        return md5($string);
    }


}