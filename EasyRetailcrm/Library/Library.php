<?php
namespace EasyRetailcrm\Library;

use EasyRetailcrm\Exception\BadRequestException;
use EasyRetailcrm\Library\EasyRequest\EasyRequest;
use EasyRetailcrm\Library\Models\Customer;
use EasyRetailcrm\Library\Models\Order;

class Library
{
    protected $apiClient;

    public function __construct($apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function easyGet(EasyRequest $request, $showStatus = false)
    {
        $page = 1;
        $resultList = [];
        $resultName = $request->resultName;
        do {
            $apiObject = call_user_func_array(
                [
                    $this->apiClient->request,
                    $request->method
                ],
                [
                    $request->requestFilter->getValue(),
                    $page,
                    100
                ]
            );

            if (!$apiObject->success) {
                throw new BadRequestException($apiObject['errorMsg'] . " = " . print_r($apiObject['errors'], 1));
            }

            $totalPage = $apiObject->pagination['totalPageCount'];
            $resultData = $apiObject->$resultName;
            $resultList = $resultData;

            if (!empty($request->responseFilter->getValue)) {
                $resultList = [];
                foreach ($resultData as $item) {
                    $itemTemp = [];
                    foreach ($request->responseFilter->getValue() as $key) {
                        if (array_key_exists($key, $item)) {
                            $itemTemp[$key] = $item[$key];
                        } else {
                            $itemTemp[$key] = (is_array($item[$key])? []: "");
                        }
                    }
                    $resultList[] = $itemTemp;
                }
            }
            if ($showStatus) {
                echo "page: $page/$totalPage\n";
            }
            $page++;
        } while ($page <= $totalPage);

        return $request->Model::getObjectsByArrayCollection($resultList);
    }

    private function checkResult($result)
    {
        if (false == $result->success) {
            $errorMsg = "";
            $errorMsg .= $result->errorMsg;
            if (isset($result->errors)) {
                $errorMsg .= print_r($result->errors, true);
            }
            throw new BadRequestException($errorMsg);
        }
        if (isset($result->id)) {
            return $result->id;
        }
        return true;
    }

    public function customerEdit(Customer $customer, $by = 'id')
    {
        $result = $this->apiClient->request->customersEdit($customer->getValue(), $by, $customer->site);

        return $this->checkResult($result);
    }

    public function customerCreate(Customer $customer)
    {
        $result = $this->apiClient->request->customersCreate($customer->getValue(), $customer->site);

        return $this->checkResult($result);
    }

    public function orderEdit(Order $order, $by = 'id')
    {
        $result = $this->apiClient->request->ordersEdit($order->getValue(), $by, $order->site);

        return $this->checkResult($result);
    }

    public function orderCreate(Order $order)
    {
        $result = $this->apiClient->request->ordersCreate($order->getValue(), $order->site);

        return $this->checkResult($result);
    }
}
