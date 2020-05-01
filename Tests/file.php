<?php
class file
{
    public function __construct(){
        //todo
    }

    public function testIf()
    {
        if(true)
        {
            echo 'true';
        }
    }

    public function testArray()
    {
       $x = array(1,    "3",1  ,4);
       return array(
           "fsdfsdf"        => 'dsdsds',
           "fsdfsdffdfdfdf" => 'dsdsds',
           "fsdfsdfgggg"    => 'dsdsds',
           "fsdfsdfbbb"     => $x
       );
    }

    public function testType():string
    {
        return 'string';
    }
}
