<?php

if ( !defined( 'ABSPATH' ) ) exit;

class PRanking_DB {

    var $wpdb;
    var $tables = array();

    function PRanking_DB () {
        // Get global object to work with DB
        $this->wpdb = $GLOBALS['wpdb'];
        // Table names
        $this->tables['reviews'] = $this->wpdb->prefix . 'post_reviews';
    }

    public function createTables () {
        // Reviews
        $sql = sprintf(
            'CREATE TABLE %s (
                id INT NOT NULL AUTO_INCREMENT
                , post_id BIGINT(20) NOT NULL
                , review_date DATETIME DEFAULT CURRENT_TIMESTAMP
                , user_id BIGINT(20) NOT NULL
                , value INT(10) NOT NULL
                , comment TEXT NOT NULL
                , PRIMARY KEY (id) )
            ;',
            $this->tables['reviews']
        );
        $this->wpdb->query($sql);
    }

    function addReview($args){
        if (!is_user_logged_in() || $this->userReviewedPost()) {
            return false;
        }

        $values = [
            'post_id' => get_the_ID(),
            'user_id' => get_current_user_id(),
            'value' => $args['value'],
            'comment' => $args['comment']
        ];
        $this->wpdb->insert(
            $this->tables['reviews'],
            $values,
            [ '%d', '%d', '%d', '%s' ]
        );
    }

    function getPostReviews ($postId = false) {
        if (!$postId) $postId = get_the_ID();

        $sql = sprintf(
            "SELECT r.review_date, r.value, r.comment, u.display_name name
            FROM %s r
            LEFT JOIN %s u ON u.ID = r.user_id
            WHERE r.post_id = %d
            ORDER BY r.review_date DESC",
            $this->tables['reviews'], $this->wpdb->prefix.'users', $postId
        );
        return $this->wpdb->get_results($sql);
    }

    function getPostAverage ($postId = false) {
        if (!$postId) $postId = get_the_ID();
        $sql = sprintf(
            'SELECT AVG(value) average, COUNT(value) users FROM %s WHERE post_id = %d',
            $this->tables['reviews'], $postId
        );
        $results = $this->wpdb->get_results($sql)[0];
        return [
            'average' => PRanking_Helper::roundAverage($results->average),
            'users' => $results->users
        ];
    }

    // Check if the current user has already reviewed the current post
    function userReviewedPost () {
        $sql = sprintf (
            "SELECT COUNT(id) FROM %s WHERE post_id = %d AND user_id = %d",
            $this->tables['reviews'], get_the_ID(), get_current_user_id()
        );
        return $this->wpdb->get_var($sql);
    }

    function getReviews ($args = []) {
        // Process args
        $sqlArgs = [
            'limit' => !empty($args['limit']) ? 'LIMIT ' . (int)$args['limit'] : '',
            'post_type' => !empty($args['post_type']) ? sprintf('WHERE p.post_type = "%s"', $args['post_type']) : '',
        ];

        $postsTable = $this->wpdb->prefix . 'posts';
        $usersTable = $this->wpdb->prefix . 'users';
        $sql = sprintf (
            '
            SELECT r.value, r.comment, u.display_name name, r.post_id, p.post_title, p.guid permalink
            FROM %s AS r
            LEFT JOIN %s AS p ON r.post_id = p.ID
            LEFT JOIN %s AS u ON r.user_id = u.ID
            %s
            ORDER BY review_date DESC
            %s
            ',
            $this->tables['reviews'], $postsTable, $usersTable, //tables
            $sqlArgs['post_type'],$sqlArgs['limit'] //args
        );

        return $this->wpdb->get_results($sql);
    }

}
