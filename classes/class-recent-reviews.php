<?php

if ( !defined( 'ABSPATH' ) ) exit;

class PRanking_RecentReviews {
    var $Db;

    function PRanking_RecentReviews ($Db) {
        $this->Db = $Db;

        add_shortcode('post_recent_reviews', [$this,'shortcode_recent_reviews']);
    }

    public function shortcode_recent_reviews ($args=[]) {
        ob_start();
        echo '<pre>';
        print_r($this->Db->getReviews($args));
        echo '</pre>';
        return ob_get_clean();
    }
}
