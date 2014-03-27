<?

class Response_Manager
{
    /**
     * @var array
     */
    private $args;

    private $errorText;

    private $errorCode;

    public function __construct() {
    }

    public function setArgs($args) {
        $this->args = $args;
    }

    public function setError($errorText, $errorCode) {
        $this->errorText = $errorText;
        $this->errorCode = $errorCode;
    }

    public function serialize() {

        return json_encode(
            array_merge(
                $this->errorText,
                $this->errorCode,
                $this->args
            )
        );
    }
}