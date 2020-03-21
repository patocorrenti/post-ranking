<?php

if ( !defined( 'ABSPATH' ) ) exit;

class PRanking_Helper {

    static function getAverage ($postId) {
        $Db = new PRanking_DB();
        return self::roundAverage($Db->getPostAverage($postId)['average']);
    }

    // Receives the average as string and returns it as 2 decimals float
    static function roundAverage($value) {
        return round(floatval($value),2);
    }

}
