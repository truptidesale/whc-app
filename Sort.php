<?php
namespace WhcApp;

class Sort implements OperationInterface
{
    private $values = [];

    function __construct($values)
    {
        $this->values = array_map('intval', $values);
    }

    public function execute() : string
    {
        sort($this->values);
        return $this->display($this->values);
    }

    // Function to diaplay array in html format.
    public function display(array $array) : string
    {
        $result = '';
        foreach($array as $val) {
            $result .= $val . '</br>';
        }

        return $result;
    }
}
