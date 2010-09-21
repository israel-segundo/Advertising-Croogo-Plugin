<?php

class Ad extends AdvertisingAppModel{
    var $name       = 'Ad';
    var $useTable   = 'advertising';


    public function getAvailableSlots( $slot_limit, $insert_slot=null ){


        $slots          = array_values( range(1,$slot_limit) );

        $occupied_slots = array_values($this->find('list',
                array(  'conditions'=>array('Ad.active' => 1),
                        'fields' => array('Ad.slot'))));

        $difference     = array_diff($slots, $occupied_slots);

        
        if( $insert_slot != null && !in_array($insert_slot, $difference)){
            array_push($difference, $insert_slot);
        }

        sort( $difference );
        $available_slots  = array_combine( array_values($difference) , array_values($difference) );
        
        return $available_slots;
    }

    public function getAdvertisements(){
        return $this->find('all', array('order' => 'Ad.slot','conditions'=>array('Ad.active' => 1) ));
    }

    public function add_click( $id ){

        $ad = $this->findById($id);

        if( $ad ){

            $id     = $ad['Ad']['id'];
            $clicks = $ad['Ad']['clicks'] + 1;

            $this->set(array(
                'id'     => $id,
                'clicks' => $clicks
            ));
            $this->save();
        }

    }
}

?>
