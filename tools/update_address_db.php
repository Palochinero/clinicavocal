<?php
require 'wordpress/wp-load.php';
global $wpdb;

echo "--- UPDATING PLASENCIA ADDRESS IN DATABASE ---" . PHP_EOL;

// 1. Update wp_posts post_content for all pages/posts
$pages = $wpdb->get_results("SELECT ID, post_title, post_name, post_content FROM {$wpdb->posts} WHERE post_content LIKE '%Tormantos%'");
foreach ($pages as $p) {
    $orig = $p->post_content;
    $updated = $orig;

    // Replacements
    $updated = str_replace('Calle Sierra de Tormantos, 22', 'Calle Sierra de Tormantos, 16, Local 3', $updated);
    $updated = str_replace('C/ Sierra de Tormantos, 22', 'C/ Sierra de Tormantos, 16, Local 3', $updated);
    $updated = str_replace('Sierra de Tormantos, 22', 'Sierra de Tormantos, 16, Local 3', $updated);
    $updated = str_replace('Sierra+de+Tormantos+22', 'Sierra+de+Tormantos+16', $updated);

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

// 2. Update wp_postmeta
$metas = $wpdb->get_results("SELECT meta_id, post_id, meta_key, meta_value FROM {$wpdb->postmeta} WHERE meta_value LIKE '%Tormantos%'");
foreach ($metas as $m) {
    $orig = $m->meta_value;
    $updated = $orig;
    $updated = str_replace('Calle Sierra de Tormantos, 22', 'Calle Sierra de Tormantos, 16, Local 3', $updated);
    $updated = str_replace('C/ Sierra de Tormantos, 22', 'C/ Sierra de Tormantos, 16, Local 3', $updated);
    $updated = str_replace('Sierra de Tormantos, 22', 'Sierra de Tormantos, 16, Local 3', $updated);
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

// 3. Update wp_options
$options = $wpdb->get_results("SELECT option_id, option_name, option_value FROM {$wpdb->options} WHERE option_value LIKE '%Tormantos%'");
foreach ($options as $o) {
    $orig = $o->option_value;
    $updated = $orig;
    $updated = str_replace('Calle Sierra de Tormantos, 22', 'Calle Sierra de Tormantos, 16, Local 3', $updated);
    $updated = str_replace('C/ Sierra de Tormantos, 22', 'C/ Sierra de Tormantos, 16, Local 3', $updated);
    $updated = str_replace('Sierra de Tormantos, 22', 'Sierra de Tormantos, 16, Local 3', $updated);
    if ($updated !== $orig) {
        $wpdb->update(
            $wpdb->options,
            ['option_value' => $updated],
            ['option_id' => $o->option_id],
            ['%s'],
            ['%d']
        );
        echo "Updated option {$o->option_name}" . PHP_EOL;
    }
}

echo "Database update completed!" . PHP_EOL;
