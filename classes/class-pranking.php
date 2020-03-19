<?php

if ( !defined( 'ABSPATH' ) ) exit;

class PRanking {

    var $Db;

    function PRanking () {
        $this->Db = new PRanking_DB();
        new PRanking_Frontend($this->Db);
    }


}
