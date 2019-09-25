<?php
namespace EasyRetailcrm\Library\EasyRequest\Filter;

abstract class Filter
{
    protected $filterData = array();

    abstract public function remove(string $filterName): void;

    abstract public function getValue(): array;
}
