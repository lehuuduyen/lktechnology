<?php
add_action('cmb2_init', 'pageTopProject');
function pageTopProject()
{
    $metaBox = new_cmb2_box(array(
        'id' => KEY_TOP_PROJECT . '_box',
        'title' => 'Project',
        'object_types' => POST_TYPE_PAGE,
        'context' => 'normal',
        'priority' => 'default',
        'show_names' => true,
        'show_on' => array('key' => 'id', 'value' => array(getTopPageId())),
    ));
    $metaBox->add_field( array(
        'name' => 'Title',
        'id' => KEY_TOP_PROJECT . '_title',
        'type' => 'text',
        'attributes' => array(
            'data-cmb2-qtranslate' => true,
            'class' => 'form-control'
        )
    ));
    $metaBox->add_field(array(
        'name' => 'Attached Posts',
        'id' => KEY_TOP_PROJECT . '_post',
        'desc' => '表示枠は最大８とし、デフォルトは表示枠１のものを表示する。',
        'type' => 'custom_attached_posts',
        'column' => true,
        'options' => array(
            'show_thumbnails' => true,
            'filter_boxes' => true,
            'query_args' => array(
                'posts_per_page' => 10,
                'post_type' => 'post',
                'post_status' => ['publish'],
                'cat' => get_cat_ID("project"),
                'meta_compare' => 'EXISTS',
            ),
        ),
    ));
}
?>