<?php
/**
 * Bootstrap
 *
 * @author Richard Knop
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initFrontController()
    {
        $this->frontController = Zend_Controller_Front::getInstance();
        $this->frontController->addModuleDirectory(APPLICATION_PATH
                                                   . '/modules');
        Zend_Controller_Action_HelperBroker::addPath(
            'My/Controller/Action/Helper',
            'My_Controller_Action_Helper'
        );
        include BASE_PATH . '/library/My/Controller/Plugin/NegotiateContent.php';
        $this->frontController->registerPlugin(new My_Controller_Plugin_NegotiateContent());
        include BASE_PATH . '/library/My/Controller/Plugin/Auth.php';
        $this->frontController->registerPlugin(new My_Controller_Plugin_Auth());
        $this->frontController->setBaseUrl('/');
    }

    protected function _initView()
    {
        $this->view = new Zend_View();
        $this->view->headMeta()->appendHttpEquiv('Content-Style-Type',
                                                 'text/css');
        $this->view->headMeta()->appendHttpEquiv('Content-Language', 'en');
        $this->view->headLink()->appendStylesheet('/css/reset.css');
        $this->view->addHelperPath('My/View/Helper', 'My_View_Helper');
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer'); 
        $viewRenderer->setView($this->view);
    }

    /*protected function _initDb()
    {
        $this->configuration = new Zend_Config_Ini(APPLICATION_PATH
                                                   . '/configs/application.ini',
                                                   APPLICATION_ENVIRONMENT);
        $this->dbAdapter = Zend_Db::factory($this->configuration->database);
        Zend_Db_Table_Abstract::setDefaultAdapter($this->dbAdapter);
    }*/

    protected function _initAuth()
    {
        $this->auth = Zend_Auth::getInstance();
    }
    
    /*protected function _initCache()
    {
        $frontend= array('lifetime' => 7200,
                         'automatic_serialization' => true);
        $backend= array('cache_dir' => 'cache');
        $this->cache = Zend_Cache::factory('core',
                                           'File',
                                           $frontend,
                                           $backend);
    }*/
    
    public function _initTranslate()
    {
        $this->translate = new Zend_Translate('Array',
                                              BASE_PATH . '/languages/Slovak.php',
                                              'sk_SK');
        $this->translate->setLocale('sk_SK');
    }

    protected function _initRegistry()
    {
        $this->registry = Zend_Registry::getInstance();
        //$this->registry->configuration = $this->configuration;
        //$this->registry->dbAdapter = $this->dbAdapter;
        $this->registry->auth = $this->auth;
        //$this->registry->cache = $this->cache;
        $this->registry->Zend_Translate = $this->translate;
    }

    protected function _initUnset()
    {
        unset($this->frontController,
              $this->view,
              //$this->configuration,
              //$this->dbAdapter,
              $this->auth,
              //$this->cache,
              $this->translate,
              $this->registry);
    }

    protected function _initGetRidOfMagicQuotes()
    {
        if (get_magic_quotes_gpc()) {
            function stripslashes_deep($value) {
                $value = is_array($value) ?
                         array_map('stripslashes_deep', $value) :
                         stripslashes($value);
                return $value;
            }

            $_POST = array_map('stripslashes_deep', $_POST);
            $_GET = array_map('stripslashes_deep', $_GET);
            $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
            $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
        }
    }

    public function run()
    {
        $frontController = Zend_Controller_Front::getInstance();
        $frontController->dispatch();
    }
}