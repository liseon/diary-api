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
        $file = '../.packages/' . $class . '.class.php';
        if (!includeFile($file)) {
            $file = '../.packages/' . $class . '.class.php';
            if (!includeFile($file)) {

                Error_Manager::fatal("Class {$class} not found! Api version: ", Error_Manager::CLASS_NOT_FOUND);
            }
        }
    }
);