<?php
namespace EasyRetailcrm\Input;

class ResponseFilter extends Filter
{
    public function set(string $filterValue): self
    {
        $this->filterData[] = $filterValue;
        return $this;
    }

    public function remove(string $filterName): void
    {
        if (($key = array_search($filterName, $this->filterData)) !== false) {
            unset($this->filterData[$key]);
        }
    }

    public function getValue(): array
    {
        return $this->filterData;
    }
}
