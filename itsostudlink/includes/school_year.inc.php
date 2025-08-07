<?php

function get_school_year() {
    $current_month = date('n');
    $current_year = date('Y');
    if ($current_month >= 8) {
        return $current_year . '-' . ($current_year + 1);
    } else {
        return ($current_year - 1) . '-' . $current_year;
    }
}
