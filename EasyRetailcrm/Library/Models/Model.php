<?php
namespace EasyRetailcrm\Library\Models;

use EasyRetailcrm\Exception\BadModelPropertyException;

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
        $obj->$propertyName = $propertyValue;

        if (!property_exists($obj, $propertyName)) {
            throw new BadModelPropertyException("Undefined property `$propertyName` of object `" . static::class);
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

    public function cleanBy(array $props)
    {
        foreach (get_object_vars($this) as $var => $value) {
            if (!in_array($var, $props)) {
                unset($this->$var);
            }
        }
        return $this;
    }
}
