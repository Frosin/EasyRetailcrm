<?php
namespace EasyRetailcrm\Library\Models;

class Customer extends Model
{
    public $id;
    public $externalId;
    public $firstName;
    public $lastName;
    public $patronymic;
    public $sex;
    public $email;
    public $phones;
    public $address;
    public $createdAt;
    public $birthday;
    public $managerId;
    public $vip;
    public $bad;
    public $site;
    public $source;
    public $contragent;
    public $personalDiscount;
    public $cumulativeDiscount;
    public $discountCardNumber;
    public $emailMarketingUnsubscribedAt;
    public $avgMarginSumm;
    public $marginSumm;
    public $totalSumm;
    public $averageSumm;
    public $ordersCount;
    public $costSumm;
    public $maturationTime;
    public $firstClientId;
    public $lastClientId;
    public $browserId;
    public $mgCustomerId;
    public $photoUrl;
    public $customFields;
    public $segments;
}
