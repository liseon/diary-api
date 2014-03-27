<?

class Error_Manager
{
    const CLASS_NOT_FOUND = 1;

    public static function fatal($comment, $code) {
        trigger_error($comment);
        $response = new Response_Manager();
        $response->setError($comment, $code);

        die($response->serialize());
    }
}