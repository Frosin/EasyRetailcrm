<?php
namespace EasyRetailcrm\Library\Models;

class CustomersHistory extends Model
{
    public $id;
    public $createdAt;
    public $created;
    public $deleted;
    public $source;
    public $field;
    public $user;
    public $apiKey;
    public $customer;
    public $oldValue;
    public $newValue;
    public $combinedTo;
}
