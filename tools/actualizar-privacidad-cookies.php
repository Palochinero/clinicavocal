<?php
/**
 * Script de Actualización - Política de Privacidad y Política de Cookies Oficiales
 * Para Clínica Vocal (www.clinicavocal.es - Cristina Iglesias Martín)
 */

define('WP_USE_THEMES', false);
require_once __DIR__ . '/wordpress/wp-load.php';

echo "Iniciando actualización de Privacidad y Cookies...\n";

// =============================================================================
// 1. POLÍTICA DE PRIVACIDAD (ID: 16)
// =============================================================================
$privacidad_html = '<!-- wp:html -->
<div class="cv-legal-container">

    <!-- CABECERA HERO OFICIAL -->
    <header class="cv-legal-header">
        <span class="cv-legal-badge">Protección de Datos · RGPD &amp; LOPDGDD</span>
        <h1 class="cv-legal-title">POLÍTICA DE PRIVACIDAD</h1>
        <p class="cv-legal-lead">Información transparente sobre el tratamiento, seguridad y protección de los datos de carácter personal recabados en el sitio web de Clínica Vocal (www.clinicavocal.es).</p>
        <div class="cv-legal-meta">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <span>Última actualización: Septiembre 2026 · Responsable: CRISTINA IGLESIAS MARTÍN</span>
        </div>
    </header>

    <!-- SECCIÓN 1: RESPONSABLE DEL TRATAMIENTO -->
    <section class="cv-legal-section" id="responsable">
        <div class="cv-legal-section-header">
            <span class="cv-legal-num">01</span>
            <h2 class="cv-legal-h2">1. RESPONSABLE DEL TRATAMIENTO</h2>
        </div>
        <p class="cv-legal-p">De conformidad con lo dispuesto en el Reglamento (UE) 2016/679 (RGPD) y en la Ley Orgánica 3/2018 (LOPDGDD), se informa al usuario de que los datos personales facilitados a través de este sitio web o en el marco de la relación asistencial serán tratados por el Responsable del Tratamiento:</p>
        
        <div class="cv-legal-identity-card">
            <div class="cv-legal-identity-grid">
                <div class="cv-legal-id-item">
                    <strong>Identidad del Responsable</strong>
                    <span>CRISTINA IGLESIAS MARTÍN (Clínica Vocal)</span>
                </div>
                <div class="cv-legal-id-item">
                    <strong>NIF / CIF</strong>
                    <span>44412489H</span>
                </div>
                <div class="cv-legal-id-item" style="grid-column: 1 / -1;">
                    <strong>Domicilio Social y Asistencial</strong>
                    <span>AVD. EXTREMADURA, 117. BAJO - 10613 - NAVACONCEJO - CÁCERES</span>
                </div>
                <div class="cv-legal-id-item">
                    <strong>Correo Electrónico de Contacto</strong>
                    <a href="mailto:info@clinicavocal.es" style="color: #6E4F34; font-weight: 700;">info@clinicavocal.es</a>
                </div>
                <div class="cv-legal-id-item">
                    <strong>Teléfono Directo de Atención</strong>
                    <a href="tel:+34611169264" style="color: #6E4F34; font-weight: 700;">611 16 92 64</a>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN 2: PRINCIPIOS Y FINALIDADES -->
    <section class="cv-legal-section" id="finalidades">
        <div class="cv-legal-section-header">
            <span class="cv-legal-num">02</span>
            <h2 class="cv-legal-h2">2. FINALIDADES DEL TRATAMIENTO DE LOS DATOS</h2>
        </div>
        <p class="cv-legal-p">En Clínica Vocal tratamos la información personal que nos facilitan los usuarios con las siguientes finalidades asistenciales y de gestión:</p>
        
        <ul class="cv-legal-clauses">
            <li class="cv-legal-clause-item">
                <span class="cv-legal-clause-tag">1</span>
                <div>
                    <strong>Gestión de Citas y Consultas Sanitarias:</strong> Tramitar las solicitudes de primera consulta, cita previa o información clínica remitidas a través de los formularios web, vía telefónica o canales de mensajería (WhatsApp), tanto en logopedia como en psicología sanitaria.
                </div>
            </li>
            <li class="cv-legal-clause-item">
                <span class="cv-legal-clause-tag">2</span>
                <div>
                    <strong>Prestación Asistencial y Seguimiento Clínico:</strong> Elaborar la historia clínica individual, realizar valoraciones diagnósticas, planificar intervenciones terapéuticas y efectuar el seguimiento continuo del paciente en nuestras sedes de Plasencia y Navaconcejo, así como en la modalidad de terapia online.
                </div>
            </li>
            <li class="cv-legal-clause-item">
                <span class="cv-legal-clause-tag">3</span>
                <div>
                    <strong>Gestión Administrativa, Facturación y Obligaciones Legales:</strong> Tramitación contable, emisión de facturas y cumplimiento estricto de la normativa sanitaria española (Ley 41/2002 de Autonomía del Paciente).
                </div>
            </li>
        </ul>
        <p class="cv-legal-p">En ningún caso utilizaremos tus datos personales para elaborar perfiles comerciales automatizados ni para cederlos a empresas de publicidad.</p>
    </section>

    <!-- SECCIÓN 3: LEGITIMACIÓN -->
    <section class="cv-legal-section" id="legitimacion">
        <div class="cv-legal-section-header">
            <span class="cv-legal-num">03</span>
            <h2 class="cv-legal-h2">3. LEGITIMACIÓN DEL TRATAMIENTO</h2>
        </div>
        <p class="cv-legal-p">La base jurídica que legitima el tratamiento de tus datos depende de la interacción:</p>
        <ul class="cv-legal-clauses">
            <li class="cv-legal-clause-item">
                <span class="cv-legal-clause-tag">A</span>
                <div><strong>Consentimiento Expreso del Usuario (Art. 6.1.a RGPD):</strong> Al enviar formularios web o iniciar contacto voluntario solicitando información asistencial.</div>
            </li>
            <li class="cv-legal-clause-item">
                <span class="cv-legal-clause-tag">B</span>
                <div><strong>Relación Contractual y Asistencial Sanitaria (Art. 6.1.b y Art. 9.2.h RGPD):</strong> Para la prestación de servicios sanitarios de logopedia y psicología, diagnóstico y tratamiento clínico por profesionales titulados sujetos al deber de secreto profesional.</div>
            </li>
            <li class="cv-legal-clause-item">
                <span class="cv-legal-clause-tag">C</span>
                <div><strong>Obligación Legal (Art. 6.1.c RGPD):</strong> Conservación preceptiva de documentación clínica sanitaria y facturación según la legislación vigente.</div>
            </li>
        </ul>
    </section>

    <!-- SECCIÓN 4: CONSERVACIÓN Y DESTINATARIOS -->
    <section class="cv-legal-section" id="conservacion">
        <div class="cv-legal-section-header">
            <span class="cv-legal-num">04</span>
            <h2 class="cv-legal-h2">4. PLAZOS DE CONSERVACIÓN Y DESTINATARIOS</h2>
        </div>
        <p class="cv-legal-p"><strong>Plazo de conservación:</strong> Los datos de contacto de consultas informativas se conservarán durante el tiempo necesario para resolver la solicitud. En el caso de pacientes asistidos clínicamente, la historia clínica se conservará como mínimo durante cinco (5) años contados desde la fecha del alta de cada proceso asistencial, conforme a la Ley 41/2002 de Autonomía del Paciente.</p>
        <p class="cv-legal-p"><strong>Destinatarios:</strong> Los datos únicamente serán accesibles por el equipo profesional sanitario de Clínica Vocal directamente implicado en tu asistencia. No se realizarán cesiones de datos a terceros ajenos a la clínica, salvo imperativo legal o requerimiento judicial expreso.</p>
    </section>

    <!-- SECCIÓN 5: DERECHOS DEL USUARIO -->
    <section class="cv-legal-section" id="derechos">
        <div class="cv-legal-section-header">
            <span class="cv-legal-num">05</span>
            <h2 class="cv-legal-h2">5. EJERCICIO DE DERECHOS (ARCOPOL)</h2>
        </div>
        <p class="cv-legal-p">Tienes derecho en todo momento a:</p>
        <ul class="cv-legal-clauses">
            <li class="cv-legal-clause-item">
                <span class="cv-legal-clause-tag">✓</span>
                <div><strong>Acceso:</strong> Conocer si estamos tratando tus datos y obtener copia de los mismos.</div>
            </li>
            <li class="cv-legal-clause-item">
                <span class="cv-legal-clause-tag">✓</span>
                <div><strong>Rectificación:</strong> Solicitar la corrección de datos inexactos o incompletos.</div>
            </li>
            <li class="cv-legal-clause-item">
                <span class="cv-legal-clause-tag">✓</span>
                <div><strong>Supresión ("Derecho al olvido"):</strong> Solicitar el borrado de tus datos cuando ya no sean necesarios para la finalidad recabada (respetando los plazos legales de conservación de historiales médicos).</div>
            </li>
            <li class="cv-legal-clause-item">
                <span class="cv-legal-clause-tag">✓</span>
                <div><strong>Limitación y Oposición:</strong> Solicitar la suspensión temporal del tratamiento o manifestar tu oposición a determinados usos.</div>
            </li>
            <li class="cv-legal-clause-item">
                <span class="cv-legal-clause-tag">✓</span>
                <div><strong>Portabilidad:</strong> Recibir tus datos personales en formato electrónico estructurado.</div>
            </li>
        </ul>
        <p class="cv-legal-p">Para ejercer estos derechos puedes remitir un escrito adjuntando copia de documento acreditativo de identidad a:</p>
        <div style="background: #FAF7F2; border: 1.5px solid rgba(184, 155, 114, 0.4); border-radius: 14px; padding: 18px 24px; margin-top: 14px;">
            <p style="margin: 0 0 6px;"><strong>Por correo electrónico:</strong> <a href="mailto:info@clinicavocal.es" style="color: #6E4F34; font-weight: 700;">info@clinicavocal.es</a></p>
            <p style="margin: 0;"><strong>Por correo postal:</strong> Clínica Vocal, Avd. Extremadura, 117. Bajo - 10613 Navaconcejo (Cáceres)</p>
        </div>
        <p class="cv-legal-p" style="margin-top: 16px;">Asimismo, si consideras que tus derechos han sido vulnerados, tienes derecho a presentar una reclamación ante la autoridad de control: la <strong>Agencia Española de Protección de Datos (AEPD)</strong> en <a href="https://www.aepd.es" target="_blank" rel="noopener noreferrer" style="color: #8E6D4E; text-decoration: underline;">www.aepd.es</a>.</p>
    </section>

    <!-- FOOTER NAV LEGAL -->
    <nav class="cv-legal-footer-nav" aria-label="Navegación legal">
        <p>¿Deseas revisar el resto de información legal del sitio web?</p>
        <div class="cv-legal-links-row">
            <a href="/aviso-legal/" class="cv-legal-link-btn">Aviso Legal</a>
            <a href="/cookies/" class="cv-legal-link-btn" style="background: transparent; border-color: rgba(184, 155, 114, 0.5);">Política de Cookies</a>
            <a href="/contacto/" class="cv-legal-link-btn" style="background: transparent; border-color: rgba(184, 155, 114, 0.5);">Contacto</a>
        </div>
    </nav>

</div>
<!-- /wp:html -->';

// Actualizar página ID 16 (Privacidad)
$updated_privacidad = wp_update_post([
    'ID'           => 16,
    'post_title'   => 'Política de privacidad',
    'post_name'    => 'privacidad',
    'post_content' => $privacidad_html,
    'post_status'  => 'publish'
]);

if ($updated_privacidad && !is_wp_error($updated_privacidad)) {
    update_post_meta(16, '_yoast_wpseo_metadesc', 'Política de Privacidad de Clínica Vocal (www.clinicavocal.es). Información sobre protección de datos conforme al RGPD y LOPDGDD. Responsable: Cristina Iglesias Martín.');
    echo "Política de Privacidad (ID: 16) actualizada con éxito.\n";
} else {
    echo "Error al actualizar la Política de Privacidad.\n";
}

// =============================================================================
// 2. POLÍTICA DE COOKIES (ID: 18)
// =============================================================================
$cookies_html = '<!-- wp:html -->
<div class="cv-legal-container">

    <!-- CABECERA HERO OFICIAL -->
    <header class="cv-legal-header">
        <span class="cv-legal-badge">Información de Cookies · Cumplimiento AEPD &amp; LSSI-CE</span>
        <h1 class="cv-legal-title">POLÍTICA DE COOKIES</h1>
        <p class="cv-legal-lead">Información clara y detallada sobre las cookies utilizadas en Clínica Vocal (www.clinicavocal.es) y sobre cómo configurar o revocar tu consentimiento en cualquier momento.</p>
        <div class="cv-legal-meta">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <span>Última actualización: Septiembre 2026 · Titular: CRISTINA IGLESIAS MARTÍN</span>
        </div>
    </header>

    <!-- SECCIÓN 1: QUÉ SON LAS COOKIES -->
    <section class="cv-legal-section" id="que-son">
        <div class="cv-legal-section-header">
            <span class="cv-legal-num">01</span>
            <h2 class="cv-legal-h2">1. ¿QUÉ SON LAS COOKIES?</h2>
        </div>
        <p class="cv-legal-p">Una cookie es un pequeño fichero de texto que se almacena en tu navegador cuando visitas casi cualquier página web. Su utilidad es que la web sea capaz de recordar tu visita cuando vuelvas a navegar por esa página, almacenar tus preferencias de navegación técnica y garantizar la seguridad del sitio.</p>
        <p class="cv-legal-p">Las cookies no contienen virus ni software malicioso, y son una herramienta habitual y esencial para el correcto funcionamiento de los sitios web modernos.</p>
    </section>

    <!-- SECCIÓN 2: TIPOS DE COOKIES UTILIZADAS -->
    <section class="cv-legal-section" id="tipos">
        <div class="cv-legal-section-header">
            <span class="cv-legal-num">02</span>
            <h2 class="cv-legal-h2">2. TIPOS DE COOKIES UTILIZADAS EN ESTE SITIO WEB</h2>
        </div>
        <p class="cv-legal-p">En el sitio web de Clínica Vocal (<strong>www.clinicavocal.es</strong>) priorizamos la privacidad de nuestros pacientes y usuarios. Por ello, <strong>no utilizamos cookies publicitarias de terceros, ni realizamos compraventa de perfiles de navegación</strong>.</p>
        
        <p class="cv-legal-p">Las categorías empleadas son las siguientes:</p>
        <ul class="cv-legal-clauses">
            <li class="cv-legal-clause-item">
                <span class="cv-legal-clause-tag">✓</span>
                <div>
                    <strong>Cookies Técnicas y Estrictamente Necesarias:</strong> Imprescindibles para la navegación correcta, la seguridad de la conexión, el equilibrio de carga del servidor y la prevención de fraudes o accesos no autorizados. No requieren consentimiento previo.
                </div>
            </li>
            <li class="cv-legal-clause-item">
                <span class="cv-legal-clause-tag">✓</span>
                <div>
                    <strong>Cookies de Personalización y Preferencias:</strong> Permiten recordar decisiones previas del usuario, tales como el idioma o la aceptación/rechazo del panel de cookies.
                </div>
            </li>
        </ul>
    </section>

    <!-- SECCIÓN 3: TABLA DE COOKIES -->
    <section class="cv-legal-section" id="tabla">
        <div class="cv-legal-section-header">
            <span class="cv-legal-num">03</span>
            <h2 class="cv-legal-h2">3. RELACIÓN DETALLADA DE COOKIES</h2>
        </div>
        <p class="cv-legal-p">A continuación se especifica la relación de cookies técnicas y de preferencias que pueden generarse durante tu navegación:</p>
        
        <div style="overflow-x: auto; margin: 20px 0;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14.5px;">
                <thead>
                    <tr style="background: #F0E6D8; color: #1F1C18; border-bottom: 2px solid #9C7A5B;">
                        <th style="padding: 12px 14px;">Cookie</th>
                        <th style="padding: 12px 14px;">Proveedor</th>
                        <th style="padding: 12px 14px;">Finalidad</th>
                        <th style="padding: 12px 14px;">Duración</th>
                        <th style="padding: 12px 14px;">Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid rgba(184, 155, 114, 0.3);">
                        <td style="padding: 12px 14px; font-weight: 700;">cv_cookie_consent</td>
                        <td style="padding: 12px 14px;">clinicavocal.es</td>
                        <td style="padding: 12px 14px;">Guarda la decisión del usuario sobre el aviso de cookies</td>
                        <td style="padding: 12px 14px;">1 año</td>
                        <td style="padding: 12px 14px;">Técnica / Propia</td>
                    </tr>
                    <tr style="border-bottom: 1px solid rgba(184, 155, 114, 0.3);">
                        <td style="padding: 12px 14px; font-weight: 700;">PHPSESSID</td>
                        <td style="padding: 12px 14px;">clinicavocal.es</td>
                        <td style="padding: 12px 14px;">Mantiene la sesión técnica de navegación activa de forma segura</td>
                        <td style="padding: 12px 14px;">Sesión</td>
                        <td style="padding: 12px 14px;">Técnica / Propia</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- SECCIÓN 4: GESTIÓN INTERACTIVA DEL CONSENTIMIENTO -->
    <section class="cv-legal-section" id="gestion">
        <div class="cv-legal-section-header">
            <span class="cv-legal-num">04</span>
            <h2 class="cv-legal-h2">4. GESTIÓN Y CONFIGURACIÓN DEL CONSENTIMIENTO</h2>
        </div>
        <p class="cv-legal-p">Puedes modificar o revocar tu consentimiento en cualquier momento pulsando el siguiente botón para reactivar el panel de configuración de cookies:</p>
        
        <div style="text-align: center; margin: 25px 0;">
            <button type="button" class="cv-reopen-cookie-banner" id="cv-reopen-cookie-btn" style="background: linear-gradient(135deg, #9C7A5B 0%, #836143 100%); color: #FFFFFF; border: none; font-size: 15px; font-weight: 700; padding: 14px 28px; border-radius: 50px; cursor: pointer; box-shadow: 0 4px 16px rgba(131, 97, 67, 0.3); transition: all 0.25s ease;">
                ⚙️ Configurar Preferencias de Cookies
            </button>
            <p id="cv-cookie-status-msg" style="font-size: 13.5px; color: #8E6D4E; margin-top: 10px; font-weight: 600;"></p>
        </div>
    </section>

    <!-- SECCIÓN 5: DESACTIVACIÓN EN EL NAVEGADOR -->
    <section class="cv-legal-section" id="navegadores">
        <div class="cv-legal-section-header">
            <span class="cv-legal-num">05</span>
            <h2 class="cv-legal-h2">5. CÓMO DESACTIVAR O ELIMINAR COOKIES EN TU NAVEGADOR</h2>
        </div>
        <p class="cv-legal-p">Puedes permitir, bloquear o eliminar las cookies instaladas en tu equipo mediante la configuración de las opciones de tu navegador de Internet. En los enlaces a continuación encontrarás las instrucciones oficiales de los navegadores más utilizados:</p>
        
        <div class="cv-legal-comm-grid">
            <div class="cv-legal-comm-card">
                <strong>Google Chrome</strong>
                <a href="https://support.google.com/chrome/answer/95647?hl=es" target="_blank" rel="noopener noreferrer">Instrucciones Chrome ↗</a>
            </div>
            <div class="cv-legal-comm-card">
                <strong>Mozilla Firefox</strong>
                <a href="https://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-sitios-web-rastrear-preferencias" target="_blank" rel="noopener noreferrer">Instrucciones Firefox ↗</a>
            </div>
            <div class="cv-legal-comm-card">
                <strong>Apple Safari</strong>
                <a href="https://support.apple.com/es-es/guide/safari/sfri11471/mac" target="_blank" rel="noopener noreferrer">Instrucciones Safari ↗</a>
            </div>
        </div>
    </section>

    <!-- FOOTER NAV LEGAL -->
    <nav class="cv-legal-footer-nav" aria-label="Navegación legal">
        <p>¿Deseas consultar otros apartados legales de Clínica Vocal?</p>
        <div class="cv-legal-links-row">
            <a href="/aviso-legal/" class="cv-legal-link-btn">Aviso Legal</a>
            <a href="/privacidad/" class="cv-legal-link-btn" style="background: transparent; border-color: rgba(184, 155, 114, 0.5);">Política de Privacidad</a>
            <a href="/contacto/" class="cv-legal-link-btn" style="background: transparent; border-color: rgba(184, 155, 114, 0.5);">Contacto</a>
        </div>
    </nav>

</div>
<!-- /wp:html -->';

// Actualizar página ID 18 (Cookies)
$updated_cookies = wp_update_post([
    'ID'           => 18,
    'post_title'   => 'Política de cookies',
    'post_name'    => 'cookies',
    'post_content' => $cookies_html,
    'post_status'  => 'publish'
]);

if ($updated_cookies && !is_wp_error($updated_cookies)) {
    update_post_meta(18, '_yoast_wpseo_metadesc', 'Política de Cookies de Clínica Vocal (www.clinicavocal.es). Información sobre cookies técnicas, gestión de preferencias y cumplimiento con la AEPD.');
    echo "Política de Cookies (ID: 18) actualizada con éxito.\n";
} else {
    echo "Error al actualizar la Política de Cookies.\n";
}

echo "Proceso completado exitosamente.\n";
