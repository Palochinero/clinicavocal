<?php
require 'wordpress/wp-load.php';
global $wpdb;

echo "--- UPDATING PLASENCIA ADDRESS TO CALLE SIERRA DE TORMANTOS 22 ---" . PHP_EOL;

function replace_tormantos_16($text) {
    $replacements = [
        'Calle Sierra de Tormantos, 16, Local 3' => 'Calle Sierra de Tormantos, 22',
        'C/ Sierra de Tormantos, 16, Local 3'    => 'C/ Sierra de Tormantos, 22',
        'Sierra de Tormantos, 16, Local 3'       => 'Sierra de Tormantos, 22',
        'Calle Sierra de Tormantos, Nº 16, Local 3' => 'Calle Sierra de Tormantos, 22',
        'Sierra de Tormantos, Nº 16, Local 3'    => 'Sierra de Tormantos, 22',
        'Calle Sierra de Tormantos, 16'          => 'Calle Sierra de Tormantos, 22',
        'C/ Sierra de Tormantos, 16'             => 'C/ Sierra de Tormantos, 22',
        'Sierra de Tormantos, 16'                => 'Sierra de Tormantos, 22',
        'Sierra+de+Tormantos+16'                 => 'Sierra+de+Tormantos+22',
        'Sierra%20de%20Tormantos%2C%2016'        => 'Sierra%20de%20Tormantos%2C%2022',
        'Sierra%20de%20Tormantos%2016'           => 'Sierra%20de%20Tormantos%2022',
        'Sierra%2Bde%2BTormantos%2B16'           => 'Sierra%2Bde%2BTormantos%2B22',
    ];
    return str_replace(array_keys($replacements), array_values($replacements), $text);
}

// 1. wp_posts
$posts = $wpdb->get_results("SELECT ID, post_title, post_name, post_content FROM {$wpdb->posts} WHERE post_content LIKE '%Tormantos%'");
echo "Found " . count($posts) . " posts with Tormantos." . PHP_EOL;
foreach ($posts as $p) {
    $orig = $p->post_content;
    $updated = replace_tormantos_16($orig);
    if ($updated !== $orig) {
        $wpdb->update(
            $wpdb->posts,
            ['post_content' => $updated],
            ['ID' => $p->ID],
            ['%s'],
            ['%d']
        );
        clean_post_cache($p->ID);
        echo "Updated post ID {$p->ID} ({$p->post_name})" . PHP_EOL;
    }
}

// 2. wp_postmeta
$metas = $wpdb->get_results("SELECT meta_id, post_id, meta_key, meta_value FROM {$wpdb->postmeta} WHERE meta_value LIKE '%Tormantos%'");
echo "Found " . count($metas) . " postmeta with Tormantos." . PHP_EOL;
foreach ($metas as $m) {
    $orig = $m->meta_value;
    $updated = replace_tormantos_16($orig);
    if ($updated !== $orig) {
        $wpdb->update(
            $wpdb->postmeta,
            ['meta_value' => $updated],
            ['meta_id' => $m->meta_id],
            ['%s'],
            ['%d']
        );
        echo "Updated postmeta ID {$m->meta_id} for post {$m->post_id} ({$m->meta_key})" . PHP_EOL;
    }
}

// 3. wp_options
$options = $wpdb->get_results("SELECT option_id, option_name, option_value FROM {$wpdb->options} WHERE option_value LIKE '%Tormantos%'");
echo "Found " . count($options) . " options with Tormantos." . PHP_EOL;
foreach ($options as $o) {
    $orig = $o->option_value;
    $updated = replace_tormantos_16($orig);
    if ($updated !== $orig) {
        $wpdb->update(
            $wpdb->options,
            ['option_value' => $updated],
            ['option_id' => $o->option_id],
            ['%s'],
            ['%d']
        );
        echo "Updated option ID {$o->option_id} ({$o->option_name})" . PHP_EOL;
    }
}

echo "--- DATABASE UPDATE COMPLETED ---" . PHP_EOL;
