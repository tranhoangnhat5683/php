<?php
class My_Controller_Plugin_NegotiateContent extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $viewRenderer = Zend_Controller_Action_HelperBroker::getExistingHelper('ViewRenderer');
        $viewRenderer->initView();
        $view = $viewRenderer->view;
        
        // content negotiation
        header('Vary: Accept');
        if (false === stristr($_SERVER['HTTP_ACCEPT'], 'application/xhtml+xml')) {
            
            header('Content-Type: text/html; charset=utf-8');
            $view->doctype('HTML4_STRICT');
            $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8');
            $view->xhtmlAllowed = false;
            
        } else {
            
            header('Content-Type: application/xhtml+xml; charset=utf-8');
            $view->doctype('XHTML1_STRICT');
            $view->headMeta()->appendHttpEquiv('Content-Type', 'application/xhtml+xml; charset=UTF-8');
            $view->xhtmlAllowed = true;
            
        }
    }
}