<?php
/**
 * My_MyController
 *
 * @author Richard Knop
 */
class My_MyController extends Zend_Controller_Action
{
    protected $_tables = array();
    
    protected function _getDb()
    {
        return Zend_Registry::get('dbAdapter');
    }
    
    protected function _getTable($table)
    {
        if (false === array_key_exists($table, $this->_tables)) {
            include APPLICATION_PATH . '/modules/'
            . $this->_request->getModuleName() . '/models/' . $table . '.php';
            $this->_tables[$table] = new $table();
        }
        return $this->_tables[$table];
    }
    
    protected function _getForm($form, $action = null)
    {
        include APPLICATION_PATH . '/modules/' . $this->_request->getModuleName()
        . '/forms/' . $form . '.php';
        $form = new $form();
        if (null !== $action) {
            $form->setAction($action);
        }
        return $form;
    }
}