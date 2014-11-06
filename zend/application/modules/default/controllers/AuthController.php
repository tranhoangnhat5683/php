<?php
/**
 * AuthController
 *
 * @author Richard Knop
 */
class AuthController extends My_MyController
{
    public function init()
    {

    }

    public function signInAction()
    {
        $request = $this->getRequest();
        $users = $this->_getTable('Users');

        try {

            $form = $this->_getForm('SignIn');
            
            foreach ($_GET as $k => $v) {
                $_GET[$k] = urldecode($v);
            }

            if (false == $form->isValid($_POST)
                && false == $form->isValid($_GET)) {
                throw new Exception ('Nesprávny login alebo heslo');
            }
            
            $login = $request->getParam('login');
            $validator = new Zend_Validate_EmailAddress();
            if (false === $validator->isValid($login)) {
                $u = $users->getSingleWithUsername($login);
                if (null === $u) {
                    throw new Exception ('Nesprávny login alebo heslo');
                }
                $login = $u->email;
            }

            // prepare adapter for Zend_Auth
            $adapter = new Zend_Auth_Adapter_DbTable($this->_getDb());
            $adapter->setTableName('users');
            $adapter->setIdentityColumn('email');
            $adapter->setCredentialColumn('password_hash');
            $adapter->setCredentialTreatment('CONCAT(SUBSTRING(password_hash, 1, 40), SHA1(CONCAT(SUBSTRING(password_hash, 1, 40), ?)))');
            $adapter->setIdentity($login);
            $adapter->setCredential($request->getParam('password'));

            // try to authenticate a user
            $auth = Zend_Registry::get('auth');
            $result = $auth->authenticate($adapter);

            // is the user valid one?
            switch ($result->getCode()) {

                case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
                    throw new Exception ('Identita v databáze neexistuje');
                    break;

                case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
                    throw new Exception ('Nesprávne heslo');
                    break;

                case Zend_Auth_Result::SUCCESS:
                    // get user object (ommit password_hash)
                    $user = $adapter->getResultRowObject(null, array('password_hash'));
                    // check if the user is approved
                    if ('active' !== $user->status) {
                        throw new Exception ('Používateľský účet nie je aktívny');
                    } else {
                        // to help thwart session fixation/hijacking
                        // 604800s = 7 days
                        Zend_Session::rememberMe(604800);
                        // store user object in the session
                        $authStorage = $auth->getStorage();
                        $authStorage->write($user);
                        $this->_redirect('/');
                    }
                    break;

                default:
                    throw new Exception ('Nesprávny login alebo heslo2');
                    break;
            }
        
        } catch (Exception $e) {
            $this->_redirect('/index/index?error='
                             . urlencode($e->getMessage()));
        }
    }

    public function signOutAction()
    {
        Zend_Registry::get('auth')->clearIdentity();
        $this->_redirect('/');
    }
}