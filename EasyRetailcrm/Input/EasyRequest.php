<?php
namespace EasyRetailcrm\Input;

use EasyRetailcrm\Exception\InvalidApiMethodException;

class EasyRequest
{
    public $requestFilter;
    public $responseFilter;
    public $method;
    public $resultName;
    private static $methodsObjects = null;

    public function __construct($method)
    {
        $this->method = $method;
        if (null == self::$methodsObjects) {
            self::$methodsObjects = simplexml_load_file(__DIR__ . '/methods.xml');
        }
        $this->resultName = $this->getResultByMethod();
        $this->requestFilter = new RequestFilter;
        $this->responseFilter = new ResponseFilter;
    }

    private function getResultByMethod()
    {
        foreach (self::$methodsObjects as $methodObj) {
            if ($methodObj->method == $this->method) {
                return $methodObj->result;
            }
        }

        throw new InvalidApiMethodException("Can't find method " . $this->method . " in methods.xml\n");
    }
}
