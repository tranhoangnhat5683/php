<?php
/**
 * ErrorController
 *
 * @author Richard Knop
 */
class ErrorController extends My_MyController
{
    public function init()
    {
	$this->_helper->layout->setLayout('default');
    }
    
    public function errorAction() 
    {        
        $errors = $this->_getParam('error_handler');
        switch ($errors->type) { 
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
		
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error - controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $this->view->headTitle('Page not found');
                $this->view->message = 'Page not found';
                break; 
            default: 
                // Application error
                $this->getResponse()->setHttpResponseCode(500);
                $this->view->headTitle('Application error');
                $this->view->message = 'Application error';
                break; 
        }
	
        $this->view->exception = $errors->exception;
        $this->view->request = $errors->request;
    }

    public function deniedAction()
    {
        $this->view->headTitle('Access denied');
    }
}