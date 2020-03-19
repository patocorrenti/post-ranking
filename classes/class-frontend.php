<?php

if ( !defined( 'ABSPATH' ) ) exit;

class PRanking_Frontend {

    var $Db;

    function PRanking_Frontend ($Db) {
        $this->Db = $Db;
        add_action( 'wp_enqueue_scripts', [$this,'enqueue_scripts']);
        add_filter('the_content', [$this, 'renderReviews']);
    }

    public function enqueue_scripts() {
        wp_enqueue_style( 'form', plugins_url('/../assets/custom/css/form.css', __FILE__));
        wp_enqueue_style( 'review-list', plugins_url('/../assets/custom/css/review-list.css', __FILE__));
        // wp_enqueue_script( 'addmovie', plugins_url('/../assets/custom/js/add-movie.js', __FILE__), array('jquery'));
    }

    function renderReviews ($content) {

        // Validation
        if (!is_single()) {
          return $content;
        }

        // Submit review
        $this->addReview();

        ob_start();
        // Get reviews
        $reviews = $this->Db->getPostReviews();
        if (count($reviews)) {
            $reviewTotals = $this->Db->getPostAverage();
            require( dirname(__FILE__) . '/../templates/frontend/reviews-list.php');
        }

        // Review form
        if (is_user_logged_in() && !$this->Db->userReviewedPost())
            require( dirname(__FILE__) . '/../templates/frontend/form.php');

        return $content .  ob_get_clean();
    }

    function addReview () {
        if (
            isset($_POST['prank-value']) && $_POST['prank-value']
            && isset($_POST['prank-comment'])
            && wp_verify_nonce( wp_unslash($_POST['_wpnonce']), 'prank_review')
        ) {
            $args = [
                'value' => $_POST['prank-value'],
                'comment' => $_POST['prank-comment']
            ];
            $this->Db->addReview($args);
        }
    }

}
