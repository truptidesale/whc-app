<?php
namespace WhcApp;

class Add implements OperationInterface
{
    private $values = [];

    function __construct(array $values)
    {
        $this->values = array_map('intval', $values);
    }

    public function execute() : int
    {
        return array_sum($this->values);
    }
}
