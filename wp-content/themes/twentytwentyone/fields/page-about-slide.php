<?php
add_action('cmb2_init', 'pageAboutSlide');
function pageAboutSlide()
{
    $metaBox = new_cmb2_box(array(
        'id' => KEY_ABOUT_SLIDE . '_box',
        'title' => 'Header',
        'object_types' => POST_TYPE_PAGE,
        'context' => 'normal',
        'priority' => 'default',
        'show_names' => true,
        'show_on' => array('key' => 'id', 'value' => array(getAboutPageId())),
    ));
   
    $metaBox->add_field(array(
        'name' => 'Title',
        'id' => KEY_ABOUT_SLIDE . '_title',
        'type' => 'text',
        'attributes' => array(
            'data-cmb2-qtranslate' => true,
            'class' => 'form-control'
        )
    ));
    $metaBox->add_field( array(
        'name' => 'Description short',
        'id' => KEY_ABOUT_SLIDE . '_description_short',
        'type' => 'textarea',
        'attributes' => array(
            'class' => 'form-control ',
            'data-cmb2-qtranslate' => true,

        ),
    ));
    $metaBox->add_field( array(
        'name' => 'Description long',
        'id' => KEY_ABOUT_SLIDE . '_description_long',
        'type' => 'textarea',
        'attributes' => array(
            'class' => 'form-control ',
            'data-cmb2-qtranslate' => true,
        ),
    ));
    $metaBox->add_field( array(
        'name'    => 'Image',
        // 'desc'    => 'Upload an image or enter an URL.',
        'id'      => KEY_ABOUT_SLIDE . '_image',
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
            'type' => 'application/pdf', // Make library only display PDFs.
            // Or only allow gif, jpg, or png images
            // 'type' => array(
            //     'image/gif',
            //     'image/jpeg',
            //     'image/png',
            // ),
        ),
        'preview_size' => 'large', // Image size to use when previewing in the admin.
    ) );
}
?>