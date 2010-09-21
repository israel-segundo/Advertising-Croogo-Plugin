<?php

class AdvertisingSchema extends CakeSchema{

    var $name = 'Advertising';

    function before($event = array()) {}
    function after($event = array()) {}

    var $advertising = array(
        'id'                => array('type' => 'integer',   'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
        'name'              => array('type' => 'string',    'null' => false, 'default' => '','lenght'=>100),
        'target_url'        => array('type' => 'text',      'null' => false, 'default' => ''),
        'ad_image'          => array('type' => 'text',      'null' => false, 'default' => ''),
        'ad_image_width'    => array('type' => 'integer',   'null' => false, 'default' => NULL, 'length' => 11),
        'ad_image_height'   => array('type' => 'integer',   'null' => false, 'default' => NULL, 'length' => 11),
        'slot'              => array('type' => 'integer',   'null' => false, 'default' => NULL, 'length' => 11),
        'expiration'        => array('type' => 'integer',   'null' => false, 'default' => NULL, 'length' => 1),
        'active'            => array('type' => 'integer',   'null' => false, 'default' => 1, 'length' => 1),
        'click_tracking'    => array('type' => 'integer',   'null' => false, 'default' => NULL, 'length' => 11),
        'clicks'            => array('type' => 'integer',   'null' => false, 'default' => NULL, 'length' => 11),
        'created'           => array('type' => 'timestamp', 'null' => false, 'length' => NULL),
        'updated'           => array('type' => 'timestamp', 'null' => false, 'length' => NULL),
        'tableParameters'   => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
    );

}

?>