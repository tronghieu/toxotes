<?php
use Flywheel\Factory;

class AjaxResponse extends stdClass {
    const SUCCESS = 1,
        WARNING = 2,
        ERROR = 0;



    /**
     * response type SUCCESS|WARNING|ERROR
     * @var string
     */
    public $type;

    /**
     * response message
     * @var string
     */
    public $message;

    /**
     * response system message
     * @var string
     */
    public $sysMessage;

    /**
     * @var
     */
    public $format;

    function __construct($message = null, $format = 'JSON')
    {
        $this->format = $format;
        switch(strtoupper($format)) {
            case 'JSON':
                self::responseJson();
                break;
        }

        $this->message = $message;
    }

    public static function responseJson() {
        Factory::getResponse()->setContentType('application/json');
    }

    public function toString() {
        return json_encode($this);
    }
}
