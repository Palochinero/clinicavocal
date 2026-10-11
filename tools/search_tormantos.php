<?php
require 'wordpress/wp-load.php';
global $wpdb;

echo "=== PUBLISHED PAGES WITH TORMANTOS OR SIERRA ===" . PHP_EOL;
$pages = $wpdb->get_results("SELECT ID, post_title, post_name, post_content FROM {$wpdb->posts} WHERE post_type='page' AND post_status='publish' ORDER BY ID ASC");
foreach ($pages as $p) {
    $c = $p->post_content;
    if (stripos($c, 'Tormantos') !== false) {
        echo "PAGE ID: {$p->ID} | Slug: {$p->post_name}" . PHP_EOL;
        preg_match_all('/.{0,40}Tormantos.{0,50}/i', $c, $m);
        foreach ($m[0] as $match) {
            echo "   " . trim(strip_tags($match)) . PHP_EOL;
        }
    }
}

echo PHP_EOL . "=== ALL PUBLISHED PAGES LIST ===" . PHP_EOL;
foreach ($pages as $p) {
    echo "ID: {$p->ID} | {$p->post_name}" . PHP_EOL;
}
