<?php
add_action('after_setup_theme', function () { add_theme_support('title-tag'); add_theme_support('editor-styles'); add_editor_style('style.css'); });
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('cv-fonts', 'https://fonts.googleapis.com/css2?family=Alex+Brush&family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,400;1,600;1,700&family=Italianno&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap', [], null);
    wp_enqueue_style('cv-design', get_stylesheet_uri(), [], filemtime(get_stylesheet_directory().'/style.css'));
    wp_enqueue_style('cv-overrides', get_stylesheet_directory_uri().'/overrides.css', ['cv-design'], filemtime(get_stylesheet_directory().'/overrides.css'));
    wp_enqueue_style('cv-third-review', get_stylesheet_directory_uri().'/third-review.css', ['cv-overrides'], filemtime(get_stylesheet_directory().'/third-review.css'));
    wp_enqueue_style('cv-footer-review', get_stylesheet_directory_uri().'/footer-review.css', ['cv-third-review'], filemtime(get_stylesheet_directory().'/footer-review.css'));
    if (is_front_page()) {
        wp_enqueue_style('cv-welcome', get_stylesheet_directory_uri().'/welcome.css', ['cv-footer-review'], filemtime(get_stylesheet_directory().'/welcome.css'));
    }
    wp_enqueue_style('leaflet-css', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css', [], '1.9.4');
    wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', [], '1.9.4', true);
    // Rediseño Claude (sept. 2026): fichas, especialidades, contacto, blog y ajustes móviles. Siempre el último.
    wp_enqueue_style('cv-rediseno', get_stylesheet_directory_uri().'/rediseno-claude.css', is_front_page() ? ['cv-welcome'] : ['cv-footer-review'], filemtime(get_stylesheet_directory().'/rediseno-claude.css'));
    wp_enqueue_script('cv-ui', get_stylesheet_directory_uri().'/site.js', ['leaflet-js'], (string) filemtime(get_stylesheet_directory().'/site.js'), true);
});
add_action('wp_head', function () {
    if (is_singular()) { $description = get_post_meta(get_queried_object_id(), '_cv_description', true); if ($description) echo '<meta name="description" content="'.esc_attr($description).'">'; }
    $path = trim(parse_url(get_permalink(), PHP_URL_PATH) ?? '', '/');
    $locations = ['centros/plasencia'=>['Plasencia','Calle Sierra de Tormantos, 22','10600'], 'centros/navaconcejo'=>['Navaconcejo','Avenida de Extremadura, 117','10613']];
    if (isset($locations[$path])) {
        [$city,$street,$postal]=$locations[$path];
        echo '<script type="application/ld+json">'.wp_json_encode(['@context'=>'https://schema.org','@type'=>'MedicalBusiness','@id'=>get_permalink().'#centro','name'=>'Clínica Vocal '.$city,'url'=>get_permalink(),'telephone'=>'+34611169264','address'=>['@type'=>'PostalAddress','streetAddress'=>$street,'postalCode'=>$postal,'addressLocality'=>$city,'addressRegion'=>'Cáceres','addressCountry'=>'ES']],JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_HEX_TAG).'</script>';
    }
});
add_shortcode('cv_contact', function () {
    return '<form class="cv-form" id="cv-contact" action="https://formsubmit.co/clinicavocal@gmail.com" method="POST">'
        . '<input type="hidden" name="_subject" value="Nueva consulta web · Clínica Vocal">'
        . '<input type="hidden" name="_template" value="table">'
        . '<input type="hidden" name="_captcha" value="false">'
        . '<label>Nombre y apellidos<input name="name" autocomplete="given-name" required maxlength="80" placeholder="Tu nombre completo"></label>'
        . '<label>Teléfono o correo de contacto<input type="text" name="contact" required placeholder="Ej: 600 000 000 o email@ejemplo.com"></label>'
        . '<label>Clínica preferida<select name="location" required><option value="">Selecciona clínica</option><option value="Plasencia">Clínica Plasencia (C/ Sierra de Tormantos, 22)</option><option value="Navaconcejo">Clínica Navaconcejo (Avda. Extremadura, 117)</option><option value="Online">Atención Online (Psicología)</option></select></label>'
        . '<label>Especialidad que buscas<select name="service" required><option value="">Selecciona especialidad</option><option value="Logopedia">Logopedia Integral (Habla, voz, lenguaje)</option><option value="Psicologia">Psicología Sanitaria (Infanto-juvenil, adultos)</option><option value="Orientacion">Necesito orientación del equipo</option></select></label>'
        . '<label>Mensaje o motivo de consulta (opcional)<textarea name="message" rows="3" placeholder="Indica brevemente el motivo de la consulta..." style="resize:vertical;"></textarea></label>'
        . '<button class="cv-form-submit-btn" type="submit">Enviar solicitud</button>'
        . '<div class="cv-status" role="status" hidden></div>'
        . '</form>';
});
