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
        // $topPage = get_post_meta(getTopPageId());



        // $data = [];
        // if (isset($topPage['banner_slide_top_post'])) {
        //     $slideTops = [];
        //     $tempSlideTop = [];
        //     $listSlideTop = unserialize($topPage['banner_slide_top_post'][0]);
        //     $listSlideTop = array_slice($listSlideTop, 0, 10);
        //     $listSlideTops = get_posts([
        //         'include' => $listSlideTop,
        //         'order' => 'ASC',
        //         'orderby' => 'post__in'
        //     ]);
        //     foreach ($listSlideTops as $key => $val) {
        //         if (isset($val->ID)) {
        //             $tempSlideTop[$val->ID] = $val;
        //         }
        //     }


        //     foreach ($listSlideTop as $val) {
        //         if (isset($tempSlideTop[$val])) {
        //             $slideTops[] = $tempSlideTop[$val];
        //         }
        //     }
        //     foreach ($slideTops as $keySlideTop => $post) {
        //         $image_pc = has_post_thumbnail($post->ID) ? get_the_post_thumbnail_url($post->ID) : '';
        //         $tempArr = [
        //             'image' => $image_pc,
        //             'title' => $post->post_title,
        //             'slug' => $post->post_name,
        //         ];

        //         $data[] = $tempArr;
        //     }
        // }
        // $results['banner'] = $data;


        // $data = [];
        // $data['title'] = isset($topPage['service_slide_top_title']) ? $topPage['service_slide_top_title'][0] : "";
        // if (isset($topPage['service_slide_top_post'])) {
        //     $slideTops = [];
        //     $tempSlideTop = [];
        //     $listSlideTop = unserialize($topPage['service_slide_top_post'][0]);
        //     $listSlideTop = array_slice($listSlideTop, 0, 10);
        //     $listSlideTops = get_posts([
        //         'include' => $listSlideTop,
        //         'order' => 'ASC',
        //         'orderby' => 'post__in'
        //     ]);
        //     foreach ($listSlideTops as $key => $val) {
        //         if (isset($val->ID)) {
        //             $tempSlideTop[$val->ID] = $val;
        //         }
        //     }


        //     foreach ($listSlideTop as $val) {
        //         if (isset($tempSlideTop[$val])) {
        //             $slideTops[] = $tempSlideTop[$val];
        //         }
        //     }
        //     foreach ($slideTops as $keySlideTop => $post) {
        //         $image_pc = has_post_thumbnail($post->ID) ? get_the_post_thumbnail_url($post->ID) : '';
        //         $tempArr = [
        //             'image' => $image_pc,
        //             'title' => $post->post_title,
        //             'slug' => $post->post_name,
        //         ];

        //         $data['list'][] = $tempArr;
        //     }
        // }
        // $results['service'] = $data;

        // $data = [];
        // $data['title'] = isset($topPage['information_slide_top_title']) ? $topPage['information_slide_top_title'][0] : "";
        // $data['slug'] = isset($topPage['information_slide_top_slug']) ? $topPage['information_slide_top_slug'][0] : "";
        // $data['short_description'] = isset($topPage['information_slide_top_short_description']) ? $topPage['information_slide_top_short_description'][0] : "";
        // $data['image'] = isset($topPage['information_slide_top_image']) ? $topPage['information_slide_top_image'][0] : "";
        // $results['information'] = $data;



        // $data = [];
        // $data['title'] = isset($topPage['project_slide_top_title']) ? $topPage['project_slide_top_title'][0] : "";
        // if (isset($topPage['project_slide_top_post'])) {
        //     $slideTops = [];
        //     $tempSlideTop = [];
        //     $listSlideTop = unserialize($topPage['project_slide_top_post'][0]);
        //     $listSlideTop = array_slice($listSlideTop, 0, 10);
        //     $listSlideTops = get_posts([
        //         'include' => $listSlideTop,
        //         'order' => 'ASC',
        //         'orderby' => 'post__in'
        //     ]);
        //     foreach ($listSlideTops as $key => $val) {
        //         if (isset($val->ID)) {
        //             $tempSlideTop[$val->ID] = $val;
        //         }
        //     }


        //     foreach ($listSlideTop as $val) {
        //         if (isset($tempSlideTop[$val])) {
        //             $slideTops[] = $tempSlideTop[$val];
        //         }
        //     }
        //     foreach ($slideTops as $keySlideTop => $post) {
        //         $image_pc = has_post_thumbnail($post->ID) ? get_the_post_thumbnail_url($post->ID) : '';
        //         $tempArr = [
        //             'image' => $image_pc,
        //             'title' => $post->post_title,
        //             'slug' => $post->post_name,
        //         ];

        //         $data['list'][] = $tempArr;
        //     }
        // }
        // $results['project'] = $data;


        $data = [];
        echo '<pre>';
        // $meta = qtrans_useCurrentLanguageIfNotFoundShowAvailable(get_post_meta( getTopPageId(), 'partner_slide_title', true));
        echo '<pre>';
        print_r(qtranxf_useCurrentLanguageIfNotFoundShowAvailable(
            get_post_meta( getTopPageId(), 'partner_slide_title', true ) ) );
        die;
        
        die;
        
        
        $data['title'] = isset($topPage['partner_slide_title']) ? $topPage['partner_slide_title'][0] : "";

        if (isset($topPage['partner_slide_list'])) {
            $listSlidePartner = unserialize($topPage['partner_slide_list'][0]);
            $data['list'] = array_slice($listSlidePartner, 0);
        }
        $results['partner'] = $data;


        $data = [];
        if (isset($topPage['socical_network_slide_top_group'])) {
            $slideTops = [];
            $tempSlideTop = [];
            $listSlideTop = unserialize($topPage['socical_network_slide_top_group'][0]);
            
            
         
            foreach ($listSlideTop as $keySlideTop => $post) {
                $tempArr = [
                    'class_icon' => $post['socical_network_slide_top_icon'],
                    'slug' => $post['socical_network_slide_top_link'],
                ];

                $data[] = $tempArr;
            }
        }
        $results['socical_network'] = $data;

        return new WP_REST_Response(['code' => 'success', 'data' => $results], 200);
    }
}

add_action('rest_api_init', function () {
    $shareController = new PostController();
    $shareController->registerRoutes();
});
