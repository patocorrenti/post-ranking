<?php

if ( !defined( 'ABSPATH' ) ) exit;

class PRanking_RecentReviews {
    var $Db;

    function PRanking_RecentReviews ($Db) {
        $this->Db = $Db;

        add_shortcode('post_recent_reviews', [$this,'shortcode_recent_reviews']);
        add_action( 'wp_enqueue_scripts', [$this,'enqueue_scripts']);
    }

    public function enqueue_scripts() {
        wp_enqueue_style( 'recent-reviews', plugins_url('/../assets/custom/css/recent-reviews.css', __FILE__));
    }

    public function shortcode_recent_reviews ($args=[]) {
        $recentReviews = $this->Db->getReviews($args);
        ob_start();
        require( dirname(__FILE__) . '/../templates/frontend/recent-reviews.php');
        return ob_get_clean();
    }
}
