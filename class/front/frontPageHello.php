<?php
class frontPageHello extends Controller_Front
{
    protected function run($args)
    {
    	$this->assign('test', 'Hello World!!');
    }
}
