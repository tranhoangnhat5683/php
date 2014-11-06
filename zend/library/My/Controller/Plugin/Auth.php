<?php
/**
 * plugin for authenticating users and managing access levels
 *
 * @author Richard Knop
 */
class My_Controller_Plugin_Auth extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $auth = Zend_Registry::getInstance()->get('auth');
        $acl = new Zend_Acl();

        // for default module
        if ('default' === $request->getModuleName()) {

            // access resources
            $acl->add(new Zend_Acl_Resource('index'));
            $acl->add(new Zend_Acl_Resource('error'));

            // access roles
            $acl->addRole(new Zend_Acl_Role('guest'));
            $acl->addRole(new Zend_Acl_Role('user'));
            $acl->addRole(new Zend_Acl_Role('administrator'));

            // access rules
            $acl->allow('guest');
            $acl->allow('user');
            $acl->allow('administrator');

            if ($auth->getIdentity() && 'approved' === $auth->getIdentity()->status) {
                $role = $auth->getIdentity()->role;
                Zend_Registry::set('identity',  $auth->getIdentity());
            } else {
                $role = 'guest';
            }

            $controller = $request->getControllerName();
            $action = $request->getActionName();

            if (false === $acl->isAllowed($role, $controller, $action)) {
                $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
                $redirector->gotoUrlAndExit('error/denied');
            }

        }
        // for administer module
        else if ('administer' === $request->getModuleName()) {

            // access resources
            $acl->add(new Zend_Acl_Resource('index'));

            // access roles
            $acl->addRole(new Zend_Acl_Role('guest'));
            $acl->addRole(new Zend_Acl_Role('user'));
            $acl->addRole(new Zend_Acl_Role('administrator'));

            // access rules
            $acl->allow('administrator');

            if ($auth->getIdentity() && 'approved' === $auth->getIdentity()->status) {
                $role = $auth->getIdentity()->role;
                Zend_Registry::set('identity',  $auth->getIdentity());
            } else {
                $role = 'guest';
            }

            $controller = $request->getControllerName();
            $action = $request->getActionName();

            if (false === $acl->isAllowed($role, $controller, $action)) {
                $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
                $redirector->gotoUrlAndExit('error/denied');
            }

        }
    }
}