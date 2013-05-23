<?php
use Flywheel\Controller\ApiController;
use Flywheel\Base;
use Flywheel\Factory;

\Flywheel\Loader::import('global.include.SystemApi', true);

class BaseApiController extends ApiController {
    /**
     * @var \CoreApi\Request
     */
    public $apiRequest;

    /**
     * @var \Consumer;
     */
    protected $_consumer;

    protected function _verifyRequest() {
        $server = new SystemApiServer(new SystemApiDataStore());
        if ('PUT' == $_SERVER['REQUEST_METHOD'] || 'DELETE' == $_SERVER['REQUEST_METHOD']) {
            $params = $this->request()->getRestParams();
            $request = \CoreApi\Request::fromRequest(null, null, $params);
        } else {
            $request = \CoreApi\Request::fromRequest();
        }

        $result = $server->verifyRequest($request);
        $this->apiRequest = $request;
        $this->_consumer = \Consumer::retrieveByKey($result[0]->key);
    }

    /**
     * @return Consumer
     */
    public function getConnectConsumer() {
        return $this->_consumer;
    }

    protected function _checkConsumerAccessPermission() {
        //check API
        $consumer = $this->getConnectConsumer();
        if ($consumer && '*' != $consumer->allowed_ips) {
            $allowedIps = explode(',', $consumer->allowed_ips);
            $remoteIp = isset($_SERVER['HTTP_X_FORWARDED_FOR'])
                ? $_SERVER['HTTP_X_FORWARDED_FOR']
                : $_SERVER['REMOTE_ADDR'];

            if (!in_array($remoteIp, $allowedIps)) {
                throw new \Flywheel\Exception\Api("Not allow consumer ip: {$remoteIp}", 403);
            }
        }
    }

    public function beforeExecute() {
//        $this->_verifyRequest();
//        $this->_checkConsumerAccessPermission();
    }

    /**
     * @param int $status
     * @param array $body
     * @return void|array
     */
    public function sendResponse($status = 200, $body = array()) {
        if (is_object($body)) {
            $body = get_object_vars($body);
        }

        if (200 == $status) {
            return parent::sendResponse(200, $body);
        } else {
            \CoreApi\ErrorHandler::printError($status, $body);
        }
    }
}
