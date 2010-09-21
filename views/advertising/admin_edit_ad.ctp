<div class="example index">

    <h2><?php echo $title_for_layout; ?></h2>

    <div>
        <?php

            echo $form->create(null, array('url' => array('plugin'=>'advertising','controller' => 'advertising', 'action' => 'admin_save_ad')));

            echo $form->input('Ad.id', array('type'=>'hidden', 'value' => $ad['Ad']['id']));

            echo $form->input('Ad.name',
                    array( 'value' => $ad['Ad']['name'] )
            );

            echo $form->input('Ad.target_url',
                    array( 'value' => $ad['Ad']['target_url'] )
            );

            echo $form->input('Ad.ad_image',
                    array( 'value' => $ad['Ad']['ad_image'] )
            );

            echo $form->input('Ad.ad_image_width',
                    array( 'value' => $ad['Ad']['ad_image_width'] )
            );

            echo $form->input('Ad.ad_image_height',
                    array( 'value' => $ad['Ad']['ad_image_height'] )
            );

            echo $form->input('Ad.slot',
                    array(
                        'options' => $available_slots,
                        'type'    => 'select',
                        'value' => $ad['Ad']['slot']
                    )
            );
            echo $form->input('Ad.expiration',
                    array(
                        'options' => array(
                                     '7' => __('7 days',true),
                                    '15' => __('15 days',true),
                                    '30' => __('30 days',true)
                         ),
                        'type'    => 'select',
                        'value' => $ad['Ad']['expiration']
                    )
            );
            echo $form->input('Ad.click_tracking',
                    array(
                        'type'    => 'checkbox',
                        'checked' => (($ad['Ad']['click_tracking']==1)?true:false)
                    )
            );

            echo $form->input('Ad.active',
                    array(
                        'type'    => 'checkbox',
                        'checked' => (($ad['Ad']['active']==1)?true:false)
                    )
            );
            echo $form->submit(__('Send',true));
            echo $form->end();
        ?>
    </div>
</div>