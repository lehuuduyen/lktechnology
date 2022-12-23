<?php
add_action('cmb2_init', 'pageTopInformation');
function pageTopInformation()
{
    $metaBox = new_cmb2_box(array(
        'id' => KEY_TOP_INFORMATION . '_box',
        'title' => 'Information',
        'object_types' => POST_TYPE_PAGE,
        'context' => 'normal',
        'priority' => 'default',
        'show_names' => true,
        'show_on' => array('key' => 'id', 'value' => array(getTopPageId())),
    ));
   
    $metaBox->add_field(array(
        'name' => 'Title',
        'id' => KEY_TOP_INFORMATION . '_title',
        'type' => 'text',
        'attributes' => array(
            'class' => 'form-control'
        )
    ));
    $metaBox->add_field(array(
        'name' => 'Slug',
        'id' => KEY_TOP_INFORMATION . '_slug',
        'type' => 'text',
        'attributes' => array(
            'class' => 'form-control'
        )
    ));
    $metaBox->add_field(array(
        'name' => 'Short description',
        'id' => KEY_TOP_INFORMATION . '_short_description',
        'type' => 'textarea',
        'attributes' => array(
            'class' => 'form-control'
        )
    ));
}
?>