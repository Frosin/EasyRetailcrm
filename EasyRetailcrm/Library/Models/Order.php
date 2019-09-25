<?php
namespace EasyRetailcrm\Library\Models;

class Order extends Model
{
    public $id;
    public $slug;
    public $externalId;
    public $number;
    public $firstName;
    public $lastName;
    public $patronymic;
    public $email;
    public $phone;
    public $additionalPhone;
    public $createdAt;
    public $statusUpdatedAt;
    public $managerId;
    public $mark;
    public $call;
    public $expired;
    public $fromApi;
    public $markDatetime;
    public $customerComment;
    public $managerComment;
    public $status;
    public $statusComment;
    public $fullPaidAt;
    public $site;
    public $orderType;
    public $orderMethod;
    public $countryIso;
    public $summ;
    public $totalSumm;
    public $prepaySum;
    public $purchaseSumm;
    public $discountManualAmount;
    public $discountManualPercent;
    public $weight;
    public $length;
    public $width;
    public $height;
    public $shipmentStore;
    public $shipmentDate;
    public $clientId;
    public $shipped;
    public $uploadedToExternalStoreSystem;
    public $source;
    public $contragent;
    public $contragentType;
    public $customer;
    public $delivery;
    public $marketplace;
    public $items;
    public $customFields;
    public $payments;
}
