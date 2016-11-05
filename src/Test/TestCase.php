<?php

namespace Porn\Test;

class TestCase extends \PHPUnit_Framework_TestCase
{
    public function getMockedClass($class, $methods = [])
    {
        return $this->getMockBuilder($class)
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock();
    }

    public function getMockedAbstractClass($class, $methods = [])
    {
        return $this->getMockForAbstractClass(
            $class, [], '', false, false, false, $methods,false
        );
    }

    public function getProperty($class, $name)
    {
        $property = new \ReflectionProperty($class, $name);
        $property->setAccessible(true);
        return $property;
    }

    public function getMethod($class, $name)
    {
        $method = new \ReflectionMethod($class, $name);
        $method->setAccessible(true);
        return $method;
    }
}
