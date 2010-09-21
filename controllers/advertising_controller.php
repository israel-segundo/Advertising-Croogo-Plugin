<?php

class AdvertisingController extends AdvertisingAppController {

    public $name = 'Advertising';
    public $uses = array('Setting','Advertising.Ad');

    public function admin_index() {

        $this->set('title_for_layout', __('Advertisings', true));
        $this->set('ads', $this->Ad->find('all'));
    }

    public function index() {
        $this->set('title_for_layout', __('Example', true));
        
    }

    public function admin_new_ad(){

        $setting = $this->getAdvertisingSettings();

        $this->set('title_for_layout', __('New advertisement', true));
        $this->set('available_slots', $this->Ad->getAvailableSlots($setting['slots']) );

    }

    public function admin_edit_ad( $ad_id ){

        $ad = $this->Ad->findById($ad_id);

        if( ! $ad ){
            $this->Session->setFlash('ID unexistent');
            $this->redirect( $this->referer() );
        }

        $setting = $this->getAdvertisingSettings();

        $this->set(compact('ad'));
        $this->set('available_slots', $this->Ad->getAvailableSlots($setting['slots'], $ad['Ad']['slot']) );
        $this->set('title_for_layout', __('Edit advertisement', true));
    }

    public function admin_delete_ad( $ad_id=null ){

        if( $ad_id == null){
            $this->redirect($this->referer());
            return;
        }

        $message = ($this->Ad->delete($ad_id)) ? 'The ad has been sucessfully removed' : 'There was an error with your request';

        $this->Session->setFlash(__($message,true));
        $this->redirect(array('plugin'=>'advertising', 'controller'=>'advertising', 'action'=>'admin_index'));
    }

    public function admin_save_ad(){

        if(empty($this->data)){
            $this->redirect($this->referer());
            return;
        }

        if( !isset($this->data['Ad']['id']) ){
            $this->Ad->create();
        }
        
        $message = ($this->Ad->save($this->data)) ? 'The ad has been saved sucessfully' : 'There was an error with your request';

        $this->Session->setFlash(__($message,true));
        $this->redirect(array('plugin'=>'advertising', 'controller'=>'advertising', 'action'=>'admin_index'));
    }

    public function admin_configuration(){

        $this->set('title_for_layout', __('Plugin configuration', true));
        
        $setting = $this->getAdvertisingSettings();
        $this->set(compact('setting'));
    }

    public function admin_store_configuration(){

        if(empty($this->data)){
            $this->redirect($this->referer());
            return;
        }

        $setting          = $this->getAdvertisingSettings();
        $setting['slots'] = $this->data['Setting']['total_slots'];
        
        $message = ($this->saveSettings('Advertising.options', $setting)) ? 'Plugin options saved' : 'There was an error with your request';
        
        $this->Session->setFlash(__($message,true));
        $this->redirect(array('plugin'=>'advertising', 'controller'=>'advertising', 'action'=>'configuration'));

    }

    public function getAdvertisingSettings(){
        return $this->Node->decodeData(Configure::read('Advertising.options'));
    }

    public function saveSettings( $settings_name, $new_settings ){

        $data       = $this->Node->encodeData( $new_settings, array('trim'=>false,'json'=>true) );
        $settings   = $this->Setting->find('first',array('conditions'=>array('key'=>$settings_name)));

        $settings['Setting']['value'] = $data;

        $success = Configure::write('Advertising.options', $data) && $this->Setting->save($settings);

        return $success;
    }

    public function tracking( $ad_id=null ){

        if( $ad_id == null ){
            $this->redirect($this->referer());
            return;
        }

        $ad = $this->Ad->findById($ad_id);

        if( $ad ){

            if( $ad['Ad']['click_tracking'] == 1){
                $this->Ad->add_click($ad['Ad']['id']);
            }
            $this->redirect( $ad['Ad']['target_url'] );

        }else{
            $this->redirect($this->referer());
        }

    }
}
?>
