<?php
/**
 * Clínica Vocal · Rediseño Claude (septiembre 2026)
 * ---------------------------------------------------------------
 * Aplica el nuevo maquetado a 8 páginas SIN cambiar títulos, slugs ni URLs:
 *   28 Cristina · 29 Jessica · 30 Andrea · 31 Belén · 7 Logopedia · 6 Psicología · 15 Contacto · 48 Blog
 *
 * Uso (desde la carpeta ClinicaVocal):
 *   php -c runtime\php.ini actualizar_rediseno_claude.php            -> aplica cambios (con copia de seguridad previa)
 *   php -c runtime\php.ini actualizar_rediseno_claude.php --dry-run  -> solo comprueba, no escribe nada
 *   php -c runtime\php.ini actualizar_rediseno_claude.php --rollback=backups\rediseno-claude-AAAAMMDD-HHMMSS
 *
 * Requiere: theme/rediseno-claude.css enlazado (functions.php) y 'blog' añadido en page.php.
 */
if (php_sapi_name() !== 'cli') exit("Solo CLI\n");
define('WP_USE_THEMES', false);
require_once __DIR__ . '/wordpress/wp-load.php';

// Las páginas llevan SVG inline: sin esto WordPress (kses) borra los iconos al guardar.
kses_remove_filters();

$args = array_slice($argv, 1);
$dry = in_array('--dry-run', $args, true);
$rollback = null;
foreach ($args as $a) { if (strpos($a, '--rollback=') === 0) $rollback = substr($a, 11); }

$pages = [
    28 => [
        'slug'   => 'cristina-iglesias-martin',
        'checks' => ['EX06-0262', '611 16 92 64', 'Sierra de Tormantos, 16, Local 3', 'Avda. de Extremadura, 117'],
        'html'   => <<<'CVHTML'
<!-- wp:html -->
<div class="cvx cvx-profile">
    <nav class="cvx-crumbs" aria-label="Ruta de navegación"><a href="/">Inicio</a><span class="cvx-crumbs-sep" aria-hidden="true">/</span><a href="/equipo/">Equipo</a><span class="cvx-crumbs-sep" aria-hidden="true">/</span><span aria-current="page">Cristina Iglesias</span></nav>
    <header class="cvx-phero">
        <div class="cvx-phero-aside" aria-hidden="true">
            <div class="cvx-monogram"><span>CI</span></div>
        </div>
        <div class="cvx-phero-main">
            <div class="cvx-badges">
                <span class="cvx-badge">Logopedia Clínica &amp; Dirección</span>
                <span class="cvx-badge cvx-badge--col"><svg class="cvx-i" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 3 5 6v5.5c0 4.2 3 7.6 7 9.5 4-1.9 7-5.3 7-9.5V6l-7-3Z"/><path d="m9 12 2 2 4-4"/></svg>Col. Nº EX06-0262</span>
            </div>
            <h1 class="cvx-name">CRISTINA IGLESIAS</h1>
            <p class="cvx-role">Logopeda · Responsable Sanitaria de Clínica Vocal · Sedes: Plasencia y Navaconcejo</p>
            <p class="cvx-bio">Cristina Iglesias es la responsable sanitaria de Clínica Vocal y especialista en logopedia integral, colegiada Nº EX06-0262 en el Colegio Profesional de Logopedas de Extremadura. Su labor asistencial está especializada en la valoración exhaustiva, diagnóstico e intervención en motricidad orofacial (respiración oral, SAOS, ATM, masticación, deglución disfuncional, disfagia y frenillo lingual alterado), logopedia neonatal y apoyo a la alimentación en recién nacidos, así como en la rehabilitación de patologías de la voz, el habla y el lenguaje en el norte de Extremadura.</p>
            <div class="cvx-actions"><a class="cvx-btn cvx-btn--wa" href="https://wa.me/34611169264?text=Hola%20Cristina,%20me%20gustar%C3%ADa%20consultar%20sobre%20Logopedia%20en%20Cl%C3%ADnica%20Vocal" target="_blank" rel="noopener noreferrer"><svg class="cvx-i" width="19" height="19" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M17.472 14.382c-.301-.15-1.78-.879-2.056-.98-.276-.1-.477-.15-.678.15-.2.301-.778.98-.954 1.18-.175.2-.351.226-.652.075-.301-.15-1.27-.468-2.42-1.493-.895-.798-1.5-1.784-1.676-2.085-.175-.301-.019-.464.132-.614.135-.135.301-.351.451-.527.151-.175.201-.301.301-.502.1-.2.05-.376-.025-.526-.075-.15-.678-1.634-.929-2.238-.244-.588-.493-.509-.678-.518-.175-.009-.376-.011-.577-.011s-.527.075-.803.376c-.276.301-1.054 1.029-1.054 2.509 0 1.48 1.079 2.909 1.229 3.11.151.2 2.124 3.243 5.146 4.549.719.311 1.281.497 1.719.636.723.23 1.381.197 1.902.119.58-.087 1.78-.727 2.031-1.43.251-.703.251-1.305.176-1.43-.075-.125-.276-.201-.577-.351z"/><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 1.826.49 3.538 1.343 5.008L2.1 21.9a.75.75 0 0 0 .914.914l4.892-1.243A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.5a8.47 8.47 0 0 1-4.34-1.19.75.75 0 0 0-.583-.073l-3.327.846.846-3.327a.75.75 0 0 0-.073-.583A8.47 8.47 0 0 1 3.5 12c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5-3.806 8.5-8.5 8.5z"/></svg><span>Contactar con esta profesional</span></a><a class="cvx-btn cvx-btn--outline" href="/contacto/"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="3.5" y="5" width="17" height="15" rx="2"/><path d="M3.5 9.5h17M8 3v4M16 3v4"/><path d="M8 13.5h3v3H8z"/></svg><span>Pedir Cita Previa ↗</span></a></div>
        </div>
    </header>
    <div class="cvx-pgrid">
<article class="cvx-panel ">
    <header class="cvx-panel-head"><span class="cvx-ico-badge"><svg class="cvx-i" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M2 9.5 12 5l10 4.5-10 4.5L2 9.5Z"/><path d="M6 11.3V16c0 1.4 2.7 3 6 3s6-1.6 6-3v-4.7"/><path d="M22 9.5v5"/></svg></span><h2>Formación y Acreditación Sanitaria Oficial</h2></header>
    <ul class="cvx-checks"><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span>Grado Universitario Oficial en Logopedia.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span>Colegiada Oficial Nº EX06-0262 en el Colegio Profesional de Logopedas de Extremadura (CPLex).</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span>Especialización clínica avanzada en Motricidad Orofacial y Terapia Miofuncional.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span>Especialización en Logopedia Neonatal y apoyo a la alimentación (lactancia materna y biberón).</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span>Especialización en Rehabilitación y Técnica Vocal para profesionales de la voz (docentes, cantantes, opositores).</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span>Atención Temprana, Trastornos del Desarrollo del Lenguaje (TDL/TEL), lectoescritura y aprendizaje escolar.</span></li></ul>
</article>
<article class="cvx-panel cvx-panel--areas">
    <header class="cvx-panel-head"><span class="cvx-ico-badge"><svg class="cvx-i" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 3v5a4 4 0 0 0 8 0V3"/><path d="M4 3h2M12 3h2"/><path d="M9 12v2.5a5 5 0 0 0 10 0V13"/><circle cx="19" cy="11" r="2"/></svg></span><h2>Áreas de Intervención Clínica</h2></header>
    <div class="cvx-areas-list">
        <div class="cvx-area"><h3>Motricidad orofacial</h3><p>Evaluación y tratamiento de las estructuras y funciones de la boca y la cara —como la respiración oral, SAOS (apnea del sueño), disfunción de ATM, masticación, deglución disfuncional, disfagia, frenillo lingual alterado y el habla— para favorecer un desarrollo orofacial equilibrado.</p></div>
        <div class="cvx-area"><h3>Logopedia neonatal y apoyo a la alimentación</h3><p>Acompañamiento especializado a recién nacidos y sus familias para favorecer una alimentación segura y eficaz (lactancia materna y biberón). Valoración de succión, agarre, coordinación succión-respiración-deglución, postura y resolución de dificultades en las tomas.</p></div>
        <div class="cvx-area"><h3>Terapia y rehabilitación vocal</h3><p>Disfonías funcionales y orgánicas (nódulos, pólipos, fatiga vocal, edema de Reinke) y reeducación vocal.</p></div>
        <div class="cvx-area"><h3>Habla y lenguaje</h3><p>Dislalias (rotacismo, sigmatismo), retrasos del lenguaje, TDL/TEL y dislexia en etapa escolar.</p></div>
    </div>
</article></div>
    
    <section class="cvx-band" aria-label="Consultas y Disponibilidad">
        <div class="cvx-band-text">
            <span class="cvx-band-ico"><svg class="cvx-i" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 21s-7-6.2-7-11.5A7 7 0 0 1 19 9.5C19 14.8 12 21 12 21Z"/><circle cx="12" cy="9.5" r="2.5"/></svg></span>
            <div>
                <h2>Consultas y Disponibilidad</h2>
                <p>Atención presencial individualizada con cita concertada en nuestras dos sedes de <strong>Plasencia</strong> (C/ Sierra de Tormantos, 16, Local 3) y <strong>Navaconcejo</strong> (Avda. de Extremadura, 117).</p>
            </div>
        </div>
        <div class="cvx-band-actions"><a class="cvx-btn cvx-btn--light" href="tel:+34611169264"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 4h3.5l1.7 4.2-2.2 1.4a11 11 0 0 0 6.4 6.4l1.4-2.2L20 15.5V19a1.5 1.5 0 0 1-1.6 1.5C10.6 20 4 13.4 3.5 5.6A1.5 1.5 0 0 1 5 4Z"/></svg><span>Llamar al 611 16 92 64</span></a></div>
    </section>
</div>
<!-- /wp:html -->
CVHTML
    ],
    29 => [
        'slug'   => 'jessica-serrano-diaz',
        'checks' => ['EX02166', '672 33 77 31', 'jessicaserranopsicologia.com', 'jserranopsicologia@gmail.com'],
        'html'   => <<<'CVHTML'
<!-- wp:html -->
<div class="cvx cvx-profile">
    <nav class="cvx-crumbs" aria-label="Ruta de navegación"><a href="/">Inicio</a><span class="cvx-crumbs-sep" aria-hidden="true">/</span><a href="/equipo/">Equipo</a><span class="cvx-crumbs-sep" aria-hidden="true">/</span><span aria-current="page">Jessica Serrano</span></nav>
    <header class="cvx-phero">
        <div class="cvx-phero-aside" aria-hidden="true">
            <div class="cvx-monogram"><span>JS</span></div>
        </div>
        <div class="cvx-phero-main">
            <div class="cvx-badges">
                <span class="cvx-badge">Psicología Sanitaria · EMDR · Apego y Trauma</span>
                <span class="cvx-badge cvx-badge--col"><svg class="cvx-i" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 3 5 6v5.5c0 4.2 3 7.6 7 9.5 4-1.9 7-5.3 7-9.5V6l-7-3Z"/><path d="m9 12 2 2 4-4"/></svg>Col. Nº EX02166</span>
            </div>
            <h1 class="cvx-name">JESSICA SERRANO</h1>
            <p class="cvx-role">Psicóloga General Sanitaria · Terapeuta EMDR Acreditada · Consulta en Plasencia y Terapia Online</p>
            <p class="cvx-bio">Jessica Serrano es psicóloga general sanitaria colegiada Nº EX02166 por el Colegio Oficial de Psicología de Extremadura, con consulta física en Plasencia (en Clínica Vocal, Calle Sierra de Tormantos, Nº 16, Local 3) y atención telemática online. Su ejercicio clínico se orienta desde una perspectiva integradora (terapia cognitivo-conductual, terapia de tercera generación, terapia sistémica-relacional y abordaje centrado en trauma y apego a través de terapias como EMDR e IFS). Acompaña tanto a adultos como a niños, adolescentes y familias de forma individualizada, cercana y adaptada a las necesidades de cada persona.</p>
            <div class="cvx-actions"><a class="cvx-btn cvx-btn--wa" href="https://wa.me/34672337731?text=Hola%20Jessica,%20me%20gustar%C3%ADa%20solicitar%20informaci%C3%B3n%20sobre%20una%20consulta%20de%20psicolog%C3%ADa." target="_blank" rel="noopener noreferrer"><svg class="cvx-i" width="19" height="19" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M17.472 14.382c-.301-.15-1.78-.879-2.056-.98-.276-.1-.477-.15-.678.15-.2.301-.778.98-.954 1.18-.175.2-.351.226-.652.075-.301-.15-1.27-.468-2.42-1.493-.895-.798-1.5-1.784-1.676-2.085-.175-.301-.019-.464.132-.614.135-.135.301-.351.451-.527.151-.175.201-.301.301-.502.1-.2.05-.376-.025-.526-.075-.15-.678-1.634-.929-2.238-.244-.588-.493-.509-.678-.518-.175-.009-.376-.011-.577-.011s-.527.075-.803.376c-.276.301-1.054 1.029-1.054 2.509 0 1.48 1.079 2.909 1.229 3.11.151.2 2.124 3.243 5.146 4.549.719.311 1.281.497 1.719.636.723.23 1.381.197 1.902.119.58-.087 1.78-.727 2.031-1.43.251-.703.251-1.305.176-1.43-.075-.125-.276-.201-.577-.351z"/><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 1.826.49 3.538 1.343 5.008L2.1 21.9a.75.75 0 0 0 .914.914l4.892-1.243A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.5a8.47 8.47 0 0 1-4.34-1.19.75.75 0 0 0-.583-.073l-3.327.846.846-3.327a.75.75 0 0 0-.073-.583A8.47 8.47 0 0 1 3.5 12c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5-3.806 8.5-8.5 8.5z"/></svg><span>Contactar por WhatsApp (672 33 77 31)</span></a><a class="cvx-btn cvx-btn--outline" href="https://www.jessicaserranopsicologia.com" target="_blank" rel="noopener noreferrer"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/></svg><span>Web Oficial: jessicaserranopsicologia.com ↗</span></a><a class="cvx-btn cvx-btn--outline" href="/contacto/"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="3.5" y="5" width="17" height="15" rx="2"/><path d="M3.5 9.5h17M8 3v4M16 3v4"/><path d="M8 13.5h3v3H8z"/></svg><span>Pedir Cita Previa ↗</span></a></div>
        </div>
    </header>
    <div class="cvx-pgrid">
<article class="cvx-panel ">
    <header class="cvx-panel-head"><span class="cvx-ico-badge"><svg class="cvx-i" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M2 9.5 12 5l10 4.5-10 4.5L2 9.5Z"/><path d="M6 11.3V16c0 1.4 2.7 3 6 3s6-1.6 6-3v-4.7"/><path d="M22 9.5v5"/></svg></span><h2>Titulación Universitaria y Formación Sanitaria Oficial</h2></header>
    <div class="cvx-sub"><h3>Titulaciones Universitarias y Posgrados Oficiales</h3><ul class="cvx-checks"><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Licenciatura en Psicología:</strong> Universidad de Huelva y Universidad Complutense de Madrid.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Máster en Psicología General Sanitaria:</strong> Universitat Autònoma de Barcelona (UAB). Habilitación sanitaria oficial.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Colegiada Oficial Nº EX02166:</strong> Ilustre Colegio Oficial de Psicología de Extremadura (COPEX).</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Máster en Atención Temprana:</strong> Fundación San Pablo CEU Andalucía.</span></li></ul></div><div class="cvx-sub"><h3>Especialización en Trauma, Apego y Terapia EMDR</h3><ul class="cvx-checks"><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Acreditación Nivel I y II en Terapia EMDR Adultos:</strong> Asociación EMDR España.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Acreditación Nivel I y II en Terapia EMDR Niños y Adolescentes:</strong> Asociación EMDR España.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Abordaje del Trastorno por Estrés Postraumático (TEPT):</strong> Por Anabel González · Instituto Imaya.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Evaluando la Disociación:</strong> Por Anabel González · Instituto Imaya.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Apego y Regulación:</strong> Por Cristina Cortés · Vitaliza.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Evaluación y Reparación del Apego en Psicoterapia:</strong> Enfoque integrador · Escuela Eva Molero.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Psicoterapia Integradora para el Tratamiento del Trauma:</strong> Escuela Eva Molero.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Curso Práctico de Intervención en Trauma:</strong> Un refugio para psicólogas.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Desastre, Trauma y Recuperación:</strong> Colegio Oficial de la Psicología de Madrid.</span></li></ul></div><div class="cvx-sub"><h3>Psicoterapia Infantojuvenil y Técnicas Proyectivas</h3><ul class="cvx-checks"><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Acreditación Clínica Instrumento Diagnóstico ADOS-2:</strong> Detección y diagnóstico de TEA por la Dra. Amaia Hervás · Instituto IGAIN.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Intervención con Juego en Psicoterapia Infantojuvenil:</strong> Por Elena Piñeiro · Clínica Cabal.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Sanando a Través del Juego (Trauma Infantil):</strong> Por Elena Piñeiro.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Técnica de la Caja de Arena (Sandplay, Nivel II):</strong> Por José Luis Gonzalo Marrodán.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Intervención con Playmobil en Consulta:</strong> Por Helena Alvarado.</span></li></ul></div><div class="cvx-sub"><h3>Intervención Clínica Específica</h3><ul class="cvx-checks"><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Formación El Método Atlas:</strong> Perspectiva integradora con técnicas, herramientas y recursos para diversos trastornos · Por Ana Gómez.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Psicoterapia Integradora para el Tratamiento de la Ansiedad:</strong> Escuela Eva Molero.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Tratamiento Psicológico del Duelo en Psicoterapia:</strong> Por María José Pubill · Centre Grat.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Abordaje de la Dependencia Emocional:</strong> Perspectiva integradora · Escuela Eva Molero.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Abordaje Psicológico de Trastornos Alimentarios (TCA):</strong> Por Laura Albó.</span></li></ul></div>
</article>
<article class="cvx-panel cvx-panel--areas">
    <header class="cvx-panel-head"><span class="cvx-ico-badge"><svg class="cvx-i" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 3v5a4 4 0 0 0 8 0V3"/><path d="M4 3h2M12 3h2"/><path d="M9 12v2.5a5 5 0 0 0 10 0V13"/><circle cx="19" cy="11" r="2"/></svg></span><h2>Áreas de Intervención y Acompañamiento Clínico</h2></header>
    <div class="cvx-sub"><h3>Psicología en Adultos</h3><p class="cvx-sub-intro">Acompañamiento individualizado orientado al bienestar emocional y a la superación de bloqueos y heridas emocionales:</p><ul class="cvx-checks"><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Estrés y ansiedad:</strong> Manejo de la sobreactivación, crisis de angustia, agorafobia y síntomas psicosomáticos.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Depresión y bajo estado de ánimo:</strong> Trabajo en la pérdida de interés, tristeza profunda, apatía y revitalización personal.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Trauma, apego y heridas emocionales:</strong> Reprocesamiento neurobiológico de experiencias difíciles mediante EMDR y trabajo con partes (IFS).</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Dificultades de gestión emocional:</strong> Comprensión, tolerancia al malestar y autorregulación de emociones intensas.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Conflictos interpersonales:</strong> Dificultades relacionales en el ámbito laboral, de pareja o familiar.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Duelo y pérdidas significativas:</strong> Acompañamiento en el dolor por fallecimiento, separaciones o pérdidas vitales.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Crisis vitales:</strong> Procesos de cambio vital, transiciones importantes y búsqueda de sentido.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Problemas de autoestima:</strong> Abordaje de la autocrítica destructiva, autoexigencia y construcción de una autovaloración saludable.</span></li></ul></div><div class="cvx-sub"><h3>Psicología Infanto-Juvenil y Familias</h3><p class="cvx-sub-intro">Intervención temprana, respetuosa y adaptada al momento evolutivo de niños y adolescentes, involucrando a la familia:</p><ul class="cvx-checks"><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Trastornos del Neurodesarrollo:</strong> Evaluación clínica acreditada con ADOS-2 en TEA, intervención en TDAH y discapacidad intelectual.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Dificultades de gestión emocional:</strong> Ayudar a los menores a identificar, nombrar y canalizar sus estados emocionales.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Problemas de conducta:</strong> Rabietas desbordantes, impulsividad, agresividad y establecimiento de pautas y límites claros.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Miedos y fobias:</strong> Miedos nocturnos, fobias específicas, ansiedad de separación y timidez excesiva.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Relaciones y habilidades sociales:</strong> Conflictos entre iguales, aislamiento social y fomento de la asertividad.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Ansiedad y bajo estado de ánimo en infancia y adolescencia.</strong></span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Trauma y apego infantil:</strong> Sanación de vivencias adversas mediante caja de arena, juego y técnicas proyectivas.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Problemas de autoestima y autoimagen en la adolescencia.</strong></span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span><strong>Pautas y atención a las familias:</strong> Acompañamiento integral a padres y madres en los desafíos de la crianza.</span></li></ul></div>
</article></div>
    
    <aside class="cvx-webbox">
        <span class="cvx-ico-badge"><svg class="cvx-i" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/></svg></span>
        <div class="cvx-webbox-text">
            <h2>Consulta Oficial de Jessica Serrano</h2>
            <p>Puedes conocer en detalle sus publicaciones, artículos del blog y filosofía terapéutica visitando su página web oficial:<br><a href="https://www.jessicaserranopsicologia.com" target="_blank" rel="noopener noreferrer">www.jessicaserranopsicologia.com ↗</a></p>
        </div>
        <a class="cvx-btn cvx-btn--dark" href="https://www.jessicaserranopsicologia.com" target="_blank" rel="noopener noreferrer"><span>Visitar Web Oficial ↗</span></a>
    </aside>
    <section class="cvx-band" aria-label="Consultas, Sedes y Contacto Directo">
        <div class="cvx-band-text">
            <span class="cvx-band-ico"><svg class="cvx-i" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 21s-7-6.2-7-11.5A7 7 0 0 1 19 9.5C19 14.8 12 21 12 21Z"/><circle cx="12" cy="9.5" r="2.5"/></svg></span>
            <div>
                <h2>Consultas, Sedes y Contacto Directo</h2>
                <p>Atención presencial en <strong>Plasencia</strong>: Calle Sierra de Tormantos, Nº 16, Local 3 (Clínica Vocal).<br>Modalidad <strong>Online</strong> mediante videollamada confidencial para toda España.<br><strong>Horario de consulta:</strong> Lunes a jueves de 10:00 a 14:00 y de 16:00 a 20:00 (cita concertada).</p>
            </div>
        </div>
        <div class="cvx-band-actions"><a class="cvx-btn cvx-btn--light" href="tel:+34672337731"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 4h3.5l1.7 4.2-2.2 1.4a11 11 0 0 0 6.4 6.4l1.4-2.2L20 15.5V19a1.5 1.5 0 0 1-1.6 1.5C10.6 20 4 13.4 3.5 5.6A1.5 1.5 0 0 1 5 4Z"/></svg><span>Tel: 672 33 77 31</span></a><a class="cvx-btn cvx-btn--ghost" href="mailto:jserranopsicologia@gmail.com"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="3" y="5.5" width="18" height="13" rx="2"/><path d="m3.5 7 8.5 6 8.5-6"/></svg><span>jserranopsicologia@gmail.com</span></a></div>
    </section>
</div>
<!-- /wp:html -->
CVHTML
    ],
    30 => [
        'slug'   => 'andrea-montero-regadera',
        'checks' => ['EX02475', '611 16 92 64'],
        'html'   => <<<'CVHTML'
<!-- wp:html -->
<div class="cvx cvx-profile">
    <nav class="cvx-crumbs" aria-label="Ruta de navegación"><a href="/">Inicio</a><span class="cvx-crumbs-sep" aria-hidden="true">/</span><a href="/equipo/">Equipo</a><span class="cvx-crumbs-sep" aria-hidden="true">/</span><span aria-current="page">Andrea Montero</span></nav>
    <header class="cvx-phero">
        <div class="cvx-phero-aside" aria-hidden="true">
            <div class="cvx-monogram"><span>AM</span></div>
        </div>
        <div class="cvx-phero-main">
            <div class="cvx-badges">
                <span class="cvx-badge">Psicología Sanitaria · Adultos, Infancia y Maternidad</span>
                <span class="cvx-badge cvx-badge--col"><svg class="cvx-i" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 3 5 6v5.5c0 4.2 3 7.6 7 9.5 4-1.9 7-5.3 7-9.5V6l-7-3Z"/><path d="m9 12 2 2 4-4"/></svg>Col. Nº EX02475</span>
            </div>
            <h1 class="cvx-name">ANDREA MONTERO</h1>
            <p class="cvx-role">Psicóloga General Sanitaria · Sedes: Plasencia y Navaconcejo (Valle del Jerte)</p>
            <p class="cvx-bio">Andrea Montero ejerce como psicóloga general sanitaria colegiada Nº EX02475 en ambas sedes de Clínica Vocal (Plasencia y Navaconcejo). Su ejercicio clínico proporciona un espacio terapéutico cercano, seguro y confidencial, enfocado en el bienestar psicológico y el conocimiento y gestión de las emociones tanto en la etapa adulta (ansiedad, depresión, estrés, burnout, duelo, trauma y salud mental perinatal en gestación y maternidad) como en la infancia y adolescencia.</p>
            <div class="cvx-actions"><a class="cvx-btn cvx-btn--wa" href="https://wa.me/34611169264?text=Hola%20Andrea,%20me%20gustar%C3%ADa%20consultar%20sobre%20Psicolog%C3%ADa%20en%20Cl%C3%ADnica%20Vocal" target="_blank" rel="noopener noreferrer"><svg class="cvx-i" width="19" height="19" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M17.472 14.382c-.301-.15-1.78-.879-2.056-.98-.276-.1-.477-.15-.678.15-.2.301-.778.98-.954 1.18-.175.2-.351.226-.652.075-.301-.15-1.27-.468-2.42-1.493-.895-.798-1.5-1.784-1.676-2.085-.175-.301-.019-.464.132-.614.135-.135.301-.351.451-.527.151-.175.201-.301.301-.502.1-.2.05-.376-.025-.526-.075-.15-.678-1.634-.929-2.238-.244-.588-.493-.509-.678-.518-.175-.009-.376-.011-.577-.011s-.527.075-.803.376c-.276.301-1.054 1.029-1.054 2.509 0 1.48 1.079 2.909 1.229 3.11.151.2 2.124 3.243 5.146 4.549.719.311 1.281.497 1.719.636.723.23 1.381.197 1.902.119.58-.087 1.78-.727 2.031-1.43.251-.703.251-1.305.176-1.43-.075-.125-.276-.201-.577-.351z"/><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 1.826.49 3.538 1.343 5.008L2.1 21.9a.75.75 0 0 0 .914.914l4.892-1.243A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.5a8.47 8.47 0 0 1-4.34-1.19.75.75 0 0 0-.583-.073l-3.327.846.846-3.327a.75.75 0 0 0-.073-.583A8.47 8.47 0 0 1 3.5 12c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5-3.806 8.5-8.5 8.5z"/></svg><span>Contactar con esta profesional</span></a><a class="cvx-btn cvx-btn--outline" href="/contacto/"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="3.5" y="5" width="17" height="15" rx="2"/><path d="M3.5 9.5h17M8 3v4M16 3v4"/><path d="M8 13.5h3v3H8z"/></svg><span>Pedir Cita Previa ↗</span></a></div>
        </div>
    </header>
    <div class="cvx-pgrid">
<article class="cvx-panel ">
    <header class="cvx-panel-head"><span class="cvx-ico-badge"><svg class="cvx-i" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M2 9.5 12 5l10 4.5-10 4.5L2 9.5Z"/><path d="M6 11.3V16c0 1.4 2.7 3 6 3s6-1.6 6-3v-4.7"/><path d="M22 9.5v5"/></svg></span><h2>Formación y Acreditación Sanitaria Oficial</h2></header>
    <ul class="cvx-checks"><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span>Grado Universitario Oficial en Psicología.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span>Máster Universitario en Psicología General Sanitaria (habilitación sanitaria oficial).</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span>Colegiada Nº EX02475 en el Colegio Oficial de Psicología de Extremadura.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span>Formación clínica en psicoterapia individual en adultos, trauma y procesos de pérdida y duelo.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span>Intervención socioemocional en infancia y adolescencia, habilidades sociales y regulación de conducta.</span></li></ul>
</article>
<article class="cvx-panel cvx-panel--areas">
    <header class="cvx-panel-head"><span class="cvx-ico-badge"><svg class="cvx-i" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 3v5a4 4 0 0 0 8 0V3"/><path d="M4 3h2M12 3h2"/><path d="M9 12v2.5a5 5 0 0 0 10 0V13"/><circle cx="19" cy="11" r="2"/></svg></span><h2>Áreas de Intervención Clínica</h2></header>
    <div class="cvx-areas-list">
        <div class="cvx-area"><h3>Psicología en adultos</h3><ul class="cvx-dots">
            <li>Ansiedad y dificultades para gestionar las emociones.</li>
            <li>Depresión y bajo estado de ánimo.</li>
            <li>Estrés y burnout (agotamiento laboral y personal).</li>
            <li>Duelo y procesos de pérdida significativa.</li>
            <li>Trauma y experiencias difíciles.</li>
            <li>Gestación y cambios emocionales asociados al embarazo y la maternidad.</li>
        </ul></div>
        <div class="cvx-area"><h3>Psicología infantil y juvenil</h3><ul class="cvx-dots">
            <li>Autoestima y autoconcepto.</li>
            <li>Habilidades sociales y relaciones interpersonales.</li>
            <li>Problemas de conducta y gestión emocional.</li>
            <li>Miedos y fobias.</li>
            <li>Dificultades emocionales y adaptación a diferentes situaciones.</li>
        </ul></div>
        <div class="cvx-area"><h3>Acompañamiento emocional</h3><p>Trabajamos el conocimiento y la gestión de las emociones, proporcionando herramientas para afrontar diferentes situaciones vitales y favorecer el bienestar psicológico.</p></div>
    </div>
</article></div>
    
    <section class="cvx-band" aria-label="Consultas y Disponibilidad">
        <div class="cvx-band-text">
            <span class="cvx-band-ico"><svg class="cvx-i" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 21s-7-6.2-7-11.5A7 7 0 0 1 19 9.5C19 14.8 12 21 12 21Z"/><circle cx="12" cy="9.5" r="2.5"/></svg></span>
            <div>
                <h2>Consultas y Disponibilidad</h2>
                <p>Atención presencial en <strong>Clínica Plasencia</strong> y <strong>Clínica Navaconcejo</strong>. Consulta disponibilidad de agenda para concertar tu cita en la sede más cercana.</p>
            </div>
        </div>
        <div class="cvx-band-actions"><a class="cvx-btn cvx-btn--light" href="tel:+34611169264"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 4h3.5l1.7 4.2-2.2 1.4a11 11 0 0 0 6.4 6.4l1.4-2.2L20 15.5V19a1.5 1.5 0 0 1-1.6 1.5C10.6 20 4 13.4 3.5 5.6A1.5 1.5 0 0 1 5 4Z"/></svg><span>Llamar al 611 16 92 64</span></a></div>
    </section>
</div>
<!-- /wp:html -->
CVHTML
    ],
    31 => [
        'slug'   => 'belen-mesa-montero',
        'checks' => ['EX 02006', '611 16 92 64', 'Sierra de Tormantos, 16, Local 3'],
        'html'   => <<<'CVHTML'
<!-- wp:html -->
<div class="cvx cvx-profile">
    <nav class="cvx-crumbs" aria-label="Ruta de navegación"><a href="/">Inicio</a><span class="cvx-crumbs-sep" aria-hidden="true">/</span><a href="/equipo/">Equipo</a><span class="cvx-crumbs-sep" aria-hidden="true">/</span><span aria-current="page">Belén Mesa</span></nav>
    <header class="cvx-phero">
        <div class="cvx-phero-aside" aria-hidden="true">
            <div class="cvx-monogram"><span>BM</span></div>
        </div>
        <div class="cvx-phero-main">
            <div class="cvx-badges">
                <span class="cvx-badge">Psicología Sanitaria · Infancia, Adolescencia y Neurodesarrollo</span>
                <span class="cvx-badge cvx-badge--col"><svg class="cvx-i" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 3 5 6v5.5c0 4.2 3 7.6 7 9.5 4-1.9 7-5.3 7-9.5V6l-7-3Z"/><path d="m9 12 2 2 4-4"/></svg>Col. Nº EX 02006</span>
            </div>
            <h1 class="cvx-name">BELÉN MESA</h1>
            <p class="cvx-role">Psicóloga Sanitaria · Especialista en Infancia, Adolescencia y Familias · Sede: Plasencia</p>
            <p class="cvx-bio">Belén Mesa es psicóloga general sanitaria colegiada Nº EX 02006 en Clínica Vocal (Plasencia). Su ejercicio terapéutico está dedicado a la infancia, la adolescencia y el apoyo continuo a las familias. Ofrece un espacio cercano y adaptado a cada etapa madurativa para abordar el bienestar emocional, la conducta y autorregulación, las dificultades del neurodesarrollo (TDAH, TEA), las habilidades sociales y el acompañamiento en situaciones vitales complejas.</p>
            <div class="cvx-actions"><a class="cvx-btn cvx-btn--wa" href="https://wa.me/34611169264?text=Hola%20Bel%C3%A9n,%20me%20gustar%C3%ADa%20consultar%20sobre%20Psicolog%C3%ADa%20Infantil%20en%20Cl%C3%ADnica%20Vocal" target="_blank" rel="noopener noreferrer"><svg class="cvx-i" width="19" height="19" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M17.472 14.382c-.301-.15-1.78-.879-2.056-.98-.276-.1-.477-.15-.678.15-.2.301-.778.98-.954 1.18-.175.2-.351.226-.652.075-.301-.15-1.27-.468-2.42-1.493-.895-.798-1.5-1.784-1.676-2.085-.175-.301-.019-.464.132-.614.135-.135.301-.351.451-.527.151-.175.201-.301.301-.502.1-.2.05-.376-.025-.526-.075-.15-.678-1.634-.929-2.238-.244-.588-.493-.509-.678-.518-.175-.009-.376-.011-.577-.011s-.527.075-.803.376c-.276.301-1.054 1.029-1.054 2.509 0 1.48 1.079 2.909 1.229 3.11.151.2 2.124 3.243 5.146 4.549.719.311 1.281.497 1.719.636.723.23 1.381.197 1.902.119.58-.087 1.78-.727 2.031-1.43.251-.703.251-1.305.176-1.43-.075-.125-.276-.201-.577-.351z"/><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 1.826.49 3.538 1.343 5.008L2.1 21.9a.75.75 0 0 0 .914.914l4.892-1.243A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.5a8.47 8.47 0 0 1-4.34-1.19.75.75 0 0 0-.583-.073l-3.327.846.846-3.327a.75.75 0 0 0-.073-.583A8.47 8.47 0 0 1 3.5 12c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5-3.806 8.5-8.5 8.5z"/></svg><span>Contactar con esta profesional</span></a><a class="cvx-btn cvx-btn--outline" href="/contacto/"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="3.5" y="5" width="17" height="15" rx="2"/><path d="M3.5 9.5h17M8 3v4M16 3v4"/><path d="M8 13.5h3v3H8z"/></svg><span>Pedir Cita Previa ↗</span></a></div>
        </div>
    </header>
    <div class="cvx-pgrid">
<article class="cvx-panel ">
    <header class="cvx-panel-head"><span class="cvx-ico-badge"><svg class="cvx-i" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M2 9.5 12 5l10 4.5-10 4.5L2 9.5Z"/><path d="M6 11.3V16c0 1.4 2.7 3 6 3s6-1.6 6-3v-4.7"/><path d="M22 9.5v5"/></svg></span><h2>Formación y Acreditación Sanitaria Oficial</h2></header>
    <ul class="cvx-checks"><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span>Grado Universitario Oficial en Psicología.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span>Máster Universitario en Psicología General Sanitaria (habilitación sanitaria oficial).</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span>Colegiada Oficial Nº EX 02006 en el Colegio Oficial de Psicología de Extremadura.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span>Especialización en Neurodesarrollo infantil, TDAH, TEA y funciones ejecutivas.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span>Formación avanzada en conducta, autorregulación y apego seguro infanto-juvenil.</span></li><li><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg><span>Orientación psicoeducativa familiar y acompañamiento en situaciones vitales complejas.</span></li></ul>
</article>
<article class="cvx-panel cvx-panel--areas">
    <header class="cvx-panel-head"><span class="cvx-ico-badge"><svg class="cvx-i" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 3v5a4 4 0 0 0 8 0V3"/><path d="M4 3h2M12 3h2"/><path d="M9 12v2.5a5 5 0 0 0 10 0V13"/><circle cx="19" cy="11" r="2"/></svg></span><h2>Áreas de Intervención Clínica</h2></header>
    <div class="cvx-areas-list">
        <div class="cvx-area"><h3>Bienestar emocional</h3><p>Ansiedad, miedos, tristeza, autoestima, inseguridad y gestión emocional.</p></div>
        <div class="cvx-area"><h3>Conducta y autorregulación</h3><p>Rabietas, impulsividad, agresividad, frustración y conductas desafiantes.</p></div>
        <div class="cvx-area"><h3>Neurodesarrollo y aprendizaje</h3><p>TDAH, TEA, dificultades de aprendizaje, atención y funciones ejecutivas.</p></div>
        <div class="cvx-area"><h3>Relaciones y habilidades sociales</h3><p>Dificultades con iguales, conflictos, comunicación y habilidades sociales.</p></div>
        <div class="cvx-area"><h3>Adolescencia</h3><p>Autoestima, identidad, relaciones, ansiedad, estado de ánimo y dificultades familiares o escolares.</p></div>
        <div class="cvx-area"><h3>Situaciones vitales</h3><p>Duelo, separaciones, cambios familiares, adaptación y otras situaciones que puedan generar malestar.</p></div>
    </div>
</article></div>
    
    <section class="cvx-band" aria-label="Consultas y Disponibilidad">
        <div class="cvx-band-text">
            <span class="cvx-band-ico"><svg class="cvx-i" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 21s-7-6.2-7-11.5A7 7 0 0 1 19 9.5C19 14.8 12 21 12 21Z"/><circle cx="12" cy="9.5" r="2.5"/></svg></span>
            <div>
                <h2>Consultas y Disponibilidad</h2>
                <p>Consultas individualizadas en <strong>Clínica Plasencia</strong> (C/ Sierra de Tormantos, 16, Local 3), en gabinetes acondicionados y adaptados para la infancia, la adolescencia y las familias.</p>
            </div>
        </div>
        <div class="cvx-band-actions"><a class="cvx-btn cvx-btn--light" href="tel:+34611169264"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 4h3.5l1.7 4.2-2.2 1.4a11 11 0 0 0 6.4 6.4l1.4-2.2L20 15.5V19a1.5 1.5 0 0 1-1.6 1.5C10.6 20 4 13.4 3.5 5.6A1.5 1.5 0 0 1 5 4Z"/></svg><span>Llamar al 611 16 92 64</span></a></div>
    </section>
</div>
<!-- /wp:html -->
CVHTML
    ],
    7 => [
        'slug'   => 'logopedia',
        'checks' => ['EX06-0262', '611 16 92 64', 'Sierra de Tormantos, 16, Local 3', 'Avda. Extremadura, 117'],
        'html'   => <<<'CVHTML'
<!-- wp:html -->
<div class="cvx cvx-spec cvx-spec--logo">
    <nav class="cvx-crumbs" aria-label="Ruta de navegación"><a href="/">Inicio</a><span class="cvx-crumbs-sep" aria-hidden="true">/</span><span>Especialidades</span><span class="cvx-crumbs-sep" aria-hidden="true">/</span><span aria-current="page">Logopedia</span></nav>
    <header class="cvx-shero">
        <div class="cvx-shero-text">
            <span class="cvx-eyebrow"><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M3 12h1.5M6.5 8.5v7M10 5v14M13.5 8v8M17 10v4M20.5 12H21"/></svg> Especialidad sanitaria · Logopedia Integral</span>
            <h1 class="cvx-title">Logopedia en Plasencia y Navaconcejo</h1>
            <p class="cvx-lead">Servicio sanitario de evaluación, diagnóstico y tratamiento especializado en motricidad orofacial, logopedia neonatal y apoyo a la alimentación, patología vocal, deglución, habla y lectoescritura en Plasencia y Navaconcejo, dirigido por la logopeda CRISTINA IGLESIAS (Col. Nº EX06-0262).</p>
            <div class="cvx-actions">
                <a class="cvx-btn cvx-btn--dark" href="/contacto/"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="3.5" y="5" width="17" height="15" rx="2"/><path d="M3.5 9.5h17M8 3v4M16 3v4"/><path d="M8 13.5h3v3H8z"/></svg><span>Solicitar primera cita de logopedia ↗</span></a>
                <a class="cvx-btn cvx-btn--outline" href="tel:+34611169264"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 4h3.5l1.7 4.2-2.2 1.4a11 11 0 0 0 6.4 6.4l1.4-2.2L20 15.5V19a1.5 1.5 0 0 1-1.6 1.5C10.6 20 4 13.4 3.5 5.6A1.5 1.5 0 0 1 5 4Z"/></svg><span>611 16 92 64</span></a>
            </div>
        </div>
        <aside class="cvx-factcard" aria-label="Datos de la consulta de logopedia">
            <dl>
                <div><dt><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="12" cy="8" r="3.5"/><path d="M5 20c.8-3.6 3.6-5.5 7-5.5s6.2 1.9 7 5.5"/></svg>Profesional responsable</dt><dd><a href="/equipo/cristina-iglesias-martin/">CRISTINA IGLESIAS</a> (Logopeda Colegiada Nº EX06-0262).</dd></div>
                <div><dt><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 21s-7-6.2-7-11.5A7 7 0 0 1 19 9.5C19 14.8 12 21 12 21Z"/><circle cx="12" cy="9.5" r="2.5"/></svg>Clínicas disponibles</dt><dd>Plasencia (C/ Sierra de Tormantos, 16, Local 3) y Navaconcejo (Avda. Extremadura, 117).</dd></div>
                <div><dt><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 4h3.5l1.7 4.2-2.2 1.4a11 11 0 0 0 6.4 6.4l1.4-2.2L20 15.5V19a1.5 1.5 0 0 1-1.6 1.5C10.6 20 4 13.4 3.5 5.6A1.5 1.5 0 0 1 5 4Z"/></svg>Teléfono de cita previa</dt><dd><a class="cvx-strong-link" href="tel:+34611169264">611 16 92 64</a>.</dd></div>
            </dl>
        </aside>
    </header>

    <section class="cvx-areas" aria-labelledby="cvx-areas-logo">
        <div class="cvx-sec-head">
            <span class="cvx-eyebrow">Áreas de intervención</span>
            <h2 id="cvx-areas-logo">Especialidades de logopedia clínica</h2>
        </div>
        <div class="cvx-mods">
            
        <article class="cvx-mod">
            <div class="cvx-mod-top"><span class="cvx-ico-badge"><svg class="cvx-i" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M9 3.5c-3 .6-5 3.3-5 6.8 0 2.2.7 3.7 1.8 5V20h7v-2.5h2.2c.9 0 1.5-.7 1.5-1.5v-2l1.6-.6c.5-.2.6-.7.3-1.1L17 10.5C16.6 6.2 13.5 3 9 3.5Z"/><path d="M13.3 13.2h2"/></svg></span><span class="cvx-mod-num">01</span></div>
            <h3>Motricidad Orofacial</h3>
            <p>Evaluación y tratamiento de las estructuras y funciones de la boca y la cara —como la respiración oral, SAOS, ATM, masticación, deglución disfuncional, disfagia, frenillo lingual alterado y el habla— para favorecer un desarrollo orofacial equilibrado.</p>
        </article>
            
        <article class="cvx-mod">
            <div class="cvx-mod-top"><span class="cvx-ico-badge"><svg class="cvx-i" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M9 3h6M10 3v2.2c-1.8.6-3 2.3-3 4.3V19a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9.5c0-2-1.2-3.7-3-4.3V3"/><path d="M7 12.5h10M7 16h10"/></svg></span><span class="cvx-mod-num">02</span></div>
            <h3>Logopedia Neonatal y Apoyo a la Alimentación</h3>
            <p>Acompañamiento especializado a recién nacidos y sus familias para favorecer una alimentación segura y eficaz, tanto mediante lactancia materna como biberón. Se valoran aspectos como la succión, el agarre, la coordinación entre succión, respiración y deglución, la postura y las posibles dificultades durante las tomas.</p><p>El objetivo es ofrecer apoyo individualizado, resolver dudas y ayudar a que la alimentación del bebé sea una experiencia más tranquila, cómoda y satisfactoria para toda la familia.</p>
        </article>
            
        <article class="cvx-mod">
            <div class="cvx-mod-top"><span class="cvx-ico-badge"><svg class="cvx-i" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M3 12h1.5M6.5 8.5v7M10 5v14M13.5 8v8M17 10v4M20.5 12H21"/></svg></span><span class="cvx-mod-num">03</span></div>
            <h3>Terapia y Rehabilitación de la Voz</h3>
            <p>Tratamiento de disfonías funcionales y patológicas (nódulos, pólipos, edema de Reinke, parálisis cordales, fatiga vocal). Entrenamiento vocal y pautas de técnica e higiene vocal para profesionales de la voz hablada o cantada (docentes, cantantes, actores, opositores).</p>
        </article>
            
        <article class="cvx-mod">
            <div class="cvx-mod-top"><span class="cvx-ico-badge"><svg class="cvx-i" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 6.5c-2-1.6-4.9-2-8-1.5v13c3.1-.5 6 0 8 1.5 2-1.5 4.9-2 8-1.5V5c-3.1-.5-6-.1-8 1.5Z"/><path d="M12 6.5V19.5"/></svg></span><span class="cvx-mod-num">04</span></div>
            <h3>Habla, Lenguaje y Lectoescritura</h3>
            <p>Intervención clínica en dificultades del habla y articulación, dislalias (rotacismo, sigmatismo), deglución atípica, retraso del desarrollo del lenguaje (TEL/TDL) y dificultades en la adquisición de la lectura, escritura y dislexia en edad escolar.</p>
        </article>
        </div>
    </section>

    <section class="cvx-visit">
        <div class="cvx-visit-head">
            <span class="cvx-eyebrow">Primera visita</span>
            <h2>Cómo se organiza tu primera visita de logopedia</h2>
        </div>
        <div class="cvx-visit-body">
            <p>En la primera consulta realizamos una entrevista clínica y una valoración inicial de las dificultades comunicativas, orofaciales o funcionales para plantear un plan de tratamiento individualizado adaptado a tus objetivos y necesidades cotidianas.</p>
        </div>
    </section>
    
    <section class="cvx-cta">
        <div class="cvx-cta-text">
            <span class="cvx-eyebrow cvx-eyebrow--light">Cita previa</span>
            <h2>Solicitar primera cita de logopedia</h2>
            <p>Atención con cita concertada en Plasencia y Navaconcejo.</p>
        </div>
        <div class="cvx-cta-actions">
            <a class="cvx-btn cvx-btn--light" href="/contacto/"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="3.5" y="5" width="17" height="15" rx="2"/><path d="M3.5 9.5h17M8 3v4M16 3v4"/><path d="M8 13.5h3v3H8z"/></svg><span>Solicitar primera cita ↗</span></a>
            <a class="cvx-btn cvx-btn--wa" href="https://wa.me/34611169264?text=Hola,%20me%20gustar%C3%ADa%20solicitar%20informaci%C3%B3n%20o%20cita%20previa%20de%20Logopedia" target="_blank" rel="noopener noreferrer"><svg class="cvx-i" width="19" height="19" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M17.472 14.382c-.301-.15-1.78-.879-2.056-.98-.276-.1-.477-.15-.678.15-.2.301-.778.98-.954 1.18-.175.2-.351.226-.652.075-.301-.15-1.27-.468-2.42-1.493-.895-.798-1.5-1.784-1.676-2.085-.175-.301-.019-.464.132-.614.135-.135.301-.351.451-.527.151-.175.201-.301.301-.502.1-.2.05-.376-.025-.526-.075-.15-.678-1.634-.929-2.238-.244-.588-.493-.509-.678-.518-.175-.009-.376-.011-.577-.011s-.527.075-.803.376c-.276.301-1.054 1.029-1.054 2.509 0 1.48 1.079 2.909 1.229 3.11.151.2 2.124 3.243 5.146 4.549.719.311 1.281.497 1.719.636.723.23 1.381.197 1.902.119.58-.087 1.78-.727 2.031-1.43.251-.703.251-1.305.176-1.43-.075-.125-.276-.201-.577-.351z"/><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 1.826.49 3.538 1.343 5.008L2.1 21.9a.75.75 0 0 0 .914.914l4.892-1.243A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.5a8.47 8.47 0 0 1-4.34-1.19.75.75 0 0 0-.583-.073l-3.327.846.846-3.327a.75.75 0 0 0-.073-.583A8.47 8.47 0 0 1 3.5 12c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5-3.806 8.5-8.5 8.5z"/></svg><span>Consultar por WhatsApp</span></a>
            <a class="cvx-cta-phone" href="tel:+34611169264"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 4h3.5l1.7 4.2-2.2 1.4a11 11 0 0 0 6.4 6.4l1.4-2.2L20 15.5V19a1.5 1.5 0 0 1-1.6 1.5C10.6 20 4 13.4 3.5 5.6A1.5 1.5 0 0 1 5 4Z"/></svg><span>611 16 92 64</span></a>
        </div>
    </section>
</div>
<!-- /wp:html -->
CVHTML
    ],
    6 => [
        'slug'   => 'psicologia',
        'checks' => ['EX02166', 'EX02475', 'EX 02006', '611 16 92 64'],
        'html'   => <<<'CVHTML'
<!-- wp:html -->
<div class="cvx cvx-spec cvx-spec--psi">
    <nav class="cvx-crumbs" aria-label="Ruta de navegación"><a href="/">Inicio</a><span class="cvx-crumbs-sep" aria-hidden="true">/</span><span>Especialidades</span><span class="cvx-crumbs-sep" aria-hidden="true">/</span><span aria-current="page">Psicología</span></nav>
    <header class="cvx-shero">
        <div class="cvx-shero-text">
            <span class="cvx-eyebrow"><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 20.5s-7.5-4.4-7.5-10A4.5 4.5 0 0 1 12 7.2a4.5 4.5 0 0 1 7.5 3.3c0 5.6-7.5 10-7.5 10Z"/><path d="M8.5 12h2l1-2 1.5 4 1-2h1.5"/></svg> Especialidad sanitaria · Psicología General Sanitaria</span>
            <h1 class="cvx-title">Psicología en Plasencia y Navaconcejo</h1>
            <p class="cvx-lead">Atención psicológica sanitaria orientada al bienestar emocional, la resolución de conflictos y el crecimiento personal. Intervención individual para niños, adolescentes y adultos en nuestras clínicas de Plasencia y Navaconcejo, así como modalidad online.</p>
            <div class="cvx-actions">
                <a class="cvx-btn cvx-btn--dark" href="/contacto/"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="3.5" y="5" width="17" height="15" rx="2"/><path d="M3.5 9.5h17M8 3v4M16 3v4"/><path d="M8 13.5h3v3H8z"/></svg><span>Solicitar primera cita de psicología ↗</span></a>
                <a class="cvx-btn cvx-btn--outline" href="tel:+34611169264"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 4h3.5l1.7 4.2-2.2 1.4a11 11 0 0 0 6.4 6.4l1.4-2.2L20 15.5V19a1.5 1.5 0 0 1-1.6 1.5C10.6 20 4 13.4 3.5 5.6A1.5 1.5 0 0 1 5 4Z"/></svg><span>611 16 92 64</span></a>
            </div>
        </div>
        <aside class="cvx-factcard" aria-label="Orientación para la primera cita de psicología">
            <p class="cvx-factcard-quote">No necesitas llegar con un diagnóstico previo. En el primer contacto te orientaremos sobre la profesional más adecuada para tu motivo de consulta.</p>
            <dl>
                <div><dt><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 4h3.5l1.7 4.2-2.2 1.4a11 11 0 0 0 6.4 6.4l1.4-2.2L20 15.5V19a1.5 1.5 0 0 1-1.6 1.5C10.6 20 4 13.4 3.5 5.6A1.5 1.5 0 0 1 5 4Z"/></svg>Teléfono de citas</dt><dd><a class="cvx-strong-link" href="tel:+34611169264">611 16 92 64</a>.</dd></div>
            </dl>
        </aside>
    </header>

    <section class="cvx-areas" aria-labelledby="cvx-areas-psi">
        <div class="cvx-sec-head">
            <span class="cvx-eyebrow">Áreas de intervención</span>
            <h2 id="cvx-areas-psi">Especialidades de psicología sanitaria</h2>
        </div>
        <div class="cvx-mods">
            
        <article class="cvx-mod">
            <div class="cvx-mod-top"><span class="cvx-ico-badge"><svg class="cvx-i" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 20.5s-7.5-4.4-7.5-10A4.5 4.5 0 0 1 12 7.2a4.5 4.5 0 0 1 7.5 3.3c0 5.6-7.5 10-7.5 10Z"/><path d="M8.5 12h2l1-2 1.5 4 1-2h1.5"/></svg></span><span class="cvx-mod-num">01</span></div>
            <h3>Psicología en Adultos</h3>
            <p>Psicoterapia individual en ansiedad y dificultades de gestión emocional, estados depresivos y bajo estado de ánimo, estrés y burnout, procesos de pérdida y duelo, trauma y experiencias difíciles (con abordaje integrador y EMDR), así como gestación y cambios emocionales en embarazo y maternidad.</p>
        </article>
            
        <article class="cvx-mod">
            <div class="cvx-mod-top"><span class="cvx-ico-badge"><svg class="cvx-i" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="8" cy="6.5" r="2.3"/><circle cx="16.5" cy="9" r="1.8"/><path d="M4.5 20v-3.5A3.5 3.5 0 0 1 8 13a3.5 3.5 0 0 1 3.5 3.5V20"/><path d="M13.5 20v-2.8a3 3 0 0 1 6 0V20"/></svg></span><span class="cvx-mod-num">02</span></div>
            <h3>Psicología Infantil y Juvenil</h3>
            <p>Espacio adaptado para fortalecer la autoestima y el autoconcepto, habilidades sociales y relaciones con iguales, abordaje de problemas de conducta y autorregulación (rabietas, impulsividad, frustración), miedos, fobias y adaptación a diferentes situaciones madurativas.</p>
        </article>
            
        <article class="cvx-mod">
            <div class="cvx-mod-top"><span class="cvx-ico-badge"><svg class="cvx-i" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 8h3a2 2 0 1 1 4 0h3v3a2 2 0 1 1 0 4v3h-3a2 2 0 1 0-4 0H5v-3a2 2 0 1 0 0-4V8Z"/></svg></span><span class="cvx-mod-num">03</span></div>
            <h3>Neurodesarrollo y Aprendizaje</h3>
            <p>Evaluación e intervención especializada en TDAH, TEA, dificultades de aprendizaje, atención y funciones ejecutivas, con estrecha orientación psicoeducativa a familias y coordinación con centros escolares.</p>
        </article>
            
        <article class="cvx-mod">
            <div class="cvx-mod-top"><span class="cvx-ico-badge"><svg class="cvx-i" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 19c0-8 5.5-13.5 14-14-0.3 8.5-6 14-14 14Z"/><path d="M5 19 13 11"/></svg></span><span class="cvx-mod-num">04</span></div>
            <h3>Adolescencia, Situaciones Vitales y Acompañamiento Emocional</h3>
            <p>Acompañamiento en autoestima, identidad y relaciones durante la adolescencia. Herramientas y apoyo en situaciones vitales complejas como duelo, separaciones, cambios familiares y adaptación para favorecer el bienestar psicológico.</p>
        </article>
        </div>
    </section>

    <section class="cvx-team" aria-labelledby="cvx-team-psi">
        <div class="cvx-sec-head">
            <span class="cvx-eyebrow">Equipo profesional</span>
            <h2 id="cvx-team-psi">Equipo de psicólogas de Clínica Vocal</h2>
        </div>
        <div class="cvx-people">
            
            <article class="cvx-person">
                <span class="cvx-person-col"><svg class="cvx-i" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 3 5 6v5.5c0 4.2 3 7.6 7 9.5 4-1.9 7-5.3 7-9.5V6l-7-3Z"/><path d="m9 12 2 2 4-4"/></svg>Col. Nº EX02166</span>
                <h3><a href="/equipo/jessica-serrano-diaz/">JESSICA SERRANO</a></h3>
                <p>Psicóloga General Sanitaria (Col. Nº EX02166). Psicoterapia integradora en adultos, infancia y adolescencia, EMDR, apego, trauma y duelo en Plasencia y Online. Web oficial: <a href="https://www.jessicaserranopsicologia.com" target="_blank" rel="noopener noreferrer">jessicaserranopsicologia.com ↗</a></p>
                <a class="cvx-link" href="/equipo/jessica-serrano-diaz/"><span>Ver perfil completo</span><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
            </article>
            
            <article class="cvx-person">
                <span class="cvx-person-col"><svg class="cvx-i" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 3 5 6v5.5c0 4.2 3 7.6 7 9.5 4-1.9 7-5.3 7-9.5V6l-7-3Z"/><path d="m9 12 2 2 4-4"/></svg>Col. Nº EX02475</span>
                <h3><a href="/equipo/andrea-montero-regadera/">ANDREA MONTERO</a></h3>
                <p>Psicóloga General Sanitaria (Col. Nº EX02475). Psicología en adultos (burnout, duelo, gestación y maternidad), psicología infantil y juvenil, y acompañamiento emocional en Plasencia y Navaconcejo.</p>
                <a class="cvx-link" href="/equipo/andrea-montero-regadera/"><span>Ver perfil completo</span><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
            </article>
            
            <article class="cvx-person">
                <span class="cvx-person-col"><svg class="cvx-i" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 3 5 6v5.5c0 4.2 3 7.6 7 9.5 4-1.9 7-5.3 7-9.5V6l-7-3Z"/><path d="m9 12 2 2 4-4"/></svg>Col. Nº EX 02006</span>
                <h3><a href="/equipo/belen-mesa-montero/">BELÉN MESA</a></h3>
                <p>Psicóloga General Sanitaria (Col. Nº EX 02006). Bienestar emocional, conducta y autorregulación, neurodesarrollo (TDAH, TEA), habilidades sociales y adolescencia en Plasencia.</p>
                <a class="cvx-link" href="/equipo/belen-mesa-montero/"><span>Ver perfil completo</span><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
            </article>
        </div>
    </section>
    
    <section class="cvx-cta">
        <div class="cvx-cta-text">
            <span class="cvx-eyebrow cvx-eyebrow--light">Cita previa</span>
            <h2>Solicitar primera cita de psicología</h2>
            <p>Atención presencial en Plasencia y Navaconcejo, y modalidad online.</p>
        </div>
        <div class="cvx-cta-actions">
            <a class="cvx-btn cvx-btn--light" href="/contacto/"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="3.5" y="5" width="17" height="15" rx="2"/><path d="M3.5 9.5h17M8 3v4M16 3v4"/><path d="M8 13.5h3v3H8z"/></svg><span>Solicitar primera cita ↗</span></a>
            <a class="cvx-btn cvx-btn--wa" href="https://wa.me/34611169264?text=Hola,%20me%20gustar%C3%ADa%20solicitar%20informaci%C3%B3n%20o%20cita%20previa%20de%20Psicolog%C3%ADa" target="_blank" rel="noopener noreferrer"><svg class="cvx-i" width="19" height="19" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M17.472 14.382c-.301-.15-1.78-.879-2.056-.98-.276-.1-.477-.15-.678.15-.2.301-.778.98-.954 1.18-.175.2-.351.226-.652.075-.301-.15-1.27-.468-2.42-1.493-.895-.798-1.5-1.784-1.676-2.085-.175-.301-.019-.464.132-.614.135-.135.301-.351.451-.527.151-.175.201-.301.301-.502.1-.2.05-.376-.025-.526-.075-.15-.678-1.634-.929-2.238-.244-.588-.493-.509-.678-.518-.175-.009-.376-.011-.577-.011s-.527.075-.803.376c-.276.301-1.054 1.029-1.054 2.509 0 1.48 1.079 2.909 1.229 3.11.151.2 2.124 3.243 5.146 4.549.719.311 1.281.497 1.719.636.723.23 1.381.197 1.902.119.58-.087 1.78-.727 2.031-1.43.251-.703.251-1.305.176-1.43-.075-.125-.276-.201-.577-.351z"/><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 1.826.49 3.538 1.343 5.008L2.1 21.9a.75.75 0 0 0 .914.914l4.892-1.243A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.5a8.47 8.47 0 0 1-4.34-1.19.75.75 0 0 0-.583-.073l-3.327.846.846-3.327a.75.75 0 0 0-.073-.583A8.47 8.47 0 0 1 3.5 12c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5-3.806 8.5-8.5 8.5z"/></svg><span>Consultar por WhatsApp</span></a>
            <a class="cvx-cta-phone" href="tel:+34611169264"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 4h3.5l1.7 4.2-2.2 1.4a11 11 0 0 0 6.4 6.4l1.4-2.2L20 15.5V19a1.5 1.5 0 0 1-1.6 1.5C10.6 20 4 13.4 3.5 5.6A1.5 1.5 0 0 1 5 4Z"/></svg><span>611 16 92 64</span></a>
        </div>
    </section>
</div>
<!-- /wp:html -->
CVHTML
    ],
    15 => [
        'slug'   => 'contacto',
        'checks' => ['611 16 92 64', 'Calle Sierra de Tormantos, 16, Local 3', 'Avenida de Extremadura, 117', '[cv_contact]', 'map-plasencia', 'map-navaconcejo'],
        'html'   => <<<'CVHTML'
<!-- wp:html -->
<div class="cvx cvx-contact">
    <header class="cvx-chero">
        <div class="cvx-chero-text">
            <span class="cvx-eyebrow"><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="3.5" y="5" width="17" height="15" rx="2"/><path d="M3.5 9.5h17M8 3v4M16 3v4"/><path d="M8 13.5h3v3H8z"/></svg> Cita previa</span>
            <h1 class="cvx-title">Contacto y Cita Previa</h1>
            <p class="cvx-lead">Atención telefónica directa y consultas por WhatsApp para nuestras clínicas de Plasencia y Navaconcejo</p>
        </div>
        <div class="cvx-chero-panel">
            <a class="cvx-phone-big" href="tel:+34611169264" aria-label="Llamar por teléfono al 611 16 92 64">
                <span class="cvx-phone-ico"><svg class="cvx-i" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 4h3.5l1.7 4.2-2.2 1.4a11 11 0 0 0 6.4 6.4l1.4-2.2L20 15.5V19a1.5 1.5 0 0 1-1.6 1.5C10.6 20 4 13.4 3.5 5.6A1.5 1.5 0 0 1 5 4Z"/></svg></span>
                <span class="cvx-phone-txt"><small>Teléfono de cita previa</small><strong>611 16 92 64</strong></span>
            </a>
            <a aria-label="Consultar por WhatsApp" class="cvx-btn cvx-btn--wa cvx-btn--block" href="https://wa.me/34611169264?text=Hola,%20me%20gustar%C3%ADa%20solicitar%20informaci%C3%B3n%20o%20cita%20previa" target="_blank" rel="noopener noreferrer"><svg class="cvx-i" width="19" height="19" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M17.472 14.382c-.301-.15-1.78-.879-2.056-.98-.276-.1-.477-.15-.678.15-.2.301-.778.98-.954 1.18-.175.2-.351.226-.652.075-.301-.15-1.27-.468-2.42-1.493-.895-.798-1.5-1.784-1.676-2.085-.175-.301-.019-.464.132-.614.135-.135.301-.351.451-.527.151-.175.201-.301.301-.502.1-.2.05-.376-.025-.526-.075-.15-.678-1.634-.929-2.238-.244-.588-.493-.509-.678-.518-.175-.009-.376-.011-.577-.011s-.527.075-.803.376c-.276.301-1.054 1.029-1.054 2.509 0 1.48 1.079 2.909 1.229 3.11.151.2 2.124 3.243 5.146 4.549.719.311 1.281.497 1.719.636.723.23 1.381.197 1.902.119.58-.087 1.78-.727 2.031-1.43.251-.703.251-1.305.176-1.43-.075-.125-.276-.201-.577-.351z"/><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 1.826.49 3.538 1.343 5.008L2.1 21.9a.75.75 0 0 0 .914.914l4.892-1.243A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.5a8.47 8.47 0 0 1-4.34-1.19.75.75 0 0 0-.583-.073l-3.327.846.846-3.327a.75.75 0 0 0-.073-.583A8.47 8.47 0 0 1 3.5 12c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5-3.806 8.5-8.5 8.5z"/></svg><span>Consultar por WhatsApp</span></a>
            <p class="cvx-hours"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="8.5"/><path d="M12 7.5V12l3 2"/></svg><span><strong>Lunes a Viernes: 9:00 – 14:00 | 16:00 – 20:00</strong> · Atención personalizada con cita previa</span></p>
        </div>
    </header>

    <div class="cvx-contact-grid">
        <section class="cvx-sedes" aria-label="Nuestras clínicas">
            
        <article class="cvx-sede">
            <div class="cvx-sede-media">
                <a href="/centros/plasencia/" class="cvx-sede-photo" aria-label="Ver fotos de Clínica Plasencia">
                    <img src="/wp-content/themes/clinica-vocal/assets/local-plasencia.jpg" alt="Instalaciones y fachada de Clínica Vocal en Plasencia" loading="lazy" width="640" height="420">
                </a>
                <div class="cvx-sede-map">
                    <div id="map-plasencia" class="cv-map-canvas" role="region" aria-label="Mapa de ubicación Clínica Plasencia"></div>
                    <a href="https://www.google.com/maps?cid=4860632199104703204" target="_blank" rel="noopener noreferrer" class="cvx-map-badge" title="Abrir ubicación en Google Maps">Google Maps ↗</a>
                </div>
            </div>
            <div class="cvx-sede-body">
                <h2><a href="/centros/plasencia/">Clínica Plasencia</a></h2>
                <p class="cvx-sede-addr"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 21s-7-6.2-7-11.5A7 7 0 0 1 19 9.5C19 14.8 12 21 12 21Z"/><circle cx="12" cy="9.5" r="2.5"/></svg><span>Calle Sierra de Tormantos, 16, Local 3 · 10600 Plasencia (Cáceres)</span></p>
                <p class="cvx-sede-desc">Instalaciones y gabinetes para atención integral de Logopedia y Psicología.</p>
                <div class="cvx-sede-links">
                    <a class="cvx-link" href="https://www.google.com/maps?cid=4860632199104703204" target="_blank" rel="noopener noreferrer"><span>Cómo llegar</span><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M7 17 17 7M9 7h8v8"/></svg></a>
                    <a class="cvx-link" href="/centros/plasencia/"><span>Ver la clínica</span><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
                </div>
            </div>
        </article>
            
        <article class="cvx-sede">
            <div class="cvx-sede-media">
                <a href="/centros/navaconcejo/" class="cvx-sede-photo" aria-label="Ver fotos de Clínica Navaconcejo">
                    <img src="/wp-content/themes/clinica-vocal/assets/local-navaconcejo.jpg" alt="Instalaciones y fachada de Clínica Vocal en Navaconcejo" loading="lazy" width="640" height="420">
                </a>
                <div class="cvx-sede-map">
                    <div id="map-navaconcejo" class="cv-map-canvas" role="region" aria-label="Mapa de ubicación Clínica Navaconcejo"></div>
                    <a href="https://www.google.com/maps/search/?api=1&amp;query=Cl%C3%ADnica+Vocal+Av.+Extremadura+117+Navaconcejo" target="_blank" rel="noopener noreferrer" class="cvx-map-badge" title="Abrir ubicación en Google Maps">Google Maps ↗</a>
                </div>
            </div>
            <div class="cvx-sede-body">
                <h2><a href="/centros/navaconcejo/">Clínica Navaconcejo</a></h2>
                <p class="cvx-sede-addr"><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 21s-7-6.2-7-11.5A7 7 0 0 1 19 9.5C19 14.8 12 21 12 21Z"/><circle cx="12" cy="9.5" r="2.5"/></svg><span>Avenida de Extremadura, 117 · 10613 Navaconcejo (Cáceres)</span></p>
                <p class="cvx-sede-desc">Atención clínica cercana y accesible en el Valle del Jerte.</p>
                <div class="cvx-sede-links">
                    <a class="cvx-link" href="https://www.google.com/maps/search/?api=1&amp;query=Cl%C3%ADnica+Vocal+Av.+Extremadura+117+Navaconcejo" target="_blank" rel="noopener noreferrer"><span>Cómo llegar</span><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M7 17 17 7M9 7h8v8"/></svg></a>
                    <a class="cvx-link" href="/centros/navaconcejo/"><span>Ver la clínica</span><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
                </div>
            </div>
        </article>
        </section>

        <section class="cvx-formbox" aria-labelledby="cvx-form-title">
            <span class="cvx-eyebrow"><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="3" y="5.5" width="18" height="13" rx="2"/><path d="m3.5 7 8.5 6 8.5-6"/></svg> Formulario</span>
            <h2 id="cvx-form-title">Escribe tu consulta</h2>
            [cv_contact]
        </section>
    </div>
</div>
<!-- /wp:html -->
CVHTML
    ],
    48 => [
        'slug'   => 'blog',
        'checks' => ['Blog y Recursos Clínicos y Divulgativos', 'Próximamente'],
        'html'   => <<<'CVHTML'
<!-- wp:html -->
<div class="cvx cvx-blog">
    <header class="cvx-bhero">
        <span class="cvx-eyebrow"><svg class="cvx-i" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M20 4c-6 0-11 4-12.5 11L6 20"/><path d="M20 4c.5 6-3.5 10.5-9.5 11.5"/><path d="M9.5 12.5h4.5"/></svg> Divulgación sanitaria</span>
        <h1 class="cvx-title">Blog y Recursos Clínicos y Divulgativos</h1>
        <p class="cvx-lead">Espacio de divulgación sanitaria, prevención y pautas prácticas elaborado por el equipo de profesionales de Clínica Vocal.</p>
    </header>

    <section class="cvx-soon" aria-labelledby="cvx-soon-title">
        <div class="cvx-soon-mark" aria-hidden="true"><svg class="cvx-i" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M20 4c-6 0-11 4-12.5 11L6 20"/><path d="M20 4c.5 6-3.5 10.5-9.5 11.5"/><path d="M9.5 12.5h4.5"/></svg></div>
        <div class="cvx-soon-body">
            <span class="cvx-pill"><svg class="cvx-i" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="8.5"/><path d="M12 7.5V12l3 2"/></svg> Próximamente</span>
            <h2 id="cvx-soon-title">Contenidos clínicos en preparación</h2>
            <p>Nuestro equipo clínico está elaborando una serie de guías divulgativas, protocolos de intervención y pautas prácticas basadas en la evidencia sobre logopedia neonatal, motricidad orofacial, cuidado de la voz y salud emocional. Próximamente publicaremos los primeros artículos monográficos.</p>
        </div>
    </section>

    <section class="cvx-topics-wrap" aria-labelledby="cvx-topics-title">
        <div class="cvx-sec-head">
            <span class="cvx-eyebrow">Áreas temáticas</span>
            <h2 id="cvx-topics-title">Categorías de próxima publicación</h2>
        </div>
        <div class="cvx-topics">
            
            <article class="cvx-topic">
                <div class="cvx-topic-top"><span class="cvx-ico-badge"><svg class="cvx-i" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M3 12h1.5M6.5 8.5v7M10 5v14M13.5 8v8M17 10v4M20.5 12H21"/></svg></span><span class="cvx-status">En preparación</span></div>
                <h3>Logopedia Clínica</h3>
                <p>Motricidad orofacial, deglución, logopedia neonatal y apoyo a la alimentación, habla, lenguaje y lectoescritura.</p>
            </article>
            
            <article class="cvx-topic">
                <div class="cvx-topic-top"><span class="cvx-ico-badge"><svg class="cvx-i" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 20.5s-7.5-4.4-7.5-10A4.5 4.5 0 0 1 12 7.2a4.5 4.5 0 0 1 7.5 3.3c0 5.6-7.5 10-7.5 10Z"/><path d="M8.5 12h2l1-2 1.5 4 1-2h1.5"/></svg></span><span class="cvx-status">En preparación</span></div>
                <h3>Psicología Sanitaria</h3>
                <p>Gestión emocional, ansiedad, neurodesarrollo (TDAH, TEA) y salud mental perinatal en adultos, infancia y adolescencia.</p>
            </article>
            
            <article class="cvx-topic">
                <div class="cvx-topic-top"><span class="cvx-ico-badge"><svg class="cvx-i" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="7" cy="6" r="2.2"/><circle cx="17" cy="6" r="2.2"/><circle cx="12" cy="12" r="1.7"/><path d="M3.5 20v-5.5A3.5 3.5 0 0 1 7 11h0a3.5 3.5 0 0 1 3 1.7M20.5 20v-5.5A3.5 3.5 0 0 0 17 11h0a3.5 3.5 0 0 0-3 1.7M9.5 20v-2.2a2.5 2.5 0 0 1 5 0V20"/></svg></span><span class="cvx-status">En preparación</span></div>
                <h3>Pautas para Familias</h3>
                <p>Orientaciones prácticas para acompañar el desarrollo comunicativo, emocional y conductual en la infancia y la adolescencia.</p>
            </article>
            
            <article class="cvx-topic">
                <div class="cvx-topic-top"><span class="cvx-ico-badge"><svg class="cvx-i" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 3v4M12 17v4M3 12h4M17 12h4M5.6 5.6l2.8 2.8M15.6 15.6l2.8 2.8M5.6 18.4l2.8-2.8M15.6 8.4l2.8-2.8"/></svg></span><span class="cvx-status">En preparación</span></div>
                <h3>Salud Vocal</h3>
                <p>Higiene y cuidado de la voz, prevención de la fatiga vocal y pautas para docentes, cantantes y profesionales de la voz.</p>
            </article>
        </div>
    </section>

    <section class="cvx-note">
        <p><svg class="cvx-i" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 4h3.5l1.7 4.2-2.2 1.4a11 11 0 0 0 6.4 6.4l1.4-2.2L20 15.5V19a1.5 1.5 0 0 1-1.6 1.5C10.6 20 4 13.4 3.5 5.6A1.5 1.5 0 0 1 5 4Z"/></svg><span>Mientras tanto, nuestro equipo resuelve tus dudas en el <a class="cvx-strong-link" href="tel:+34611169264">611 16 92 64</a> o a través del <a href="/contacto/">formulario de contacto</a>.</span></p>
    </section>
</div>
<!-- /wp:html -->
CVHTML
    ],
];

// ------------------------------------------------------------------ ROLLBACK
if ($rollback) {
    $dir = rtrim($rollback, "/\\");
    if (!is_dir($dir)) $dir = __DIR__ . DIRECTORY_SEPARATOR . $dir;
    if (!is_dir($dir)) exit("No existe la carpeta de copia: $rollback\n");
    foreach (array_keys($pages) as $id) {
        $f = $dir . DIRECTORY_SEPARATOR . "page-$id.html";
        if (!is_file($f)) { echo "  [SKIP] sin copia para ID $id\n"; continue; }
        $r = wp_update_post(wp_slash(['ID' => $id, 'post_content' => file_get_contents($f)]), true);
        echo is_wp_error($r) ? "  [ERROR] ID $id: " . $r->get_error_message() . "\n" : "  [OK] Restaurada ID $id\n";
    }
    exit("Rollback terminado.\n");
}

// ------------------------------------------------------------------ PRE-CHECKS
$errors = 0;
foreach ($pages as $id => $p) {
    $post = get_post($id);
    if (!$post || $post->post_type !== 'page') { echo "  [ERROR] ID $id no existe\n"; $errors++; continue; }
    if ($post->post_name !== $p['slug']) { echo "  [ERROR] ID $id tiene slug '{$post->post_name}' (esperado '{$p['slug']}')\n"; $errors++; }
    foreach ($p['checks'] as $c) {
        if (strpos($p['html'], $c) === false) { echo "  [ERROR] ID $id: falta el dato obligatorio '$c' en el nuevo HTML\n"; $errors++; }
    }
}
if ($errors) exit("Abortado: $errors errores. No se ha modificado nada.\n");
echo "Comprobaciones previas OK (slugs, colegiaturas, teléfonos y sedes presentes).\n";
if ($dry) exit("--dry-run: no se ha escrito nada.\n");

// ------------------------------------------------------------------ BACKUP
$backup = __DIR__ . DIRECTORY_SEPARATOR . 'backups' . DIRECTORY_SEPARATOR . 'rediseno-claude-' . date('Ymd-His');
if (!wp_mkdir_p($backup)) exit("No se pudo crear la carpeta de copia $backup\n");
foreach (array_keys($pages) as $id) {
    file_put_contents($backup . DIRECTORY_SEPARATOR . "page-$id.html", get_post($id)->post_content);
}
echo "Copia de seguridad del contenido anterior: $backup\n";

// ------------------------------------------------------------------ UPDATE
foreach ($pages as $id => $p) {
    $r = wp_update_post(wp_slash(['ID' => $id, 'post_content' => $p['html']]), true); // título y slug NO se tocan
    if (is_wp_error($r)) { echo "  [ERROR] ID $id: " . $r->get_error_message() . "\n"; continue; }
    clean_post_cache($id);
    $saved = get_post($id)->post_content;
    $ok = (strpos($saved, '<svg') !== false);
    foreach ($p['checks'] as $c) { if (strpos($saved, $c) === false) $ok = false; }
    echo ($ok ? "  [OK]    " : "  [AVISO] ") . "ID $id /{$p['slug']}/ actualizada" . ($ok ? '' : ' (revisa: faltan iconos o datos tras guardar)') . "\n";
}
echo "\nListo. Siguiente paso: python build_clinica_vocal_static.py\n";
echo "Para deshacer: php -c runtime\\php.ini actualizar_rediseno_claude.php --rollback=\"$backup\"\n";
