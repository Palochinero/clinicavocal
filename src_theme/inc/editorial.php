<?php
defined('ABSPATH') || exit;
function cv_topics() {
    return ['voz'=>['Voz y comunicación','Para cuidar tu voz dentro y fuera del trabajo.'],'lenguaje'=>['Lenguaje e infancia','Para acompañar las primeras palabras y el aprendizaje.'],'bienestar'=>['Bienestar emocional','Para comprender lo que sientes en el día a día.'],'primera-consulta'=>['Dar el primer paso','Para llegar a consulta con menos dudas.']];
}
function cv_reading_time($id) {
    $text = wp_strip_all_tags(get_post_field('post_content',$id));
    return max(1,(int)ceil(count(preg_split('/\s+/u', trim($text)))/200));
}
function cv_post_card($id) {
    $topics = wp_get_post_categories($id,['fields'=>'names']);
    $art = cv_meta('art',$id) ?: 'ilustracion-05-crecimiento-espacio.webp';
    echo '<article class="cv-post-card"><a class="cv-post-image" href="'.esc_url(get_permalink($id)).'" tabindex="-1" aria-hidden="true"><img src="'.esc_url(cv_asset($art)).'" alt="" width="800" height="800" loading="lazy" decoding="async"></a><div class="cv-post-copy"><p class="cv-eyebrow">'.esc_html(implode(' · ',$topics)).'</p><h3><a href="'.esc_url(get_permalink($id)).'">'.esc_html(get_the_title($id)).'</a></h3><div class="cv-article-meta"><span>'.cv_reading_time($id).' min de lectura</span></div><p>'.esc_html(get_the_excerpt($id)).'</p><a class="cv-link" href="'.esc_url(get_permalink($id)).'" aria-label="'.esc_attr('Leer: '.get_the_title($id)).'">Leer artículo <span aria-hidden="true">↗</span></a></div></article>';
}
add_shortcode('cv_blog', function () {
    $topics=cv_topics();
    $topic=isset($_GET['tema']) && is_string($_GET['tema']) ? sanitize_key(wp_unslash($_GET['tema'])) : '';
    if (!isset($topics[$topic])) $topic='';
    $search=isset($_GET['buscar']) && is_string($_GET['buscar']) ? sanitize_text_field(wp_unslash($_GET['buscar'])) : '';
    $page=isset($_GET['pagina']) && is_scalar($_GET['pagina']) ? max(1,absint($_GET['pagina'])) : 1;
    $args=['post_type'=>'post','post_status'=>'publish','posts_per_page'=>6,'paged'=>$page,'orderby'=>['date'=>'DESC','ID'=>'ASC']];
    if ($topic) $args['category_name']=$topic;
    if ($search) $args['s']=$search;
    $query=new WP_Query($args);
    ob_start();
    echo '<div class="cv-blog-toolbar"><h2>¿Qué te gustaría entender mejor?</h2><nav class="cv-topic-grid" aria-label="Temas del cuaderno">';
    foreach ($topics as $slug=>[$name,$desc]) echo '<a class="cv-topic" '.($slug===$topic ? 'aria-current="page" ' : '').'href="'.esc_url(add_query_arg('tema',$slug,home_url('/blog/'))).'#lecturas"><strong>'.esc_html($name).'</strong><span>'.esc_html($desc).'</span></a>';
    echo '</nav><form class="cv-blog-search" method="get" action="'.esc_url(home_url('/blog/#lecturas')).'"><label for="cv-search">Busca una lectura<input type="search" id="cv-search" name="buscar" value="'.esc_attr($search).'" placeholder="Por ejemplo: voz, lenguaje, primera cita" maxlength="100"></label>';
    if($topic) echo '<input type="hidden" name="tema" value="'.esc_attr($topic).'">';
    echo '<button class="cv-button" type="submit">Buscar ↗</button>';
    if($topic || $search) echo '<a class="cv-link" href="'.esc_url(home_url('/blog/#lecturas')).'">Ver todos los artículos</a>';
    echo '</form></div>';
    if(!$topic && !$search && $page===1) {
        $featured=get_posts(['post_type'=>'post','numberposts'=>1,'meta_key'=>'_cv_featured','meta_value'=>'1']);
        if($featured) { $id=$featured[0]->ID;
            echo '<article class="cv-blog-featured"><a class="cv-featured-art" href="'.esc_url(get_permalink($id)).'" aria-hidden="true" tabindex="-1"><img src="'.esc_url(cv_asset(cv_meta('art',$id))).'" alt="" width="800" height="800" loading="lazy"></a><div class="cv-featured-copy"><p class="cv-eyebrow">Una lectura para empezar · Voz y comunicación</p><h2><a href="'.esc_url(get_permalink($id)).'">'.esc_html(get_the_title($id)).'</a></h2><p>'.esc_html(get_the_excerpt($id)).'</p><div class="cv-article-meta"><span>'.cv_reading_time($id).' min de lectura</span><span>Cuaderno Vocal</span></div><a class="cv-link" href="'.esc_url(get_permalink($id)).'">Leer la guía completa ↗</a></div></article>';
        }
    }
    echo '<section id="lecturas"><div class="cv-results-heading"><h2>'.esc_html($search ? 'Resultados de tu búsqueda' : ($topic ? $topics[$topic][0] : 'Todas las lecturas')).'</h2><span>'.(int)$query->found_posts.($query->found_posts===1 ? ' artículo' : ' artículos').'</span></div>';
    if($query->have_posts()) { echo '<div class="cv-article-grid">'; foreach($query->posts as $post) cv_post_card($post->ID); echo '</div>'; }
    else echo '<div class="cv-empty"><h3>No encontramos esa lectura.</h3><p>Prueba con una palabra más breve o explora todos los temas del cuaderno.</p><a class="cv-link" href="'.esc_url(home_url('/blog/')).'">Volver a todas las lecturas ↗</a></div>';
    if($query->max_num_pages>1) {
        echo '<nav class="cv-pagination" aria-label="Páginas del blog">';
        for($i=1;$i<=$query->max_num_pages;$i++) { $url=add_query_arg(array_filter(['tema'=>$topic,'buscar'=>$search,'pagina'=>$i]),home_url('/blog/')); echo $i===$page ? '<span class="current" aria-current="page">'.$i.'</span>' : '<a href="'.esc_url($url).'#lecturas" aria-label="Página '.$i.'">'.$i.'</a>'; }
        echo '</nav>';
    }
    echo '</section>';
    wp_reset_postdata(); return ob_get_clean();
});
add_shortcode('cv_latest', function () {
    $posts=get_posts(['post_type'=>'post','numberposts'=>3,'orderby'=>['date'=>'DESC','ID'=>'ASC']]);
    ob_start(); echo '<div class="cv-article-grid">'; foreach($posts as $p) cv_post_card($p->ID); echo '</div>'; return ob_get_clean();
});
add_action('add_meta_boxes', function () {
    add_meta_box('cv-editorial','Clínica Vocal · Presentación y SEO',function($post) {
        wp_nonce_field('cv_save_editorial','cv_editorial_nonce');
        foreach(['seo_title'=>'Título para buscadores','description'=>'Descripción para buscadores','heading'=>'Titular de la página (opcional)','eyebrow'=>'Etiqueta sobre el titular','intro'=>'Introducción de la página'] as $key=>$label) {
            echo '<p><label for="cv-'.$key.'"><strong>'.esc_html($label).'</strong></label><textarea style="width:100%" rows="2" id="cv-'.$key.'" name="cv_'.$key.'">'.esc_textarea(get_post_meta($post->ID,'_cv_'.$key,true)).'</textarea></p>';
        }
        echo '<p><label for="cv-art">Ilustración</label><select name="cv_art" id="cv-art"><option value="">Sin ilustración</option>';
        foreach(glob(get_stylesheet_directory().'/assets/ilustracion-*.webp') as $file) { $name=basename($file); echo '<option value="'.esc_attr($name).'" '.selected(cv_meta('art',$post->ID),$name,false).'>'.esc_html($name).'</option>'; }
        echo '</select></p>';
    },['page','post'],'normal');
});
add_action('save_post',function($id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!isset($_POST['cv_editorial_nonce']) || !is_string($_POST['cv_editorial_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['cv_editorial_nonce'])),'cv_save_editorial') || !current_user_can('edit_post',$id)) return;
    foreach(['seo_title','description','heading','eyebrow','intro','art'] as $key) if(isset($_POST['cv_'.$key]) && is_string($_POST['cv_'.$key])) update_post_meta($id,'_cv_'.$key,sanitize_text_field(wp_unslash($_POST['cv_'.$key])));
});
