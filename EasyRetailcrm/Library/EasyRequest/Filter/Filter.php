<?php
namespace EasyRetailcrm\Library\EasyRequest\Filter;

abstract class Filter
{
    private $filterData;

    abstract public function remove(string $filterName): void;

    abstract public function getValue(): array;
}
