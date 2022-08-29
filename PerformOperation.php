<?php
namespace WhcApp;

class PerformOperation
{
    public function process(OperationInterface $command)
    {
        return $command->execute();
    }
}
