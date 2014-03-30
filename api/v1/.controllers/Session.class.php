<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Игорь
 * Date: 29.03.14
 * Time: 16:38
 * To change this template use File | Settings | File Templates.
 */

class Controller_Session
{

    public function actionDefault() {
        $response = Response::getInstance();
        Api_Session::getInstance();
        $response->output();
    }

}