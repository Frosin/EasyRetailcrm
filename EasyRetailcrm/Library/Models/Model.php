<?php
namespace EasyRetailcrm\Library\Models;

use EasyRetailcrm\Exception\BadCustomerPropertyException;

class Model
{
    public function getValue()
    {
        return (array)$this;
    }

    public function set($propertyName, $propertyValue)
    {
        $this->checkAndSet($this, $propertyName, $propertyValue);

        return $this;
    }

    private static function checkAndSet($obj, $propertyName, $propertyValue)
    {
        if (property_exists($obj, $propertyName)) {
            $obj->$propertyName = $propertyValue;
        } else {
            throw new BadCustomerPropertyException("Bad property `$propertyName` of object `" . static::class);
        }
    }

    public static function getObjectByArray(array $arData)
    {
        $obj = new static();
        if (array_key_exists('0', $arData)) {
            $arData = $arData[0];
        }
        foreach ($arData as $propertyName => $propertyValue) {
            self::checkAndSet($obj, $propertyName, $propertyValue);
        }

        return $obj;
    }

    public static function getObjectsByArrayCollection(array $arData)
    {
        $arObj = array();

        foreach ($arData as $arDataItem) {
            $arObj[] = self::getObjectByArray($arDataItem);
        }
        return $arObj;
    }
}
