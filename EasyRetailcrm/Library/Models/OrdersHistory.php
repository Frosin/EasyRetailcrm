<?php
namespace EasyRetailcrm\Library\Models;

class OrdersHistory extends Model
{
    public $id;
    public $createdAt;
    public $created;
    public $deleted;
    public $source;
    public $field;
    public $user;
    public $apiKey;
    public $order;
    public $oldValue;
    public $newValue;
}
