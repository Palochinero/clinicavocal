<?php
/**
 * Clínica Vocal - Actualización Décima Revisión
 * Perfiles con foto de silueta y héroe, centros con botón destacado y centrado visual.
 */
if (php_sapi_name() !== 'cli') exit;
require_once __DIR__ . '/wordpress/wp-load.php';
echo "Iniciando script de actualización Décima Revisión...\n";

function cv10_update_page($path, $title, $content, $desc = '') {
    $map = [
        'equipo/cristina-iglesias-martin' => 28,
        'equipo/jessica-serrano-diaz' => 29,
        'equipo/andrea-montero-regadera' => 30,
        'equipo/belen-mesa-montero' => 31,
        'centros/plasencia' => 10,
        'centros/navaconcejo' => 11,
        'equipo' => 8,
        'centros' => 9,
        'inicio' => 5
    ];
    $id = isset($map[$path]) ? $map[$path] : 0;
    if (!$id) {
        $page = get_page_by_path($path);
        if ($page) {
            $id = $page->ID;
        }
    }
    
    if ($id) {
        $post_data = [
            'ID' => $id,
            'post_title' => $title,
            'post_content' => $content,
            'post_status' => 'publish'
        ];
        $res = wp_update_post($post_data, true);
        if (is_wp_error($res)) {
            echo "Error actualizando {$path} (ID: {$id}): " . $res->get_error_message() . "\n";
        }
    } else {
        $parts = explode('/', trim($path, '/'));
        $slug = array_pop($parts);
        $parent = 0;
        if (!empty($parts)) {
            $parent_obj = get_page_by_path(implode('/', $parts));
            if ($parent_obj) {
                $parent = $parent_obj->ID;
            }
        }
        $post_data = [
            'post_type' => 'page',
            'post_name' => $slug,
            'post_title' => $title,
            'post_status' => 'publish',
            'post_parent' => $parent,
            'post_content' => $content
        ];
        $id = wp_insert_post($post_data, true);
        if (is_wp_error($id)) {
            echo "Error insertando {$path}: " . $id->get_error_message() . "\n";
        }
    }
    
    if ($desc) {
        update_post_meta($id, '_cv_description', $desc);
    }
    echo "Página actualizada con éxito: {$path} (ID: {$id})\n";
    return $id;
}

// -----------------------------------------------------------------------------
// 1. FICHAS INDIVIDUALES DEL EQUIPO PROFESIONAL
// -----------------------------------------------------------------------------

// 1.1 Cristina Iglesias Martín
$cristina_content = '<!-- wp:html -->
<div class="cv-profile-wrap">
    <div class="cv-profile-hero-card">
        <div class="cv-profile-hero-info">
            <div class="cv-profile-badges">
                <span class="cv-profile-badge-specialty">Logopedia Clínica &amp; Dirección</span>
                <span class="cv-profile-badge-col">Col. Nº 10/0270</span>
            </div>
            <h1 class="cv-profile-name">CRISTINA IGLESIAS MARTÍN</h1>
            <p class="cv-profile-hero-role">Logopeda · Responsable de Clínica Vocal · Sedes: Plasencia y Navaconcejo</p>
            <p class="cv-profile-hero-bio">Cristina Iglesias es la responsable clínica de Clínica Vocal y especialista en logopedia integral. Su ejercicio sanitario se orienta a la valoración exhaustiva, diagnóstico e intervención en motricidad orofacial, logopedia neonatal y apoyo a la alimentación, así como en la rehabilitación de trastornos de la voz, el habla, el lenguaje y las funciones deglutorias en el norte de Extremadura.</p>
            <div class="cv-profile-actions">
                <a href="https://wa.me/34611169264?text=Hola%20Cristina,%20me%20gustar%C3%ADa%20consultar%20sobre%20Logopedia%20en%20Cl%C3%ADnica%20Vocal" target="_blank" rel="noopener noreferrer" class="cv-profile-btn-wa">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.477 2 12c0 1.826.49 3.538 1.343 5.008L2.1 21.9a.75.75 0 0 0 .914.914l4.892-1.243A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.5a8.47 8.47 0 0 1-4.34-1.19.75.75 0 0 0-.583-.073l-3.327.846.846-3.327a.75.75 0 0 0-.073-.583A8.47 8.47 0 0 1 3.5 12c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5-3.806 8.5-8.5 8.5z"/></svg>
                    <span>Contactar con esta profesional</span>
                </a>
                <a href="/contacto/" class="cv-profile-btn-cita">
                    <span>Pedir Cita Previa ↗</span>
                </a>
            </div>
        </div>
    </div>

    <div class="cv-profile-details-grid">
        <div class="cv-profile-section-card">
            <h3>🎓 Formación y Acreditación Sanitaria</h3>
            <ul class="cv-profile-list">
                <li>Grado Universitario Oficial en Logopedia.</li>
                <li>Colegiada Nº 10/0270 en el Colegio Profesional de Logopedas de Extremadura.</li>
                <li>Formación avanzada en Motricidad Orofacial y desarrollo equilibrado de estructuras orofaciales.</li>
                <li>Especialización en Logopedia Neonatal y apoyo a la alimentación (lactancia materna y biberón).</li>
                <li>Especialización en Rehabilitación y Técnica Vocal para profesionales de la voz (docentes, cantantes, opositores).</li>
                <li>Atención Temprana y Trastornos del Desarrollo del Lenguaje (TDL/TEL).</li>
            </ul>
        </div>
        <div class="cv-profile-section-card">
            <h3>🩺 Áreas de Intervención Clínica</h3>
            <ul class="cv-profile-list">
                <li>Motricidad orofacial: respiración, masticación, deglución atípica y succión.</li>
                <li>Logopedia neonatal: agarre, coordinación succión-respiración-deglución y postura en tomas.</li>
                <li>Rehabilitación vocal: disfonías funcionales y orgánicas (nódulos, pólipos, fatiga vocal).</li>
                <li>Trastornos del habla y articulación: dislalias (rotacismo, sigmatismo) y disglosias.</li>
                <li>Retrasos del lenguaje, dificultades de comprensión verbal y expresión infantil.</li>
                <li>Lectoescritura, dislexia y desarrollo de la conciencia fonológica escolar.</li>
            </ul>
        </div>
    </div>

    <div class="cv-profile-sedes-banner">
        <div class="cv-profile-sedes-content">
            <h3>Consultas y Disponibilidad</h3>
            <p>Atención presencial individualizada con cita concertada en nuestras dos sedes de <strong>Plasencia</strong> (C/ Sierra de Tormantos, 22) y <strong>Navaconcejo</strong> (Avda. de Extremadura, 117).</p>
        </div>
        <a href="tel:+34611169264" class="cv-profile-btn-cita">Llamar al 611 16 92 64</a>
    </div>
</div>
<!-- /wp:html -->';
cv10_update_page('equipo/cristina-iglesias-martin', 'Cristina Iglesias', $cristina_content, 'Cristina Iglesias Martín, Logopeda Colegiada Nº 10/0270 y responsable de Clínica Vocal en Plasencia y Navaconcejo. Cita previa: 611 16 92 64.');

// 1.2 Jessica Serrano Díaz (Datos oficiales de jessicaserranopsicologia.com)
$jessica_content = '<!-- wp:html -->
<div class="cv-profile-wrap">
    <div class="cv-profile-hero-card">
        <div class="cv-profile-hero-info">
            <div class="cv-profile-badges">
                <span class="cv-profile-badge-specialty">Psicología Sanitaria &amp; EMDR</span>
                <span class="cv-profile-badge-col">Col. Nº EX02166</span>
            </div>
            <h1 class="cv-profile-name">JESSICA SERRANO DÍAZ</h1>
            <p class="cv-profile-hero-role">Psicóloga General Sanitaria · Terapeuta EMDR Acreditada · Sedes: Plasencia y Consulta Online</p>
            <p class="cv-profile-hero-bio">Jessica Serrano Díaz es psicóloga general sanitaria con consulta en Plasencia y atención telemática online. Su ejercicio clínico se orienta desde una perspectiva integradora y humanista, combinando terapias de tercera generación y cognitivo-conductuales con abordaje especializado en trauma mediante EMDR. Ofrece un espacio cálido, seguro y confidencial para adultos, niños y adolescentes en el norte de Extremadura.</p>
            <div class="cv-profile-actions">
                <a href="https://wa.me/34672337731?text=Hola%20Jessica,%20me%20gustar%C3%ADa%20consultar%20sobre%20Psicolog%C3%ADa%20en%20Cl%C3%ADnica%20Vocal" target="_blank" rel="noopener noreferrer" class="cv-profile-btn-wa">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.477 2 12c0 1.826.49 3.538 1.343 5.008L2.1 21.9a.75.75 0 0 0 .914.914l4.892-1.243A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.5a8.47 8.47 0 0 1-4.34-1.19.75.75 0 0 0-.583-.073l-3.327.846.846-3.327a.75.75 0 0 0-.073-.583A8.47 8.47 0 0 1 3.5 12c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5-3.806 8.5-8.5 8.5z"/></svg>
                    <span>Contactar por WhatsApp (672 33 77 31)</span>
                </a>
                <a href="/contacto/" class="cv-profile-btn-cita">
                    <span>Pedir Cita Previa ↗</span>
                </a>
            </div>
        </div>
    </div>

    <div class="cv-profile-details-grid">
        <div class="cv-profile-section-card">
            <h3>🎓 Formación y Acreditación Sanitaria Oficial</h3>
            <ul class="cv-profile-list">
                <li>Licenciada en Psicología por la Universidad de Huelva y la Universidad Complutense de Madrid.</li>
                <li>Máster Universitario en Psicología General Sanitaria (Universitat Autònoma de Barcelona - UAB). Habilitación sanitaria oficial.</li>
                <li>Colegiada Nº EX02166 en el Colegio Oficial de Psicología de Extremadura.</li>
                <li>Máster en Atención Temprana por la Fundación San Pablo CEU Andalucía.</li>
                <li>Terapeuta Acreditada en EMDR (Niveles I y II para adultos, infancia y adolescencia) por la Asociación EMDR España.</li>
                <li>Especialización en Trauma Psicológico, Estrés Postraumático (TEPT) y Disociación.</li>
                <li>Formación avanzada en Apego Seguro, Dependencia Emocional, Duelo y Regulación Emocional.</li>
                <li>Capacitación en Terapia con Caja de Arena (Sandplay), herramientas proyectivas, Playmobil y evaluación con ADOS-2.</li>
            </ul>
        </div>
        <div class="cv-profile-section-card">
            <h3>🩺 Áreas y Metodología de Intervención Clínica</h3>
            <ul class="cv-profile-list">
                <li>Psicoterapia individual en adultos: Abordaje integrador del trauma y reprocesamiento de experiencias adversas con EMDR.</li>
                <li>Tratamiento de la ansiedad generalizada, crisis de pánico, estrés crónico y fobias.</li>
                <li>Acompañamiento en procesos de duelo significativo, rupturas de pareja y dependencia afectiva.</li>
                <li>Gestión de estados depresivos, desánimo, tristeza persistente y reconstrucción de la autoestima.</li>
                <li>Psicología Infanto-Juvenil: Dificultades conductuales, regulación emocional, apego seguro y adaptación escolar.</li>
                <li>Orientación psicoeducativa a familias y dinámicas relacionales.</li>
                <li>Consulta online segura por videollamada para pacientes con dificultades de desplazamiento o residentes fuera de Plasencia.</li>
            </ul>
        </div>
    </div>

    <div class="cv-profile-sedes-banner">
        <div class="cv-profile-sedes-content">
            <h3>Consultas, Sedes y Web Oficial</h3>
            <p>Atención presencial en <strong>Plasencia</strong> (C/ Sierra de Tormantos, 16, Local 3 / C/ Sierra de Tormantos, 22) y modalidad <strong>Online</strong> con cita concertada.<br>Web profesional: <a href="https://www.jessicaserranopsicologia.com" target="_blank" rel="noopener noreferrer" style="color: var(--color-roble); font-weight: 700; text-decoration: underline;">jessicaserranopsicologia.com ↗</a></p>
        </div>
        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
            <a href="tel:+34672337731" class="cv-profile-btn-cita">Llamar al 672 33 77 31</a>
            <a href="tel:+34611169264" class="cv-profile-btn-cita" style="border-color: rgba(156,122,91,0.5);">Centralita: 611 16 92 64</a>
        </div>
    </div>
</div>
<!-- /wp:html -->';
cv10_update_page('equipo/jessica-serrano-diaz', 'Jessica Serrano', $jessica_content, 'Jessica Serrano Díaz, Psicóloga General Sanitaria Col. Nº EX02166. Formación oficial y EMDR en adultos e infancia en Plasencia y Online. Web: jessicaserranopsicologia.com.');

// 1.3 Andrea Montero Regadera
$andrea_content = '<!-- wp:html -->
<div class="cv-profile-wrap">
    <div class="cv-profile-hero-card">
        <div class="cv-profile-hero-info">
            <div class="cv-profile-badges">
                <span class="cv-profile-badge-specialty">Psicología Sanitaria &amp; Bienestar</span>
                <span class="cv-profile-badge-col">Col. Nº EX-02112</span>
            </div>
            <h1 class="cv-profile-name">ANDREA MONTERO REGADERA</h1>
            <p class="cv-profile-hero-role">Psicóloga Sanitaria · Sedes: Plasencia y Navaconcejo (Valle del Jerte)</p>
            <p class="cv-profile-hero-bio">Andrea Montero Regadera ejerce como psicóloga general sanitaria prestando atención clínica continuada en ambas sedes de Clínica Vocal. Su labor terapéutica se enfoca en el desarrollo personal, el fortalecimiento de la autoestima, la superación de crisis adaptativas y el bienestar socioemocional, ofreciendo cercanía y rigurosidad profesional en el norte de Extremadura.</p>
            <div class="cv-profile-actions">
                <a href="https://wa.me/34611169264?text=Hola%20Andrea,%20me%20gustar%C3%ADa%20consultar%20sobre%20Psicolog%C3%ADa%20en%20Cl%C3%ADnica%20Vocal" target="_blank" rel="noopener noreferrer" class="cv-profile-btn-wa">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.477 2 12c0 1.826.49 3.538 1.343 5.008L2.1 21.9a.75.75 0 0 0 .914.914l4.892-1.243A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.5a8.47 8.47 0 0 1-4.34-1.19.75.75 0 0 0-.583-.073l-3.327.846.846-3.327a.75.75 0 0 0-.073-.583A8.47 8.47 0 0 1 3.5 12c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5-3.806 8.5-8.5 8.5z"/></svg>
                    <span>Contactar con esta profesional</span>
                </a>
                <a href="/contacto/" class="cv-profile-btn-cita">
                    <span>Pedir Cita Previa ↗</span>
                </a>
            </div>
        </div>
    </div>

    <div class="cv-profile-details-grid">
        <div class="cv-profile-section-card">
            <h3>🎓 Formación y Acreditación Sanitaria</h3>
            <ul class="cv-profile-list">
                <li>Grado Universitario Oficial en Psicología.</li>
                <li>Máster Universitario en Psicología General Sanitaria (habilitación oficial).</li>
                <li>Colegiada Nº EX-02112 en el Colegio Oficial de Psicología de Extremadura.</li>
                <li>Especialización en Regulación Emocional, Autoestima y Habilidades de Afrontamiento.</li>
                <li>Formación en Acompañamiento Psicológico a Familias y Dinámicas Relacionales.</li>
            </ul>
        </div>
        <div class="cv-profile-section-card">
            <h3>🩺 Áreas de Intervención Clínica</h3>
            <ul class="cv-profile-list">
                <li>Psicoterapia individual para jóvenes, adolescentes y adultos.</li>
                <li>Fortalecimiento del autoconcepto, autoestima y seguridad personal.</li>
                <li>Acompañamiento en etapas de transición, crisis personales e incertidumbre.</li>
                <li>Regulación y gestión del estrés, la sobrecarga cotidiana y la ansiedad.</li>
                <li>Atención sanitaria de proximidad en el Valle del Jerte y Plasencia.</li>
            </ul>
        </div>
    </div>

    <div class="cv-profile-sedes-banner">
        <div class="cv-profile-sedes-content">
            <h3>Consultas y Disponibilidad</h3>
            <p>Atención presencial en <strong>Clínica Plasencia</strong> y <strong>Clínica Navaconcejo</strong>. Consulta la disponibilidad de agenda para concertar tu sesión en la sede más cómoda.</p>
        </div>
        <a href="tel:+34611169264" class="cv-profile-btn-cita">Llamar al 611 16 92 64</a>
    </div>
</div>
<!-- /wp:html -->';
cv10_update_page('equipo/andrea-montero-regadera', 'Andrea Montero', $andrea_content, 'Andrea Montero Regadera, Psicóloga Sanitaria Colegiada Nº EX-02112 en Clínica Vocal (Plasencia y Navaconcejo). Cita previa: 611 16 92 64.');

// 1.4 Belén Mesa Montero
$belen_content = '<!-- wp:html -->
<div class="cv-profile-wrap">
    <div class="cv-profile-hero-card">
        <div class="cv-profile-hero-info">
            <div class="cv-profile-badges">
                <span class="cv-profile-badge-specialty">Psicología Infanto-Juvenil</span>
                <span class="cv-profile-badge-col">Col. Nº EX-02345</span>
            </div>
            <h1 class="cv-profile-name">BELÉN MESA MONTERO</h1>
            <p class="cv-profile-hero-role">Psicóloga Sanitaria · Enfoque en Infancia y Familias · Sede: Plasencia</p>
            <p class="cv-profile-hero-bio">Belén Mesa Montero está especializada en psicología sanitaria orientada al desarrollo infanto-juvenil. En la sede de Plasencia ofrece un entorno de confianza y adaptado a cada etapa madurativa, facilitando que niños y adolescentes comprendan sus emociones y superen dificultades conductuales o de adaptación, con una estrecha orientación psicoeducativa a las familias.</p>
            <div class="cv-profile-actions">
                <a href="https://wa.me/34611169264?text=Hola%20Bel%C3%A9n,%20me%20gustar%C3%ADa%20consultar%20sobre%20Psicolog%C3%ADa%20Infantil%20en%20Cl%C3%ADnica%20Vocal" target="_blank" rel="noopener noreferrer" class="cv-profile-btn-wa">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.477 2 12c0 1.826.49 3.538 1.343 5.008L2.1 21.9a.75.75 0 0 0 .914.914l4.892-1.243A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.5a8.47 8.47 0 0 1-4.34-1.19.75.75 0 0 0-.583-.073l-3.327.846.846-3.327a.75.75 0 0 0-.073-.583A8.47 8.47 0 0 1 3.5 12c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5-3.806 8.5-8.5 8.5z"/></svg>
                    <span>Contactar con esta profesional</span>
                </a>
                <a href="/contacto/" class="cv-profile-btn-cita">
                    <span>Pedir Cita Previa ↗</span>
                </a>
            </div>
        </div>
    </div>

    <div class="cv-profile-details-grid">
        <div class="cv-profile-section-card">
            <h3>🎓 Formación y Acreditación Sanitaria</h3>
            <ul class="cv-profile-list">
                <li>Grado Universitario Oficial en Psicología.</li>
                <li>Máster Universitario en Psicología General Sanitaria (habilitación oficial).</li>
                <li>Colegiada Nº EX-02345 en el Colegio Oficial de Psicología de Extremadura.</li>
                <li>Especialización en Psicología Infantil, Neurodesarrollo y Apego Seguro.</li>
                <li>Formación continua en Manejo Conductual y Pautas Educativas Positivas.</li>
            </ul>
        </div>
        <div class="cv-profile-section-card">
            <h3>🩺 Áreas de Intervención Clínica</h3>
            <ul class="cv-profile-list">
                <li>Evaluación e intervención psicológica en infancia y etapa escolar.</li>
                <li>Regulación de dificultades conductuales, impulsividad y gestión de la frustración.</li>
                <li>Acompañamiento en problemas de adaptación escolar, miedos evolutivos y timidez.</li>
                <li>Desarrollo de habilidades sociales y mejora del autoconcepto en menores.</li>
                <li>Pautas y coordinación continuada con familias y orientadores educativos.</li>
            </ul>
        </div>
    </div>

    <div class="cv-profile-sedes-banner">
        <div class="cv-profile-sedes-content">
            <h3>Consultas y Disponibilidad</h3>
            <p>Consultas individualizadas en <strong>Clínica Plasencia</strong> (C/ Sierra de Tormantos, 22), en gabinetes acondicionados y adaptados para la infancia y familias.</p>
        </div>
        <a href="tel:+34611169264" class="cv-profile-btn-cita">Llamar al 611 16 92 64</a>
    </div>
</div>
<!-- /wp:html -->';
cv10_update_page('equipo/belen-mesa-montero', 'Belén Mesa', $belen_content, 'Belén Mesa Montero, Psicóloga Sanitaria Colegiada Nº EX-02345 en Clínica Vocal (Plasencia). Psicología infantil y juvenil. Cita previa: 611 16 92 64.');

// -----------------------------------------------------------------------------
// 2. SEDES CLÍNICAS (PLASENCIA Y NAVACONCEJO) CON BOTÓN DESTACADO DE CONTACTO
// -----------------------------------------------------------------------------

// 2.1 Clínica Plasencia
$plasencia_content = '<!-- wp:html -->
<div class="cv-center-profile-wrap">
    <div class="cv-center-header-centered">
        <h1 class="cv-center-hero-title">Clínica Vocal · Clínica Plasencia</h1>
    </div>

    <div class="cv-center-panoramic-hero">
        <div class="cv-center-hero-col-left">
            <div class="cv-center-photo-frame">
                <img decoding="async" src="/wp-content/themes/clinica-vocal/assets/local-plasencia.jpg" alt="Instalaciones y fachada de Clínica Vocal en Plasencia" loading="lazy">
            </div>
        </div>
        <div class="cv-center-hero-col-right">
            <div class="cv-center-map-column-frame">
                <div id="map-centro-plasencia" class="cv-map-canvas" role="region" aria-label="Mapa de ubicación de Clínica Plasencia"></div>
                <a href="https://www.google.com/maps?cid=4860632199104703204" target="_blank" rel="noopener noreferrer" class="cv-map-link-badge" title="Abrir en Google Maps">
                    <span>Abrir en Google Maps ↗</span>
                </a>
            </div>
            <div class="cv-center-practical-grid">
                <div class="cv-practical-item">
                    <span class="cv-practical-label">Dirección</span>
                    <span class="cv-practical-val">Calle Sierra de Tormantos, 22<br>10600 Plasencia (Cáceres)</span>
                </div>
                <div class="cv-practical-item">
                    <span class="cv-practical-label">Horario Clínico</span>
                    <span class="cv-practical-val">Lunes a Viernes<br>9:00 – 14:00 | 16:00 – 20:00</span>
                </div>
                <div class="cv-practical-item">
                    <span class="cv-practical-label">Cita Previa</span>
                    <span class="cv-practical-val"><a href="tel:+34611169264">611 16 92 64</a><br>Atención con cita concertada</span>
                </div>
            </div>
        </div>
    </div>

    <div class="cv-center-team-section">
        <h2 class="cv-center-team-title">Especialistas que Atienden en Clínica Plasencia</h2>
        <p class="cv-center-team-desc">Equipo sanitario interdisciplinar con dedicación continuada en nuestras consultas de Plasencia. Puedes contactar directamente con cada profesional:</p>

        <div class="cv-specialists-grid">
            <!-- Especialista 1: Cristina Iglesias -->
            <div class="cv-specialist-card">
                <div class="cv-specialist-body">
                    <span class="cv-specialist-avatar-badge">Logopedia</span>
                    <h3>CRISTINA IGLESIAS</h3>
                    <span class="cv-specialist-role">Logopeda Colegiada Nº 10/0270 · Responsable de Clínica Vocal</span>
                    <p class="cv-specialist-desc">Especialista en motricidad orofacial, logopedia neonatal y apoyo a la alimentación, trastornos de la voz, deglución, habla y terapia miofuncional.</p>
                    <div class="cv-specialist-actions">
                        <a href="https://wa.me/34611169264?text=Hola%20Cristina,%20me%20gustar%C3%ADa%20consultar%20directamente%20sobre%20Logopedia%20en%20Cl%C3%ADnica%20Plasencia" target="_blank" rel="noopener noreferrer" class="cv-spec-btn-contact-main">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.477 2 12c0 1.826.49 3.538 1.343 5.008L2.1 21.9a.75.75 0 0 0 .914.914l4.892-1.243A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.5a8.47 8.47 0 0 1-4.34-1.19.75.75 0 0 0-.583-.073l-3.327.846.846-3.327a.75.75 0 0 0-.073-.583A8.47 8.47 0 0 1 3.5 12c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5-3.806 8.5-8.5 8.5z"/></svg>
                            <span>Contactar con esta profesional</span>
                        </a>
                        <a href="/equipo/cristina-iglesias-martin/" class="cv-spec-link-sub">Ver perfil y formación completa →</a>
                    </div>
                </div>
            </div>

            <!-- Especialista 2: Jessica Serrano -->
            <div class="cv-specialist-card">
                <div class="cv-specialist-body">
                    <span class="cv-specialist-avatar-badge">Psicología · EMDR</span>
                    <h3>JESSICA SERRANO</h3>
                    <span class="cv-specialist-role">Psicóloga General Sanitaria · Col. Nº EX02166 · EMDR</span>
                    <p class="cv-specialist-desc">Psicoterapia integradora en adultos, infancia y adolescencia. Abordaje especializado en trauma con EMDR, ansiedad, apego, duelo y atención presencial y online.</p>
                    <div class="cv-specialist-actions">
                        <a href="https://wa.me/34672337731?text=Hola%20Jessica,%20me%20gustar%C3%ADa%20consultar%20directamente%20sobre%20Psicolog%C3%ADa%20en%20Cl%C3%ADnica%20Plasencia" target="_blank" rel="noopener noreferrer" class="cv-spec-btn-contact-main">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.477 2 12c0 1.826.49 3.538 1.343 5.008L2.1 21.9a.75.75 0 0 0 .914.914l4.892-1.243A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.5a8.47 8.47 0 0 1-4.34-1.19.75.75 0 0 0-.583-.073l-3.327.846.846-3.327a.75.75 0 0 0-.073-.583A8.47 8.47 0 0 1 3.5 12c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5-3.806 8.5-8.5 8.5z"/></svg>
                            <span>Contactar con esta profesional</span>
                        </a>
                        <a href="/equipo/jessica-serrano-diaz/" class="cv-spec-link-sub">Ver perfil y formación completa →</a>
                    </div>
                </div>
            </div>

            <!-- Especialista 3: Andrea Montero -->
            <div class="cv-specialist-card">
                <div class="cv-specialist-body">
                    <span class="cv-specialist-avatar-badge">Psicología Sanitaria</span>
                    <h3>ANDREA MONTERO</h3>
                    <span class="cv-specialist-role">Psicóloga General Sanitaria Colegiada Nº EX-02112</span>
                    <p class="cv-specialist-desc">Atención psicológica individual, bienestar socioemocional, autoestima, etapas evolutivas y procesos adaptativos en adolescentes y adultos.</p>
                    <div class="cv-specialist-actions">
                        <a href="https://wa.me/34611169264?text=Hola%20Andrea,%20me%20gustar%C3%ADa%20consultar%20directamente%20sobre%20Psicolog%C3%ADa%20en%20Cl%C3%ADnica%20Plasencia" target="_blank" rel="noopener noreferrer" class="cv-spec-btn-contact-main">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.477 2 12c0 1.826.49 3.538 1.343 5.008L2.1 21.9a.75.75 0 0 0 .914.914l4.892-1.243A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.5a8.47 8.47 0 0 1-4.34-1.19.75.75 0 0 0-.583-.073l-3.327.846.846-3.327a.75.75 0 0 0-.073-.583A8.47 8.47 0 0 1 3.5 12c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5-3.806 8.5-8.5 8.5z"/></svg>
                            <span>Contactar con esta profesional</span>
                        </a>
                        <a href="/equipo/andrea-montero-regadera/" class="cv-spec-link-sub">Ver perfil y formación completa →</a>
                    </div>
                </div>
            </div>

            <!-- Especialista 4: Belén Mesa -->
            <div class="cv-specialist-card">
                <div class="cv-specialist-body">
                    <span class="cv-specialist-avatar-badge">Psicología Infanto-Juvenil</span>
                    <h3>BELÉN MESA</h3>
                    <span class="cv-specialist-role">Psicóloga General Sanitaria Colegiada Nº EX-02345</span>
                    <p class="cv-specialist-desc">Especialista en psicología infanto-juvenil, apego, regulación emocional, dificultades conductuales y orientación psicoeducativa familiar.</p>
                    <div class="cv-specialist-actions">
                        <a href="https://wa.me/34611169264?text=Hola%20Bel%C3%A9n,%20me%20gustar%C3%ADa%20consultar%20directamente%20sobre%20Psicolog%C3%ADa%20Infanto-Juvenil%20en%20Cl%C3%ADnica%20Plasencia" target="_blank" rel="noopener noreferrer" class="cv-spec-btn-contact-main">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.477 2 12c0 1.826.49 3.538 1.343 5.008L2.1 21.9a.75.75 0 0 0 .914.914l4.892-1.243A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.5a8.47 8.47 0 0 1-4.34-1.19.75.75 0 0 0-.583-.073l-3.327.846.846-3.327a.75.75 0 0 0-.073-.583A8.47 8.47 0 0 1 3.5 12c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5-3.806 8.5-8.5 8.5z"/></svg>
                            <span>Contactar con esta profesional</span>
                        </a>
                        <a href="/equipo/belen-mesa-montero/" class="cv-spec-link-sub">Ver perfil y formación completa →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /wp:html -->';
cv10_update_page('centros/plasencia', 'Clínica Vocal en Plasencia', $plasencia_content, 'Clínica Vocal en Plasencia: Calle Sierra de Tormantos, 22. Especialistas en logopedia y psicología. Cita previa: 611 16 92 64.');

// 2.2 Clínica Navaconcejo
$navaconcejo_content = '<!-- wp:html -->
<div class="cv-center-profile-wrap">
    <div class="cv-center-header-centered">
        <h1 class="cv-center-hero-title">Clínica Vocal · Clínica Navaconcejo</h1>
    </div>

    <div class="cv-center-panoramic-hero">
        <div class="cv-center-hero-col-left">
            <div class="cv-center-photo-frame">
                <img decoding="async" src="/wp-content/themes/clinica-vocal/assets/local-navaconcejo.jpg" alt="Instalaciones de Clínica Vocal en Navaconcejo, Valle del Jerte" loading="lazy">
            </div>
        </div>
        <div class="cv-center-hero-col-right">
            <div class="cv-center-map-column-frame">
                <div id="map-centro-navaconcejo" class="cv-map-canvas" role="region" aria-label="Mapa de ubicación de Clínica Navaconcejo"></div>
                <a href="https://www.google.com/maps/search/?api=1&query=Cl%C3%ADnica+Vocal+Av.+Extremadura+117+Navaconcejo" target="_blank" rel="noopener noreferrer" class="cv-map-link-badge" title="Abrir en Google Maps">
                    <span>Abrir en Google Maps ↗</span>
                </a>
            </div>
            <div class="cv-center-practical-grid">
                <div class="cv-practical-item">
                    <span class="cv-practical-label">Dirección</span>
                    <span class="cv-practical-val">Avenida de Extremadura, 117<br>10613 Navaconcejo (Cáceres)</span>
                </div>
                <div class="cv-practical-item">
                    <span class="cv-practical-label">Horario Clínico</span>
                    <span class="cv-practical-val">Lunes a Viernes<br>9:00 – 14:00 | 16:00 – 20:00</span>
                </div>
                <div class="cv-practical-item">
                    <span class="cv-practical-label">Cita Previa</span>
                    <span class="cv-practical-val"><a href="tel:+34611169264">611 16 92 64</a><br>Atención con cita concertada</span>
                </div>
            </div>
        </div>
    </div>

    <div class="cv-center-team-section">
        <h2 class="cv-center-team-title">Especialistas que Atienden en Clínica Navaconcejo</h2>
        <p class="cv-center-team-desc">Equipo sanitario con dedicación continuada en nuestras consultas del Valle del Jerte. Puedes contactar directamente con cada profesional:</p>

        <div class="cv-specialists-grid">
            <!-- Especialista 1: Cristina Iglesias -->
            <div class="cv-specialist-card">
                <div class="cv-specialist-body">
                    <span class="cv-specialist-avatar-badge">Logopedia</span>
                    <h3>CRISTINA IGLESIAS</h3>
                    <span class="cv-specialist-role">Logopeda Colegiada Nº 10/0270 · Responsable de Clínica Vocal</span>
                    <p class="cv-specialist-desc">Especialista en motricidad orofacial, logopedia neonatal y apoyo a la alimentación, patología vocal, deglución, habla y terapia miofuncional.</p>
                    <div class="cv-specialist-actions">
                        <a href="https://wa.me/34611169264?text=Hola%20Cristina,%20me%20gustar%C3%ADa%20consultar%20directamente%20sobre%20Logopedia%20en%20Cl%C3%ADnica%20Navaconcejo" target="_blank" rel="noopener noreferrer" class="cv-spec-btn-contact-main">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.477 2 12c0 1.826.49 3.538 1.343 5.008L2.1 21.9a.75.75 0 0 0 .914.914l4.892-1.243A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.5a8.47 8.47 0 0 1-4.34-1.19.75.75 0 0 0-.583-.073l-3.327.846.846-3.327a.75.75 0 0 0-.073-.583A8.47 8.47 0 0 1 3.5 12c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5-3.806 8.5-8.5 8.5z"/></svg>
                            <span>Contactar con esta profesional</span>
                        </a>
                        <a href="/equipo/cristina-iglesias-martin/" class="cv-spec-link-sub">Ver perfil y formación completa →</a>
                    </div>
                </div>
            </div>

            <!-- Especialista 2: Andrea Montero -->
            <div class="cv-specialist-card">
                <div class="cv-specialist-body">
                    <span class="cv-specialist-avatar-badge">Psicología Sanitaria</span>
                    <h3>ANDREA MONTERO</h3>
                    <span class="cv-specialist-role">Psicóloga General Sanitaria Colegiada Nº EX-02112</span>
                    <p class="cv-specialist-desc">Atención psicológica individual, bienestar socioemocional, autoestima, etapas evolutivas y procesos adaptativos en adolescentes y adultos.</p>
                    <div class="cv-specialist-actions">
                        <a href="https://wa.me/34611169264?text=Hola%20Andrea,%20me%20gustar%C3%ADa%20consultar%20directamente%20sobre%20Psicolog%C3%ADa%20en%20Cl%C3%ADnica%20Navaconcejo" target="_blank" rel="noopener noreferrer" class="cv-spec-btn-contact-main">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.477 2 12c0 1.826.49 3.538 1.343 5.008L2.1 21.9a.75.75 0 0 0 .914.914l4.892-1.243A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.5a8.47 8.47 0 0 1-4.34-1.19.75.75 0 0 0-.583-.073l-3.327.846.846-3.327a.75.75 0 0 0-.073-.583A8.47 8.47 0 0 1 3.5 12c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5-3.806 8.5-8.5 8.5z"/></svg>
                            <span>Contactar con esta profesional</span>
                        </a>
                        <a href="/equipo/andrea-montero-regadera/" class="cv-spec-link-sub">Ver perfil y formación completa →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /wp:html -->';
cv10_update_page('centros/navaconcejo', 'Clínica Vocal en Navaconcejo', $navaconcejo_content, 'Clínica Vocal en Navaconcejo (Valle del Jerte): Avda. Extremadura, 117. Logopedia y psicología. Cita previa: 611 16 92 64.');

// -----------------------------------------------------------------------------
// 3. PÁGINA DE EQUIPO GENERAL CON PESTAÑAS Y TEXTOS CENTRADOS
// -----------------------------------------------------------------------------
$team_content = '<!-- wp:html -->
<p class="cv-lead">Un equipo interdisciplinar formado por profesionales sanitarias tituladas en logopedia y psicología, coordinadas para ofrecerte una intervención cercana, individualizada y rigurosa en el norte de Extremadura.</p>

<section class="cv-team-tabs" aria-label="Equipo por centro">
    <div class="cv-team-tablist" role="tablist" aria-label="Elige un centro de atención">
        <button class="cv-team-tab" type="button" role="tab" aria-selected="true" aria-controls="equipo-plasencia" data-team-tab="plasencia">Clínica Plasencia</button>
        <button class="cv-team-tab" type="button" role="tab" aria-selected="false" aria-controls="equipo-navaconcejo" data-team-tab="navaconcejo">Clínica Navaconcejo</button>
    </div>

    <div id="equipo-plasencia" class="cv-team-panel" role="tabpanel" data-team-panel="plasencia">
        <span class="cv-team-label">Centro de Plasencia</span>
        <h2 class="cv-team-panel-title">Equipo Clínico Completo</h2>
        <p class="cv-team-panel-intro">Cuatro profesionales sanitarias con atención continuada en Plasencia. Selecciona una ficha para ver su perfil completo y concertar cita.</p>

        <div class="cv-person-grid">
            <a class="cv-person-card" href="/equipo/cristina-iglesias-martin/">
                <span class="cv-person-type">Logopedia Integral</span>
                <h3>CRISTINA IGLESIAS</h3>
                <p>Logopeda Col. Nº 10/0270 · Responsable de Clínica Vocal</p>
                <span class="cv-card-arrow">Ver perfil y áreas clínicas ↗</span>
            </a>
            <a class="cv-person-card" href="/equipo/jessica-serrano-diaz/">
                <span class="cv-person-type">Psicología Sanitaria · EMDR</span>
                <h3>JESSICA SERRANO</h3>
                <p>Psicóloga General Sanitaria Col. Nº EX02166 · Plasencia y Online</p>
                <span class="cv-card-arrow">Ver perfil y áreas clínicas ↗</span>
            </a>
            <a class="cv-person-card" href="/equipo/andrea-montero-regadera/">
                <span class="cv-person-type">Psicología Sanitaria</span>
                <h3>ANDREA MONTERO</h3>
                <p>Psicóloga General Sanitaria Col. Nº EX-02112 · Plasencia y Navaconcejo</p>
                <span class="cv-card-arrow">Ver perfil y áreas clínicas ↗</span>
            </a>
            <a class="cv-person-card" href="/equipo/belen-mesa-montero/">
                <span class="cv-person-type">Psicología Infanto-Juvenil</span>
                <h3>BELÉN MESA</h3>
                <p>Psicóloga General Sanitaria Col. Nº EX-02345 · Infancia y familias</p>
                <span class="cv-card-arrow">Ver perfil y áreas clínicas ↗</span>
            </a>
        </div>
    </div>

    <div id="equipo-navaconcejo" class="cv-team-panel" role="tabpanel" data-team-panel="navaconcejo" hidden>
        <span class="cv-team-label">Centro de Navaconcejo</span>
        <h2 class="cv-team-panel-title">Atención en el Valle del Jerte</h2>
        <p class="cv-team-panel-intro">Servicio de logopedia y psicología sanitaria de proximidad para evitar desplazamientos a familias y pacientes.</p>

        <div class="cv-person-grid">
            <a class="cv-person-card" href="/equipo/cristina-iglesias-martin/">
                <span class="cv-person-type">Logopedia Integral</span>
                <h3>CRISTINA IGLESIAS</h3>
                <p>Logopeda Col. Nº 10/0270 · Responsable de Clínica Vocal</p>
                <span class="cv-card-arrow">Ver perfil y áreas clínicas ↗</span>
            </a>
            <a class="cv-person-card" href="/equipo/andrea-montero-regadera/">
                <span class="cv-person-type">Psicología Sanitaria</span>
                <h3>ANDREA MONTERO</h3>
                <p>Psicóloga General Sanitaria Col. Nº EX-02112 · Atención en Navaconcejo</p>
                <span class="cv-card-arrow">Ver perfil y áreas clínicas ↗</span>
            </a>
        </div>
    </div>
</section>

<div class="cv-pending" style="margin-top: 35px; text-align: center;">
    Para consultar disponibilidad o concertar una cita con cualquiera de nuestras profesionales, contacta en el <strong>611 16 92 64</strong>.
</div>
<!-- /wp:html -->';
cv10_update_page('equipo', 'Nuestro equipo', $team_content, 'Equipo sanitario de Clínica Vocal: Cristina Iglesias Martín, Jessica Serrano Díaz, Andrea Montero Regadera y Belén Mesa Montero.');

// -----------------------------------------------------------------------------
// 4. PÁGINA DE CENTROS GENERAL CENTRADA
// -----------------------------------------------------------------------------
$centers_content = '<!-- wp:html -->
<p class="cv-lead">Clínica Vocal cuenta con dos clínicas sanitarias acondicionadas en la provincia de Cáceres para prestar atención cercana y de máxima calidad en logopedia y psicología.</p>

<div class="cv-clean-grid">
    <article class="cv-clean-card" style="text-align: center;">
        <div>
            <h3 style="text-align: center;">Clínica Plasencia</h3>
            <p style="text-align: center;"><strong>Calle Sierra de Tormantos, 22 · 10600 Plasencia (Cáceres)</strong></p>
            <p style="text-align: center;">Centro sanitario principal con equipo completo de tres psicólogas y una logopeda. Instalaciones adaptadas para intervención infantil, juvenil y adultos.</p>
            <p style="text-align: center; font-size: 14.5px; color: var(--color-roble);"><strong>Profesionales:</strong> CRISTINA IGLESIAS, JESSICA SERRANO, ANDREA MONTERO y BELÉN MESA.</p>
        </div>
        <a class="cv-card-link" href="/centros/plasencia/" style="justify-content: center;">Ver información y especialistas de Plasencia ↗</a>
    </article>

    <article class="cv-clean-card" style="text-align: center;">
        <div>
            <h3 style="text-align: center;">Clínica Navaconcejo</h3>
            <p style="text-align: center;"><strong>Avenida de Extremadura, 117 · 10613 Navaconcejo (Cáceres)</strong></p>
            <p style="text-align: center;">Espacio de atención continuada en el Valle del Jerte con logopedia y psicología para evitar desplazamientos largos a familias y pacientes comarcales.</p>
            <p style="text-align: center; font-size: 14.5px; color: var(--color-roble);"><strong>Profesionales:</strong> CRISTINA IGLESIAS (Logopedia) y ANDREA MONTERO (Psicología).</p>
        </div>
        <a class="cv-card-link" href="/centros/navaconcejo/" style="justify-content: center;">Ver información y especialistas de Navaconcejo ↗</a>
    </article>
</div>

<div class="cv-pending" style="margin-top: 30px; text-align: center;">
    Atención presencial con cita concertada. Llama al <a href="tel:+34611169264"><strong>611 16 92 64</strong></a> para consultar disponibilidad en la clínica que prefieras.
</div>
<!-- /wp:html -->';
cv10_update_page('centros', 'Nuestros centros', $centers_content, 'Clínicas de Clínica Vocal en Plasencia y Navaconcejo (Cáceres). Instalaciones, equipo profesional y cita previa: 611 16 92 64.');

// -----------------------------------------------------------------------------
// 5. PÁGINA DE LOGOPEDIA (Con textos requeridos de Motricidad Orofacial y Neonatal)
// -----------------------------------------------------------------------------
$logopedia_content = '<!-- wp:html -->
<p class="cv-lead">Servicio sanitario de evaluación, diagnóstico y tratamiento especializado en motricidad orofacial, logopedia neonatal y apoyo a la alimentación, trastornos de la voz, el habla, el lenguaje y la lectoescritura en Plasencia y Navaconcejo, dirigido por la logopeda CRISTINA IGLESIAS.</p>

<div class="cv-clean-grid">
    <article class="cv-clean-card">
        <div>
            <h3>Motricidad Orofacial</h3>
            <p>Evaluación y tratamiento de las estructuras y funciones de la boca y la cara —como la respiración, la masticación, la deglución, la succión y el habla— para favorecer un desarrollo orofacial equilibrado.</p>
        </div>
    </article>

    <article class="cv-clean-card">
        <div>
            <h3>Logopedia Neonatal y Apoyo a la Alimentación</h3>
            <p>Acompañamiento especializado a recién nacidos y sus familias para favorecer una alimentación segura y eficaz, tanto mediante lactancia materna como biberón. Se valoran aspectos como la succión, el agarre, la coordinación entre succión, respiración y deglución, la postura y las posibles dificultades durante las tomas.</p>
            <p style="margin-top: 10px;">El objetivo es ofrecer apoyo individualizado, resolver dudas y ayudar a que la alimentación del bebé sea una experiencia más tranquila, cómoda y satisfactoria para toda la familia.</p>
        </div>
    </article>

    <article class="cv-clean-card">
        <div>
            <h3>Terapia y Rehabilitación de la Voz</h3>
            <p>Tratamiento de disfonías funcionales y patológicas (nódulos, pólipos, edema de Reinke, parálisis cordales, fatiga vocal). Entrenamiento y pautas de higiene vocal para profesionales de la voz hablada o cantada (docentes, cantantes, actores, opositores).</p>
        </div>
    </article>

    <article class="cv-clean-card">
        <div>
            <h3>Habla, Lenguaje y Lectoescritura</h3>
            <p>Intervención clínica en dificultades del habla y articulación, dislalias (rotacismo, sigmatismo), deglución atípica, retraso del desarrollo del lenguaje (TEL/TDL) y dificultades en la adquisición de la lectura, escritura y dislexia en edad escolar.</p>
        </div>
    </article>
</div>

<h3>Cómo se organiza tu primera visita de logopedia</h3>
<p>En la primera consulta realizamos una entrevista clínica y una valoración inicial de las dificultades comunicativas, orofaciales o funcionales para plantear un plan de tratamiento adaptado a tus objetivos y necesidades cotidianas.</p>

<p><strong>Profesional responsable:</strong> CRISTINA IGLESIAS (Logopeda Colegiada Nº 10/0270).<br>
<strong>Clínicas disponibles:</strong> Plasencia (C/ Sierra de Tormantos, 22) y Navaconcejo (Avda. Extremadura, 117).<br>
<strong>Teléfono de cita previa:</strong> <a href="tel:+34611169264"><strong>611 16 92 64</strong></a>.</p>

<p><a class="cv-button" href="/contacto/">Solicitar primera cita de logopedia ↗</a></p>
<!-- /wp:html -->';
cv10_update_page('logopedia', 'Logopedia en Plasencia y Navaconcejo', $logopedia_content, 'Logopedia clínica en Plasencia y Navaconcejo con Cristina Iglesias. Motricidad orofacial, logopedia neonatal, voz, habla y deglución. Cita previa: 611 16 92 64.');

// -----------------------------------------------------------------------------
// 6. PÁGINA DE PSICOLOGÍA
// -----------------------------------------------------------------------------
$psicologia_content = '<!-- wp:html -->
<p class="cv-lead">Atención psicológica sanitaria orientada al bienestar emocional, la resolución de conflictos y el crecimiento personal. Intervención individual para niños, adolescentes y adultos en nuestras clínicas de Plasencia y Navaconcejo, así como modalidad online.</p>

<div class="cv-clean-grid">
    <article class="cv-clean-card">
        <div>
            <h3>Psicología Infantil y Juvenil</h3>
            <p>Espacio terapéutico para que niños y adolescentes aprendan a comprender y regular sus emociones, afrontar problemas de conducta, dificultades de adaptación, miedos, timidez y rendimiento escolar, con coordinación familiar continua.</p>
        </div>
    </article>

    <article class="cv-clean-card">
        <div>
            <h3>Psicología de Adultos</h3>
            <p>Psicoterapia en dificultades como ansiedad, ataques de pánico, estrés persistente, depresión, baja autoestima, problemas de relación y acompañamiento en situaciones de duelo o cambios vitales significativos.</p>
        </div>
    </article>

    <article class="cv-clean-card">
        <div>
            <h3>Terapia Familiar y Relacional</h3>
            <p>Acompañamiento a madres, padres y familias en pautas de crianza positiva, resolución de dinámicas familiares complejas y mejora de la comunicación en el hogar.</p>
        </div>
    </article>

    <article class="cv-clean-card">
        <div>
            <h3>Psicología Online</h3>
            <p>Sesiones psicoterapéuticas a distancia a través de plataforma segura con JESSICA SERRANO, ideales para personas con incompatibilidad horaria, desplazamientos o que prefieran la comodidad de su hogar.</p>
        </div>
    </article>
</div>

<h3>Equipo de psicólogas</h3>
<ul>
    <li><strong>JESSICA SERRANO:</strong> Psicología de adultos, trauma, abordaje con EMDR, ansiedad, estrés y consulta online.</li>
    <li><strong>ANDREA MONTERO:</strong> Psicoterapia individual, gestión emocional y apoyo familiar en Plasencia y Navaconcejo.</li>
    <li><strong>BELÉN MESA:</strong> Psicología sanitaria infantil y juvenil en Plasencia.</li>
</ul>

<p>No necesitas llegar con un diagnóstico previo. En el primer contacto te orientaremos sobre la profesional más adecuada para tu motivo de consulta.</p>
<p><strong>Teléfono de citas:</strong> <a href="tel:+34611169264"><strong>611 16 92 64</strong></a>.</p>
<p><a class="cv-button" href="/contacto/">Solicitar primera cita de psicología ↗</a></p>
<!-- /wp:html -->';
cv10_update_page('psicologia', 'Psicología en Plasencia y Navaconcejo', $psicologia_content, 'Psicología sanitaria en Plasencia, Navaconcejo y Online. Terapia para niños, adolescentes y adultos. Jessica Serrano, Andrea Montero y Belén Mesa. Cita: 611 16 92 64.');

// -----------------------------------------------------------------------------
// 7. PORTADA (INICIO) CON ENLACES CLICABLES, TEXTOS DE LOGOPEDIA Y NOMBRES EN MAYÚSCULAS
// -----------------------------------------------------------------------------
$home_content = '<!-- wp:html -->
<section class="cv-welcome" aria-labelledby="cv-welcome-title">
    <div class="cv-welcome-inner">
        <div class="cv-welcome-copy">
            <img class="cv-welcome-logo" src="/wp-content/themes/clinica-vocal/assets/logo-negro-transparente.png" width="960" height="956" alt="Clínica Vocal · Cristina Iglesias">
            <h1 id="cv-welcome-title"><span>Un espacio para</span> <span>sentir, sanar y</span> <em>avanzar.</em></h1>
            <p class="cv-welcome-services"><a href="/logopedia/" class="cv-service-gradient">Logopedia</a> <span class="cv-service-sep" aria-hidden="true">·</span> <a href="/psicologia/" class="cv-service-gradient">Psicología</a></p>
        </div>
        <figure class="cv-welcome-art">
            <img src="/wp-content/themes/clinica-vocal/assets/local-acuarela-v2.png" width="1536" height="1024" alt="Ilustración en acuarela de la entrada a Clínica Vocal en Plasencia">
        </figure>
    </div>
</section>

<section class="cv-services-seo">
    <div class="cv-wrap">
        <div class="cv-services-header">
            <h2>Especialidades Clínicas: Logopedia y Psicología Sanitaria</h2>
        </div>

        <div class="cv-services-grid">
            <!-- Bloque Logopedia -->
            <article class="cv-service-card">
                <div class="cv-service-card-top">
                    <h3>Logopedia Integral</h3>
                    <div class="cv-service-lead-meta">
                        <span>CRISTINA IGLESIAS</span> · <span>Plasencia y Navaconcejo</span>
                    </div>
                </div>
                <div class="cv-service-specialties">
                    <div class="cv-specialty-item">
                        <h4>Motricidad Orofacial</h4>
                        <p>Evaluación y tratamiento de las estructuras y funciones de la boca y la cara —como la respiración, la masticación, la deglución, la succión y el habla— para favorecer un desarrollo orofacial equilibrado.</p>
                    </div>
                    <div class="cv-specialty-item">
                        <h4>Logopedia Neonatal y Apoyo a la Alimentación</h4>
                        <p>Acompañamiento especializado a recién nacidos y sus familias para favorecer una alimentación segura y eficaz, tanto mediante lactancia materna como biberón (succión, agarre, coordinación, postura y dificultades en tomas).</p>
                    </div>
                    <div class="cv-specialty-item">
                        <h4>Voz y Rehabilitación Vocal</h4>
                        <p>Intervención en disfonías funcionales y orgánicas (nódulos, pólipos). Técnica y educación vocal para docentes, opositores y cantantes.</p>
                    </div>
                    <div class="cv-specialty-item">
                        <h4>Lenguaje, Habla y Comunicación</h4>
                        <p>Atención temprana en dificultades del habla y articulación, dislalias, retrasos del lenguaje, TEL/TDL y dislexia en etapa escolar.</p>
                    </div>
                </div>
                <a class="cv-service-card-btn" href="/logopedia/">Consulta de Logopedia</a>
            </article>

            <!-- Bloque Psicología -->
            <article class="cv-service-card">
                <div class="cv-service-card-top">
                    <h3>Psicología Sanitaria</h3>
                    <div class="cv-service-lead-meta">
                        <span>JESSICA SERRANO, ANDREA MONTERO y BELÉN MESA</span> · <span>Plasencia, Navaconcejo y Online</span>
                    </div>
                </div>
                <div class="cv-service-specialties">
                    <div class="cv-specialty-item">
                        <h4>Psicología Infantil y Juvenil</h4>
                        <p>Acompañamiento en regulación emocional, dificultades de conducta, adaptación escolar, habilidades sociales y autoestima.</p>
                    </div>
                    <div class="cv-specialty-item">
                        <h4>Psicología de Adultos</h4>
                        <p>Psicoterapia en procesos de ansiedad, estrés crónico, estados de ánimo depresivos, duelo y gestión de crisis personales.</p>
                    </div>
                    <div class="cv-specialty-item">
                        <h4>Terapia Relacional y Familiar</h4>
                        <p>Espacio seguro de diálogo y pautas para familias, fortaleciendo vínculos afectivos y resolución de conflictos.</p>
                    </div>
                    <div class="cv-specialty-item">
                        <h4>Atención Presencial y Online</h4>
                        <p>Consultas en nuestras dos clínicas físicas y modalidad de videoconsulta online con JESSICA SERRANO.</p>
                    </div>
                </div>
                <a class="cv-service-card-btn" href="/psicologia/">Consulta de Psicología</a>
            </article>
        </div>
    </div>
</section>

<section class="cv-home-short">
    <div class="cv-wrap">
        <div class="cv-title-semicurve-wrap">
            <h2 class="cv-title-semicurve">Elige tu centro en el norte de Extremadura</h2>
        </div>
        <div class="cv-clean-grid">
            <!-- Cuadro 1: Equipo Sanitario -->
            <div class="cv-box-container">
                <div class="cv-box-header">
                    <span class="cv-box-tag">Equipo Clínico</span>
                    <h3>Especialistas en Logopedia y Psicología Sanitaria</h3>
                </div>
                <div class="cv-inner-grid cv-team-inner-grid">
                    <a href="/equipo/cristina-iglesias-martin/" class="cv-inner-card" aria-label="Ver perfil de Cristina Iglesias">
                        <strong>CRISTINA IGLESIAS</strong>
                        <span>Dirección Clínica &amp; Logopedia Integral</span>
                    </a>
                    <a href="/equipo/jessica-serrano-diaz/" class="cv-inner-card" aria-label="Ver perfil de Jessica Serrano">
                        <strong>JESSICA SERRANO</strong>
                        <span>Psicología General Sanitaria &amp; Online</span>
                    </a>
                    <a href="/equipo/andrea-montero-regadera/" class="cv-inner-card" aria-label="Ver perfil de Andrea Montero">
                        <strong>ANDREA MONTERO</strong>
                        <span>Psicología Clínica (Plasencia y Navaconcejo)</span>
                    </a>
                    <a href="/equipo/belen-mesa-montero/" class="cv-inner-card" aria-label="Ver perfil de Belén Mesa">
                        <strong>BELÉN MESA</strong>
                        <span>Psicología Sanitaria &amp; Infanto-Juvenil</span>
                    </a>
                </div>
                <a class="cv-soft-btn" href="/equipo/">Conoce al equipo profesional</a>
            </div>

            <!-- Cuadro 2: Centros de Atención -->
            <div class="cv-box-container">
                <div class="cv-box-header">
                    <span class="cv-box-tag">Nuestras Clínicas</span>
                    <h3>Centros de Atención en Plasencia y Navaconcejo</h3>
                </div>
                <div class="cv-inner-grid cv-centers-inner-grid">
                    <a href="/centros/plasencia/" class="cv-inner-card" aria-label="Ver información de Clínica Plasencia">
                        <strong>Clínica Plasencia</strong>
                        <span>Calle Sierra de Tormantos, 22 · 10600 Plasencia</span>
                        <small>Consulta integral de Logopedia y Psicología</small>
                    </a>
                    <a href="/centros/navaconcejo/" class="cv-inner-card" aria-label="Ver información de Clínica Navaconcejo">
                        <strong>Clínica Navaconcejo</strong>
                        <span>Avenida de Extremadura, 117 · 10613 Navaconcejo</span>
                        <small>Atención de cercanía en el Valle del Jerte</small>
                    </a>
                </div>
                <a class="cv-soft-btn" href="/centros/">Ver información de nuestras clínicas</a>
            </div>
        </div>
    </div>
</section>
<!-- /wp:html -->';
cv10_update_page('inicio', 'Clínica Vocal', $home_content, 'Clínica Vocal Cristina Iglesias. Motricidad orofacial, logopedia neonatal y psicología en Plasencia y Navaconcejo. Cita previa: 611 16 92 64.');

echo "Todas las páginas han sido actualizadas con la Décima Revisión.\n";
