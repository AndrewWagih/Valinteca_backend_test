<?php
class ParentClass
{
    final public function greet()
    {
        echo 'greet from parent class';
    }
}


class ChildClass extends ParentClass
{
    public function greet()
    {
        echo 'greet from child class';
    }
}

$childClass =  new ChildClass();
$childClass->greet();
/* 
    when use final before function greet to disable the ChildClass from overriding greet method in ParentClass.
    and if developer try to define the greet() method will return message error ( fatal error: Cannot override final method ParentClass::greet() ) 
*/