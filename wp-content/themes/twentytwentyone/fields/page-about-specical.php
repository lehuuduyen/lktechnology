<?php
add_action('cmb2_init', 'pageAboutSpecical');
function pageAboutSpecical()
{
    $metaBox = new_cmb2_box(array(
        'id' => KEY_ABOUT_SPECICAL . '_box',
        'title' => "Specical",
        'object_types' => POST_TYPE_PAGE,
        'context' => 'normal',
        'priority' => 'default',
        'show_names' => true,
        'show_on' => array('key' => 'id', 'value' => array(getAboutPageId())),
    ));
   
    $metaBoxGroup = $metaBox->add_field(array(
        'id' => KEY_ABOUT_SPECICAL . '_group',
        'type' => 'group',
        'options' => array(
            'group_title' => 'Specical {#}',
            'add_button' => 'ADD',
            'remove_button' => 'REMOVE',
            //Confilct when use repeater in group, fix later
            'sortable' => true,
            'closed' => false,
        ),
    ));
    $metaBox->add_group_field($metaBoxGroup, array(
        'name' => 'Number',
        'id' => KEY_ABOUT_SPECICAL . '_number',
        'type' => 'text',
        'attributes' => array(
            'class' => 'form-control',
            'type' => 'number',
            'pattern' => '\d*',
    

        ),
    ));
    $metaBox->add_group_field($metaBoxGroup, array(
        'name' => 'Title',
        'id' => KEY_ABOUT_SPECICAL . '_title',
        'type' => 'text',
        'attributes' => array(
            'class' => 'form-control',
            'data-cmb2-qtranslate' => true,

        ),
    ));
    
    $metaBox->add_group_field($metaBoxGroup, array(
        'name' => 'Summary',
        'id' => KEY_ABOUT_SPECICAL . '_summary',
        'type' => 'textarea',
        'attributes' => array(
            'class' => 'form-control',
            'data-cmb2-qtranslate' => true,

        ),
    ));
    $metaBox->add_group_field($metaBoxGroup, array(
        'name'    => 'Icon',
        // 'desc'    => 'Upload an image or enter an URL.',
        'id'      => KEY_ABOUT_SPECICAL . '_icon',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
        ),
        // query_args are passed to wp.media's library query.
        'query_args' => array(
            // 'type' => 'application/pdf', // Make library only display PDFs.
            // Or only allow gif, jpg, or png images
            'type' => array(
                'image/gif',
                'image/jpeg',
                'image/png',
            ),
        ),
        'preview_size' => 'large', // Image size to use when previewing in the admin.
    ) );

   
    
}
