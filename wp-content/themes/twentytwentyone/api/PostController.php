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
        register_rest_route($this->nameSpace, 'posts-category/(?P<slug>[a-zA-Z0-9-_]+)', array(
            array(
                'methods' => 'GET',
                'callback' => array($this, 'getCategory')
            ),
        ));
    }
    public function getCategory($request){

        $results = [];
        //Category, image, icon and description
        $category = get_category_by_slug($request['slug']);
        // if (empty($category)) {
        //     return new WP_Error('no_posts', __('No post found'), array('status' => 404));
        // } else {
        //     $results['category'] = $this->simpleCategory($category);
        // }
        
        
        $queryParams = $request->get_query_params();
        //Pagination param
        $page = 1;
        $postPerPage = (int)get_option('posts_per_page');
        if (isset($queryParams['page']) && $queryParams['page'] > 1) {
            $page = (int)$queryParams['page'];
        }
        //Get Post of category
        $args = array(
            'post_type' => POST_TYPE,
            'post_status' => array('publish'),
            'order' => 'DESC',
            'category_name' => $request['slug'],
            'posts_per_page' => $postPerPage,
            'paged' => $page,
        );
        
     
        //Get data for glossary
        $posts = new WP_Query($args);
        if ($posts->have_posts()) {
            
            $results['code'] = 'success';
            $key = 0;
            // Set default data null
            while ($posts->have_posts()) {
                $posts->the_post();
                $meta = get_post_meta(get_the_ID());
                //Get author
                $author = [
                    'title' => '',
                    'slug' => '',
                    'avatar' => '',
                ];
                
                $getTitle =  get_the_title();
                //Get content without caption
                $results['data'][$key] = [
                    'title' => $getTitle,
                    'slug' => get_post_field('post_name', get_the_ID()),
                    'content' => getExcerpt(get_the_excerpt(), EXCERPT_LENGTH),
                    'image' => has_post_thumbnail() ? get_the_post_thumbnail_url() : '',
                    'date' => get_the_date('Y/m/d')
                ];
               
                $key++;
            }
            //Pagination data
            $results['pagination'] = [
                'current_page' => $page,
                'total' => (int)$posts->found_posts,
                'post_per_page' => $postPerPage,
            ];
            wp_reset_postdata();
        }

       

        return new WP_REST_Response($results, 200);
    }
    public function getTop()
    {
        $language = getLanguageId(qtranxf_getLanguage());
        $topPage = get_post_meta(getTopPageId());
        $data = [];
        if (isset($topPage['banner_slide_top_post'])) {
            $slideTops = [];
            $tempSlideTop = [];
            $listSlideTop = unserialize($topPage['banner_slide_top_post'][0]);
            $listSlideTop = array_slice($listSlideTop, 0, 10);
            $listSlideTops = get_posts([
                'include' => $listSlideTop,
                'order' => 'ASC',
                'orderby' => 'post__in'
            ]);
            foreach ($listSlideTops as $key => $val) {
                if (isset($val->ID)) {
                    $tempSlideTop[$val->ID] = $val;
                }
            }


            foreach ($listSlideTop as $val) {
                if (isset($tempSlideTop[$val])) {
                    $slideTops[] = $tempSlideTop[$val];
                }
            }
            foreach ($slideTops as $keySlideTop => $post) {
                $image_pc = has_post_thumbnail($post->ID) ? get_the_post_thumbnail_url($post->ID) : '';
                $tempArr = [
                    'image' => $image_pc,
                    'title' => qtranxf_use($language,$post->post_title,true,true ),
                    'slug' => $post->post_name,
                ];

                $data[] = $tempArr;
            }
        }
        $results['banner'] = $data;


        $data = [];
        $data['title'] = isset($topPage['service_slide_top_title']) ?  qtranxf_use($language,$topPage['service_slide_top_title'][0],true,true ) : "";

        if (isset($topPage['service_slide_top_post'])) {
            $slideTops = [];
            $tempSlideTop = [];
            $listSlideTop = unserialize($topPage['service_slide_top_post'][0]);
            $listSlideTop = array_slice($listSlideTop, 0, 10);
            $listSlideTops = get_posts([
                'include' => $listSlideTop,
                'order' => 'ASC',
                'orderby' => 'post__in'
            ]);
            foreach ($listSlideTops as $key => $val) {
                if (isset($val->ID)) {
                    $tempSlideTop[$val->ID] = $val;
                }
            }


            foreach ($listSlideTop as $val) {
                if (isset($tempSlideTop[$val])) {
                    $slideTops[] = $tempSlideTop[$val];
                }
            }
            foreach ($slideTops as $keySlideTop => $post) {
                $summary = qtranxf_use($language,get_post_meta($post->ID,'post_summary',true),true,true );
                $image_pc = has_post_thumbnail($post->ID) ? get_the_post_thumbnail_url($post->ID) : '';
                $tempArr = [
                    'image' => $image_pc,
                    'title' => qtranxf_use($language,$post->post_title,true,true ),
                    'summary' =>$summary,
                    'slug' => $post->post_name,
                ];

                $data['list'][] = $tempArr;
            }
        }
        $results['service'] = $data;

        $data = [];
     
        
        $data['title'] = isset($topPage['information_slide_top_title']) ?  qtranxf_use($language,$topPage['information_slide_top_title'][0],true,true ) : "";
        $data['slug'] = isset($topPage['information_slide_top_slug']) ? $topPage['information_slide_top_slug'][0] : "";
        $data['short_description'] = isset($topPage['information_slide_top_short_description']) ?  qtranxf_use($language,$topPage['information_slide_top_short_description'][0],true,true ) : "";
        $data['image'] = isset($topPage['information_slide_top_image']) ? $topPage['information_slide_top_image'][0] : "";
        $results['information'] = $data;



        $data = [];
        $data['title'] = isset($topPage['project_slide_top_title']) ?  qtranxf_use($language,$topPage['project_slide_top_title'][0],true,true ) : "";

        if (isset($topPage['project_slide_top_post'])) {
            $slideTops = [];
            $tempSlideTop = [];
            $listSlideTop = unserialize($topPage['project_slide_top_post'][0]);
            $listSlideTop = array_slice($listSlideTop, 0, 10);
            $listSlideTops = get_posts([
                'include' => $listSlideTop,
                'order' => 'ASC',
                'orderby' => 'post__in'
            ]);
            foreach ($listSlideTops as $key => $val) {
                if (isset($val->ID)) {
                    $tempSlideTop[$val->ID] = $val;
                }
            }


            foreach ($listSlideTop as $val) {
                if (isset($tempSlideTop[$val])) {
                    $slideTops[] = $tempSlideTop[$val];
                }
            }
            foreach ($slideTops as $keySlideTop => $post) {
                $summary = qtranxf_use($language,get_post_meta($post->ID,'post_summary',true),true,true );
                $image_pc = has_post_thumbnail($post->ID) ? get_the_post_thumbnail_url($post->ID) : '';
                $tempArr = [
                    'image' => $image_pc,
                    'title' => qtranxf_use($language,$post->post_title,true,true ),
                    'summary' =>$summary,
                    'slug' => $post->post_name,
                ];

                $data['list'][] = $tempArr;
            }
        }
        $results['project'] = $data;


        $data = [];
       
        
        $data['title'] = isset($topPage['partner_slide_title']) ?  qtranxf_use($language,$topPage['partner_slide_title'][0],true,true ) : "";

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
