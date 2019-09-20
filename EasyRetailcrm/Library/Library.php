<?php
namespace EasyRetailcrm\Library;

use EasyRetailcrm\Exception\BadRequestException;
use EasyRetailcrm\Library\EasyRequest\EasyRequest;

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

        return $resultList;
    }
}
