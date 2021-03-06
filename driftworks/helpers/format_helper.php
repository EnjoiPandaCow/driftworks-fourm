<?php

/*
 * URL Format
 */

function urlFormat($str) {
    //Strip out all whitespace
    $str = preg_replace('/\s*/', '', $str);
    //Convert the string to all lowercase
    $str = strtolower($str);
    //URL Encode
    $str = urlencode($str);
    return $str;
}

/*
 * Date Format
 */
function formatDate($date) {
    $date = date("F j, Y, g:i a", strtotime($date));
    return $date;
}

/*
 * Displaying Active Category
 */
function is_active($category) {
    if(isset($_GET['category'])) {
        if($_GET['category'] == $category) {
            return 'active';
        } else {
            return '';
        }
    } else {
        if($category == null) {
            return 'active';
        }
    }
}

