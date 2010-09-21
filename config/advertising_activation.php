<?php

class AdvertisingActivation {

    public function beforeActivation(&$controller) {
        return true;
    }

    public function onActivation(&$controller) {

        
        $controller->Croogo->addAco('Advertising'); 
        $controller->Croogo->addAco('Advertising/admin_index'); 
        $controller->Croogo->addAco('Advertising/admin_save_ad');
        $controller->Croogo->addAco('Advertising/admin_delete_ad');
        $controller->Croogo->addAco('Advertising/admin_configuration');
        $controller->Croogo->addAco('Advertising/admin_store_configuration');
        $controller->Croogo->addAco('Advertising/tracking', array('registered', 'public','suicida', 'invitado'));
        $controller->Croogo->addAco('Advertising/index', array('registered', 'public')); 

        $this->createDatabaseSchemas($controller);
        $this->createBlock($controller);
        $this->resetSettings($controller);
    }

    public function beforeDeactivation(&$controller) {
        return true;
    }

    public function onDeactivation(&$controller) {
        $controller->Croogo->removeAco('Advertising');
        $this->removeBlock($controller);
    }

    public function createDatabaseSchemas(&$controller){

        App::Import('CakeSchema');
        $CakeSchema = new CakeSchema();
        $db =& ConnectionManager::getDataSource('default');

        $schema_files = array(
            'advertising.php',
        );
        foreach($schema_files as $schema_file) {
        	$class_name = Inflector::camelize(substr($schema_file, 0, -4)).'Schema';
        	$table_name = substr($schema_file, 0, -4);
                
        	if(!in_array($table_name, $db->_sources)) {
	        	include_once(APP.'plugins'.DS.'advertising'.DS.'config'.DS.'schema'.DS.$schema_file);
	        	$ActivateSchema = new $class_name;
	        	$created = false;
				if(isset($ActivateSchema->tables[$table_name])) {
					$db->execute($db->createSchema($ActivateSchema, $table_name));
				}
			}
        }
    }

    public function resetSettings(&$controller){

        $advertising_options = array(
            'slots'    => '4'
        );

        $setting = $controller->Setting->find('first',
                                              array('conditions'=>array('Setting.key'=>'Advertising.options')));

        $setting['Setting']['key']   = 'Advertising.options';
        $setting['Setting']['value'] = $controller->Node->encodeData($advertising_options,
                                                                        array('trim'=>false,'json'=>true));
        $controller->Setting->save($setting);
    }

    public function createBlock(&$controller){

        $controller->loadModel('Block');
        $controller->Block->create();
        $controller->Block->set(array(
            'visibility_roles' => $controller->Node->encodeData(array("1","2","3","4","5","6")),
            'visibility_paths' => '',
            'region_id'        => 4, // Right
            'title'            => 'Advertising',
            'alias'            => 'advertising_plugin',
            'body'             => '[element:advertisement plugin="advertising"]',
            'show_title'       => 1,
            'status'           => 1
        ));
        $controller->Block->save();
    }

    public function removeBlock(&$controller){

        $controller->loadModel('Block');
        $block = $controller->Block->find('first', array('conditions'=>array('Block.alias'=>'cumulus_plugin')));

        if( $block ){
            $controller->Block->delete($block['Block']['id']);
        }

    }
}
?>
