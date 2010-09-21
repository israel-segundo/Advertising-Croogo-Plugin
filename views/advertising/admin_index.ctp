<div class="example index">
    <h2><?php echo $title_for_layout; ?></h2>

    <div class="actions">
        <ul>
            <li>
                <?php
                    echo $html->link('New Ad',
                            array( 'plugin' => 'advertising', 'controller' => 'advertising', 'action' => 'admin_new_ad' ) );
                    echo $html->link('Plugin Configuration',
                            array( 'plugin' => 'advertising', 'controller' => 'advertising', 'action' => 'admin_configuration' ) );
                ?>
            </li>
        </ul>
    </div>


    <table cellpadding="0" cellspacing="0" class="ui-corner-all">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Active</th>
                <th>Slot</th>
                <th>Expiration</th>
                <th>Clicks</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php $fields = array('id', 'name', 'slot', 'expiration', 'clicks'); ?>
            <?php foreach( $ads as $ad): ?>

                <tr>

                    <td>
                        <?php echo $ad['Ad']['id'];?>
                    </td>
                    <td>
                        <?php echo $ad['Ad']['name'];?>
                    </td>

                    <td>
                        <?php if( $ad['Ad']['active'] ){
                            echo $html->image('icons/tick.png');
                        }else{
                            echo $html->image('icons/cross.png');
                        }
                        ?>
                    </td>

                    <td>
                        <?php echo $ad['Ad']['slot'];?>
                    </td>

                    <td>
                        <?php echo $ad['Ad']['expiration'];?>
                    </td>
                    <td>
                        <?php echo $ad['Ad']['clicks'];?>
                    </td>
                    <td>
                        <?php
                            echo $html->link(__('Update',true), array( 'plugin' => 'advertising', 'controller' => 'advertising', 'action' => 'admin_edit_ad', $ad['Ad']['id'] ) );
                            echo $html->link( __('Delete', true),
                                            array( 'plugin' => 'advertising', 'controller' => 'advertising', 'action' => 'admin_delete_ad', $ad['Ad']['id'] ),
                                            null, __('Are you sure?',true));
                        ?>
                    </td>
                </tr>

            <?php endforeach;?>
        </tbody>

        <tfoot>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Active</th>
                <th>Slot</th>
                <th>Expiration</th>
                <th>Clicks</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</div>