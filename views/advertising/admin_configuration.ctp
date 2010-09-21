<?php
    $slots = isset($setting['slots']) ? $setting['slots'] : '4';
?>
<div class="example index">
    <h2><?php echo $title_for_layout; ?></h2>

    <div>
        <?php
            echo $form->create(null, array('url' => array('plugin'=>'advertising','controller' => 'advertising', 'action' => 'admin_store_configuration')));
            echo $form->input('total_slots', array('value'=>$slots));
            echo $form->submit('Enviar');
            echo $form->end();
        ?>
   </div>
</div>