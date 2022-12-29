<?php
class MenuController extends WP_REST_Controller
{
    private $nameSpace = API_NAME . '/v1';
    public function registerRoutes()
    {
        register_rest_route($this->nameSpace, 'menu', array(
            array(
                'methods' => 'GET',
                'callback' => array($this, 'getMenu')
            ),
        ));
    }
    /**
     * @param $request
     * @return WP_REST_Response
     */
    public function getMenu($request)
    {
        // if(get_transient ('menu' )){
        //   return get_transient ('menu' );
        // }
        $objectMenu = new stdClass();

        $menuBar = $this->wp_get_menu_array('menuBar');
        $objectMenu->data = new stdClass();

        $objectMenu->data->menuBar = $menuBar;
        $objectMenu->code = 'success';
        // set_transient('menu', $objectMenu, HOUR_IN_SECONDS );

        return $objectMenu;
    }

    function wp_get_menu_array($current_menu)
    {
        $array_menu = wp_get_nav_menu_items($current_menu);
        $menu = array();
        $count = 0;
        if (is_array($array_menu)) {
            foreach ($array_menu as $m) {
                $getPostField =  get_post_field('post_name', $m->object_id);
                $getTermBy = get_term_by('id', $m->object_id, $m->object) ? get_term_by('id', $m->object_id, $m->object)->slug : $m->url;
                $categorySlug = $m->object === 'page' ? $getPostField : $getTermBy;
                $object = new stdClass();
                $object->id = $count++;
                $object->menuName = $m->title;
                $object->type = $m->object;
                $object->slug = $categorySlug;
                $object->menu_item_parent = $m->menu_item_parent;
                $object->ID = $m->ID;
                $menu[] = $object;
            }
        }
    
        $build_tree = $this->recursive_mitems_to_array( $menu );

        return $build_tree;
    }
    function recursive_mitems_to_array( $items, $parent = 0 )
    {
        $bundle = [];
        foreach ( $items as $item ) {
            if ( $item->menu_item_parent == $parent ) {
                $child               = $this->recursive_mitems_to_array( $items, $item->ID );
              
       
                
                $item->menu_item_child = $child;
                $bundle[ ] = $item;
            }
        }

        return $bundle;
    }
}

/**
 * Call hook register rest api
 */
add_action('rest_api_init', function () {
    $menuController = new MenuController();
    $menuController->registerRoutes();
});
