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
     * destination element to resporn
     * @var string
     */
    public $element;
    /**
     * @var
     */
    public $format;

    public $data;

    function __construct($message = null, $format = 'JSON', $type = null)
    {
        $this->format = $format;
        switch(strtoupper($format)) {
            case 'JSON':
                self::responseJson();
                break;
        }

        $this->message = $message;
        $this->type = $type;
    }


    public static function responseJson() {
        Factory::getResponse()->setContentType('application/json');
    }

    public function toString() {
        return json_encode($this);
    }

    public static function responseError($message, $data = null, $format = 'JSON') {
        $ajax = new self;
        $ajax->message = $message;
        $ajax->type = self::ERROR;
        if($data != null) {
            $ajax->data = $data;
        }
        return $ajax->toString();
    }

    public static function responseSuccess($message, $data = null, $format = 'JSON') {
        $ajax = new self;
        $ajax->message = $message;
        $ajax->type = self::SUCCESS;
        if($data != null) {
            $ajax->data = $data;
        }
        return $ajax->toString();
    }
}
