<?php

if ( !defined( 'ABSPATH' ) ) exit;

class PRanking_List {

    var $Db;

    function PRanking_List ($Db) {
        $this->Db = $Db;

        add_action( 'wp_enqueue_scripts', [$this,'enqueue_scripts']);
        add_shortcode('post_ranking_list', [$this,'shortcode_list']);
    }

    public function enqueue_scripts() {
        wp_enqueue_style( 'list', plugins_url('/../assets/custom/css/list.css', __FILE__));
    }

    public function shortcode_list ($args=[]) {
        // Query the post
        $rankingQuery = new WP_Query([
            'post_type' => !empty($args['post_type']) ? [$args ['post_type']] : ['post'],
            'posts_per_page' => !empty($args['per_page']) ? (int)$args['per_page'] : get_option('posts_per_page'),
            'paged' => !empty(get_query_var('paged')) ? (int)get_query_var('paged') : 1
        ]);

        ob_start();
        require( dirname(__FILE__) . '/../templates/frontend/list.php');
        return ob_get_clean();
    }
}
