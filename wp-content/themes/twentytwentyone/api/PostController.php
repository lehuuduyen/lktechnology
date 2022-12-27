<?php
class PostController extends WP_REST_Controller
{
    private $nameSpace = API_NAME . '/v1';
    public function registerRoutes()
    {
        register_rest_route($this->nameSpace, 'top', array(
            array(
                'methods' => 'GET',
                'callback' => array($this, 'getTop')
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

        $menuBar = '';
        $objectMenu->data = new stdClass();

        $objectMenu->data->menuBar = $menuBar;
        $objectMenu->code = 'success';
        // set_transient('menu', $objectMenu, HOUR_IN_SECONDS );

        return $objectMenu;
    }
    public function getTop()
    {
        echo '<pre>';
        print_r(get_post_meta(19,'contact_slide_top_country'));
        die;
        

        // return $objectMenu;
    }

   
}

