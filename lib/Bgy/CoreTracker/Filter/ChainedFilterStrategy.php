<?php

namespace Bgy\CoreTracker\Filter;

class ChainedFilterStrategy implements FilterStrategyInterface
{
    private $filters = array();

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    /**
     * @param array $collectedClass
     * @param bool $inverse
     * @return boolean
     */
    public function shouldBeFiltered($collectedClass, $inverse = null)
    {
        $shouldBeFiltered = false;
        /** @var $filter FilterStrategyInterface */
        foreach ($this->filters as $filter) {
            $shouldBeFiltered |= $filter->shouldBeFiltered($collectedClass, $inverse);
        }

        return $shouldBeFiltered;
    }
}
