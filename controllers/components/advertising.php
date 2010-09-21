<?php
/**
 * Example Component
 *
 * An example hook component for demonstrating hook system.
 *
 * @category Component
 * @package  Croogo
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class AdvertisingComponent extends Object {
/**
 * Called after the Controller::beforeFilter() and before the controller action
 *
 * @param object $controller Controller with components to startup
 * @return void
 */
    public function startup(&$controller) {
    }
/**
 * Called after the Controller::beforeRender(), after the view class is loaded, and before the
 * Controller::render()
 *
 * @param object $controller Controller with components to beforeRender
 * @return void
 */
    public function beforeRender(&$controller) {

        if( ! $this->StartsWith($controller->action, 'admin_') ){
            $controller->loadModel('Advertising.Ad');
            $controller->set( 'ads', $controller->Ad->getAdvertisements() );
        }
        
    }
/**
 * Called after Controller::render() and before the output is printed to the browser.
 *
 * @param object $controller Controller with components to shutdown
 * @return void
 */
    public function shutdown(&$controller) {
    }


    // Obtenido de
    // http://www.jonasjohn.de/snippets/php/starts-with.htm
    function StartsWith($Haystack, $Needle){
        return strpos($Haystack, $Needle) === 0;
    }
}
?>
