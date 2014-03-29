<?
function includeFile($file) {
    if (file_exists($file)) {
        include_once $file;

        return true;
    }

    return false;
}

spl_autoload_register(
    function ($class) {
        $corePath = "../.core";
        $baseName = "Base";
        $classExpl = explode("_", $class);
        if (count($classExpl) == 1) {
            $classExpl[] = $baseName;
        }
        if ($classExpl[0] == "Api") {
            $api = Request::getApiVersion();
            $corePath = "v{$api}/.packages";
            unset($classExpl[0]);
        } elseif ($classExpl[0] == "Controller") {
            $api = Request::getApiVersion();
            $corePath = "v{$api}/.controllers";
            unset($classExpl[0]);
        }

        array_unshift($classExpl, $corePath);

        $filePath = implode("/", $classExpl);
        $filePath .= ".class.php";

        if (!includeFile($filePath)) {
            Error::fatal("Class {$class} not found! Api version: ", Error::CLASS_NOT_FOUND);
        }
    }
);

$controller = "Controller_" . Request::getController();
$action = "action" . Request::getAction();
(new $controller)->$action();

