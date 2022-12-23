<?php
add_action('cmb2_init', 'pageTopNews');
function pageTopNews()
{
    $metaBox = new_cmb2_box(array(
        'id' => KEY_TOP_NEWS . '_box',
        'title' => 'News',
        'object_types' => POST_TYPE_PAGE,
        'context' => 'normal',
        'priority' => 'default',
        'show_names' => true,
        'show_on' => array('key' => 'id', 'value' => array(getTopPageId())),
    ));
   
    $metaBox->add_field(array(
        'name' => 'Attached Posts',
        'id' => KEY_TOP_NEWS . '_post',
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
                'cat' => get_cat_ID("news"),
                'meta_compare' => 'EXISTS',
            ),
        ),
    ));
}
?>