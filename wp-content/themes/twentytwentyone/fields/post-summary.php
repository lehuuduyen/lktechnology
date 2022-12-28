<?php
add_action('cmb2_init', 'postSummary');
function postSummary() 
{
    $metaBox = new_cmb2_box([
        'id' => KEY_SUMMARY . '_box',
        'title' => 'Summary',
        'object_types' => POST_TYPE,
        'context' => 'normal',
        'priority' => 'default',
        'show_names' => false,
        
    ]);
    $metaBox->add_field([
        'name' => 'Summary',
        'id' => KEY_SUMMARY ,
        'type' => 'textarea',
        'attributes' => array(
            'class' => 'form-control'
        ),
    ]);
  
}

