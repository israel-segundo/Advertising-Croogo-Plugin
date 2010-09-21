<?php if(isset($ads)): ?>

    <div class="ads_module">

        <?php foreach( $ads as $ad ): ?>

            <div class="ad_element">

            <?php
                echo $html->link($html->image($ad['Ad']['ad_image'],
                                    array(
                                        'alt'   => $ad['Ad']['name'],
                                        'height'=> $ad['Ad']['ad_image_height'],
                                        'width' => $ad['Ad']['ad_image_width']
                                    )
                            ),array('plugin'=>'advertising', 'controller'=>'advertising', 'action'=>'tracking', $ad['Ad']['id']),array('target'=>'_blank','escape'=>false));
            ?>
                
            </div>

        <?php endforeach; ?>

    </div>

<?php endif; ?>
