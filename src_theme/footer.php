<footer class="cv-footer">
    <div class="cv-wrap">
        <div class="cv-footer-grid">
            <div class="cv-footer-brand-wrap">
                <div class="cv-footer-brand">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri().'/assets/logo.jpg'); ?>" width="180" height="180" alt="Logotipo de Clínica Vocal Cristina Iglesias">
                    </a>
                    <div>
                        <strong>Clínica Vocal</strong>
                        <p>Cristina Iglesias<br>Logopedia y Psicología Sanitaria</p>
                    </div>
                </div>
                <div class="cv-footer-legal-integrated">
                    <span>© <?php echo esc_html(date('Y')); ?> Clínica Vocal Cristina Iglesias</span>
                    <div class="cv-footer-legal-links">
                        <a href="<?php echo esc_url(home_url('/privacidad/')); ?>">Privacidad</a> · 
                        <a href="<?php echo esc_url(home_url('/aviso-legal/')); ?>">Aviso legal</a> · 
                        <a href="<?php echo esc_url(home_url('/cookies/')); ?>" id="cv-footer-cookies-link" title="Consultar o configurar cookies">Cookies</a>
                    </div>
                </div>
            </div>

            <div class="cv-footer-column">
                <p>CLÍNICAS Y CONTACTO</p>
                <a class="cv-footer-phone" href="tel:+34611169264">611 16 92 64</a>
                <div class="cv-footer-sede-item">
                    <strong>Clínica Plasencia</strong>
                    <span>Calle Sierra de Tormantos, 22</span>
                </div>
                <div class="cv-footer-sede-item">
                    <strong>Clínica Navaconcejo</strong>
                    <span>Avenida de Extremadura, 117</span>
                </div>
            </div>

            <div class="cv-footer-column cv-footer-schedule">
                <p>HORARIOS DE ATENCIÓN</p>
                <div class="cv-schedule-box">
                    <span class="cv-schedule-days">Lunes a Viernes</span>
                    <span class="cv-schedule-hours">9:00 – 14:00 | 16:00 – 20:00</span>
                    <small class="cv-schedule-note">Atención presencial y online con cita previa</small>
                </div>
                <div class="cv-schedule-box">
                    <span class="cv-schedule-days">Fines de semana</span>
                    <span class="cv-schedule-hours cv-closed">Sábados y Domingos cerrado</span>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Banner / Modal Interactivo de Cookies (AEPD & RGPD) -->
<div class="cv-cookie-banner" id="cv-cookie-banner" role="dialog" aria-labelledby="cv-cookie-title" aria-describedby="cv-cookie-desc" aria-hidden="true">
    <div class="cv-cookie-inner">
        <div class="cv-cookie-content">
            <div class="cv-cookie-badge-row">
                <span class="cv-cookie-badge">🍪 Política y Configuración de Cookies</span>
                <button type="button" class="cv-cookie-close-btn" id="cv-cookie-close-btn" aria-label="Cerrar panel de cookies">&times;</button>
            </div>
            <h3 id="cv-cookie-title" class="cv-cookie-title">Tu privacidad es prioritaria en Clínica Vocal</h3>
            <p id="cv-cookie-desc" class="cv-cookie-desc">
                Utilizamos cookies técnicas y de preferencias para garantizar el correcto funcionamiento del sitio web y recordar tus decisiones de navegación. No utilizamos cookies publicitarias de terceros ni perfiles comerciales. Puedes aceptar todas las cookies, permitir solo las necesarias o consultar la política completa.
            </p>
            <div class="cv-cookie-details" id="cv-cookie-details" hidden>
                <div class="cv-cookie-opt-group">
                    <label class="cv-cookie-opt-label">
                        <input type="checkbox" checked disabled>
                        <div>
                            <strong>Cookies Técnicas y de Seguridad (Obligatorias)</strong>
                            <span>Imprescindibles para navegar, equilibrar la carga del servidor y garantizar la seguridad.</span>
                        </div>
                    </label>
                    <label class="cv-cookie-opt-label">
                        <input type="checkbox" id="cv-cookie-pref-toggle" checked>
                        <div>
                            <strong>Cookies de Personalización y Preferencias</strong>
                            <span>Permiten recordar tu elección de cookies y ajustes de visualización para futuras visitas.</span>
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <div class="cv-cookie-actions">
            <button type="button" class="cv-cookie-btn cv-cookie-btn-primary" id="cv-cookie-btn-accept-all">Aceptar todas</button>
            <button type="button" class="cv-cookie-btn cv-cookie-btn-outline" id="cv-cookie-btn-accept-necessary">Solo necesarias</button>
            <button type="button" class="cv-cookie-btn-link" id="cv-cookie-btn-toggle-details">Configurar</button>
            <a href="<?php echo esc_url(home_url('/cookies/')); ?>" class="cv-cookie-btn-policy">Ver política completa ↗</a>
        </div>
    </div>
</div>

<!-- Widget flotante de WhatsApp con selector de consulta -->
<div class="cv-whatsapp-widget" id="cv-whatsapp-widget">
    <div class="cv-whatsapp-popover" id="cv-whatsapp-popover" aria-hidden="true" role="dialog" aria-label="Opciones de consulta por WhatsApp">
        <div class="cv-wa-popover-header">
            <div class="cv-wa-popover-title-row">
                <span class="cv-wa-popover-badge">Atención WhatsApp</span>
                <button type="button" class="cv-wa-close-btn" id="cv-wa-close-btn" aria-label="Cerrar opciones de consulta">&times;</button>
            </div>
            <h4>¿Con quién deseas consultar?</h4>
            <p>Selecciona tu área o especialista para abrir una conversación directa:</p>
        </div>
        <div class="cv-wa-popover-options">
            <!-- Opción 1: Logopedia -->
            <a class="cv-wa-option" href="https://wa.me/34611169264?text=Hola%20Cristina,%20me%20gustar%C3%ADa%20consultar%20sobre%20Logopedia%20en%20Cl%C3%ADnica%20Vocal" target="_blank" rel="noopener noreferrer">
                <div class="cv-wa-opt-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 12c2.5-3 5.5-4.5 9.5-2 4-2.5 7-1 9.5 2-2.5 3-5.5 4.5-9.5 2-4 2.5-7 1-9.5-2z"/><path d="M4.5 12.5c2 3 4.5 4.5 7.5 4.5s5.5-1.5 7.5-4.5"/></svg>
                </div>
                <div class="cv-wa-opt-text">
                    <strong>Logopedia · Cristina Iglesias</strong>
                    <span>Terapia miofuncional, alteración o función del frenillo lingual, deglución, habla</span>
                </div>
                <span class="cv-wa-opt-arrow">↗</span>
            </a>

            <!-- Opción 2: Psicología -->
            <a class="cv-wa-option" href="https://wa.me/34611169264?text=Hola,%20me%20gustar%C3%ADa%20consultar%20con%20el%20equipo%20de%20Psicolog%C3%ADa%20Sanitaria%20en%20Cl%C3%ADnica%20Vocal" target="_blank" rel="noopener noreferrer">
                <div class="cv-wa-opt-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                </div>
                <div class="cv-wa-opt-text">
                    <strong>Psicología Sanitaria</strong>
                    <span>Jessica Serrano, Andrea Montero y Belén Mesa</span>
                </div>
                <span class="cv-wa-opt-arrow">↗</span>
            </a>

            <!-- Opción 3: Cita Previa General -->
            <a class="cv-wa-option" href="https://wa.me/34611169264?text=Hola,%20quisiera%20solicitar%20informaci%C3%B3n%20general%20o%20cita%20previa%20en%20Cl%C3%ADnica%20Vocal" target="_blank" rel="noopener noreferrer">
                <div class="cv-wa-opt-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/></svg>
                </div>
                <div class="cv-wa-opt-text">
                    <strong>Cita Previa e Información General</strong>
                    <span>Disponibilidad en clínicas de Plasencia y Navaconcejo</span>
                </div>
                <span class="cv-wa-opt-arrow">↗</span>
            </a>
        </div>
        <div class="cv-wa-popover-footer">
            <a href="/contacto/">O escribe a través de nuestro formulario web →</a>
        </div>
    </div>

    <!-- Botón activador -->
    <button type="button" class="cv-whatsapp-float" id="cv-whatsapp-toggle" aria-expanded="false" aria-controls="cv-whatsapp-popover" aria-label="Consultar por WhatsApp">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M17.472 14.382c-.301-.15-1.78-.879-2.056-.98-.276-.1-.477-.15-.678.15-.2.301-.778.98-.954 1.18-.175.2-.351.226-.652.075-.301-.15-1.27-.468-2.42-1.493-.895-.798-1.5-1.784-1.676-2.085-.175-.301-.019-.464.132-.614.135-.135.301-.351.451-.527.151-.175.201-.301.301-.502.1-.2.05-.376-.025-.526-.075-.15-.678-1.634-.929-2.238-.244-.588-.493-.509-.678-.518-.175-.009-.376-.011-.577-.011s-.527.075-.803.376c-.276.301-1.054 1.029-1.054 2.509 0 1.48 1.079 2.909 1.229 3.11.151.2 2.124 3.243 5.146 4.549.719.311 1.281.497 1.719.636.723.23 1.381.197 1.902.119.58-.087 1.78-.727 2.031-1.43.251-.703.251-1.305.176-1.43-.075-.125-.276-.201-.577-.351z"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 1.826.49 3.538 1.343 5.008L2.1 21.9a.75.75 0 0 0 .914.914l4.892-1.243A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.5a8.47 8.47 0 0 1-4.34-1.19.75.75 0 0 0-.583-.073l-3.327.846.846-3.327a.75.75 0 0 0-.073-.583A8.47 8.47 0 0 1 3.5 12c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5-3.806 8.5-8.5 8.5z"/>
        </svg>
        <span>Consultar</span>
    </button>
</div>
<?php wp_footer(); ?>
</body>
</html>
