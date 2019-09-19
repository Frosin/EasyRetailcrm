<?php
namespace EasyRetailcrm\Input;

class RequestFilter extends Filter
{
    public function set(string $filterName, $filterValue): self
    {
        $this->filterData[$filterName] = $filterValue;
        return $this;
    }

    public function remove(string $filterName): void
    {
        unset($this->filterData[$filterName]);
    }

    public function getValue(): array
    {
        return $this->filterData;
    }
}
