<?php
/**
 * IndexController
 *
 * @author Richard Knop
 */
class IndexController extends My_MyController
{    
    public function init()
    {
    }
    
    public function indexAction() 
    {
        $this->view->headTitle('Zend blank project v1.5');
    }
}