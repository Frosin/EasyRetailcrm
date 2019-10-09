<?php
namespace EasyRetailcrm\Library\EasyRequest;

use EasyRetailcrm\Exception\InvalidApiMethodException;
use EasyRetailcrm\Exception\BadModelNameException;
use EasyRetailcrm\Library\EasyRequest\Filter\RequestFilter;
use EasyRetailcrm\Library\Models\Order;
use EasyRetailcrm\Library\Models\Customer;
use EasyRetailcrm\Library\Models\OrdersHistory;
use easyRetailcrm\Library\Models\CustomersHistory;

class EasyRequest
{
    public $requestFilter;
    public $method;
    public $resultName;
    public $Model;
    private static $methodsObjects = null;

    public function __construct($method)
    {
        $this->method = $method;

        $this->setPropertiesByMethod($method);
        $this->requestFilter = new RequestFilter;
    }

    private function setPropertiesByMethod($method)
    {
        if (null == self::$methodsObjects) {
            self::$methodsObjects = simplexml_load_file(__DIR__ . '/methods.xml');
        }
        foreach (self::$methodsObjects as $methodObj) {
            if ($methodObj->method == $method) {
                $this->resultName = (string)$methodObj->result;
                $this->Model = $this->getClassByName((string)$methodObj->class);
                return true;
            }
        }

        throw new InvalidApiMethodException("Can't find method " . $this->method . " in methods.xml\n");
    }

    private function getClassByName($name)
    {
        switch ($name) {
            case "Order":
                return Order::class;
                break;
            case "OrdersHistory":
                return OrdersHistory::class;
                break;
            case "Customer":
                return Customer::class;
                break;
            case "CustomersHistory":
                return CustomersHistory::class;
                break;
            default:
                throw new BadModelNameException("Not found `$name` class in switch by ". __METHOD__);
        }
    }
}
