const menu=document.querySelector('.cv-menu-button');
const nav=document.querySelector('.cv-nav');
menu?.addEventListener('click',()=>{const open=menu.getAttribute('aria-expanded')!=='true';menu.setAttribute('aria-expanded',String(open));nav.classList.toggle('open',open);});
document.addEventListener('keydown',event=>{if(event.key==='Escape'&&menu?.getAttribute('aria-expanded')==='true'){menu.click();menu.focus();}});
document.querySelector('#cv-contact')?.addEventListener('submit', async function(event) {
    event.preventDefault();
    const form = event.target;
    const submitBtn = form.querySelector('button[type="submit"]') || form.querySelector('.cv-form-submit-btn');
    const status = form.querySelector('[role="status"]');
    if (!status) return;

    const name = form.querySelector('input[name="name"]')?.value.trim();
    const contact = form.querySelector('input[name="contact"]')?.value.trim();
    const location = form.querySelector('select[name="location"]')?.value;
    const service = form.querySelector('select[name="service"]')?.value;
    const message = form.querySelector('textarea[name="message"]')?.value.trim() || 'No especificado';

    const originalBtnText = submitBtn ? submitBtn.textContent : 'Enviar solicitud';
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Enviando solicitud...';
    }

    status.hidden = false;
    status.style.color = '#8E6D4E';
    status.style.background = '#FAF7F2';
    status.style.border = '1px solid rgba(184, 155, 114, 0.4)';
    status.style.borderRadius = '10px';
    status.style.padding = '14px 18px';
    status.textContent = 'Conectando y enviando solicitud a Clínica Vocal...';

    try {
        const response = await fetch('https://formsubmit.co/ajax/clinicavocal@gmail.com', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                'Nombre y Apellidos': name,
                'Contacto (Teléfono o Email)': contact,
                'Clínica preferida': location,
                'Especialidad requerida': service,
                'Mensaje de la consulta': message,
                '_subject': `Nueva consulta web: ${name} (${service} - ${location})`,
                '_template': 'table',
                '_captcha': 'false'
            })
        });

        const data = await response.json().catch(() => ({}));

        status.style.color = '#2E7D32';
        status.style.background = '#E8F5E9';
        status.style.border = '1px solid #A5D6A7';
        status.innerHTML = '<strong>✓ Solicitud enviada correctamente.</strong><br>Hemos recibido tus datos y te contactaremos a la mayor brevedad. Si tu consulta es urgente o prefieres respuesta inmediata, también puedes <a href="https://wa.me/34611169264" target="_blank" rel="noopener noreferrer" style="color: #2E7D32; font-weight: 700; text-decoration: underline;">escribirnos directamente por WhatsApp al 611 16 92 64</a>.';
        form.reset();
    } catch (err) {
        status.style.color = '#B71C1C';
        status.style.background = '#FFEBEE';
        status.style.border = '1px solid #FFCDD2';
        status.innerHTML = 'No se ha podido enviar el formulario en este momento. Por favor, llámanos directamente al <a href="tel:+34611169264" style="color: #B71C1C; font-weight: 700;">611 16 92 64</a> o <a href="https://wa.me/34611169264" target="_blank" rel="noopener noreferrer" style="color: #B71C1C; font-weight: 700; text-decoration: underline;">escríbenos por WhatsApp</a>.';
    } finally {
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.textContent = originalBtnText;
        }
    }
});
document.querySelectorAll('[data-team-tab]').forEach(tab=>tab.addEventListener('click',()=>{const target=tab.dataset.teamTab;document.querySelectorAll('[data-team-tab]').forEach(item=>item.setAttribute('aria-selected',String(item===tab)));document.querySelectorAll('[data-team-panel]').forEach(panel=>panel.hidden=panel.dataset.teamPanel!==target);}));

function initContactMaps() {
    if (typeof L === 'undefined') return;
    const pinSvg = '<svg class="cv-map-pin" viewBox="0 0 24 34" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 0C5.37 0 0 5.37 0 12C0 21 12 34 12 34C12 34 24 21 24 12C24 5.37 18.63 0 12 0Z" fill="#EA4335"/><circle cx="12" cy="12" r="4.5" fill="#FFFFFF"/></svg>';
    const pinIcon = L.divIcon({
        className: 'cv-custom-pin-wrap',
        html: pinSvg,
        iconSize: [28, 38],
        iconAnchor: [14, 38],
        popupAnchor: [0, -36]
    });

    // Mapas en página de contacto y páginas individuales de sedes
    const elP = document.getElementById('map-plasencia') || document.getElementById('map-centro-plasencia');
    if (elP && !elP._leaflet_id) {
        const mapP = L.map(elP.id, { zoomControl: true, scrollWheelZoom: false }).setView([40.03978, -6.09327], 16);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }).addTo(mapP);
        L.marker([40.03978, -6.09327], { icon: pinIcon }).addTo(mapP);
        setTimeout(function () { mapP.invalidateSize(); }, 200);
    }

    const elN = document.getElementById('map-navaconcejo') || document.getElementById('map-centro-navaconcejo');
    if (elN && !elN._leaflet_id) {
        const mapN = L.map(elN.id, { zoomControl: true, scrollWheelZoom: false }).setView([40.17873, -5.82861], 16);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }).addTo(mapN);
        L.marker([40.17873, -5.82861], { icon: pinIcon }).addTo(mapN);
        setTimeout(function () { mapN.invalidateSize(); }, 200);
    }
}
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initContactMaps);
} else {
    initContactMaps();
}

// Controlador del selector desplegable de consulta por WhatsApp
(function initWhatsAppPopover() {
    const toggle = document.getElementById('cv-whatsapp-toggle');
    const popover = document.getElementById('cv-whatsapp-popover');
    const closeBtn = document.getElementById('cv-wa-close-btn');
    if (!toggle || !popover) return;

    function openPopover() {
        popover.classList.add('open');
        popover.setAttribute('aria-hidden', 'false');
        toggle.setAttribute('aria-expanded', 'true');
    }

    function closePopover() {
        popover.classList.remove('open');
        popover.setAttribute('aria-hidden', 'true');
        toggle.setAttribute('aria-expanded', 'false');
    }

    toggle.addEventListener('click', (e) => {
        e.stopPropagation();
        if (popover.classList.contains('open')) {
            closePopover();
        } else {
            openPopover();
        }
    });

    closeBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        closePopover();
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('#cv-whatsapp-widget')) {
            closePopover();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && popover.classList.contains('open')) {
            closePopover();
            toggle.focus();
        }
    });
})();

// =============================================================================
// Gestor de Consentimiento y Preferencias de Cookies (AEPD / RGPD)
// =============================================================================
(function initCookieConsent() {
    const banner = document.getElementById('cv-cookie-banner');
    const acceptAllBtn = document.getElementById('cv-cookie-btn-accept-all');
    const acceptNecessaryBtn = document.getElementById('cv-cookie-btn-accept-necessary');
    const toggleDetailsBtn = document.getElementById('cv-cookie-btn-toggle-details');
    const detailsContainer = document.getElementById('cv-cookie-details');
    const closeBtn = document.getElementById('cv-cookie-close-btn');
    const footerCookiesLink = document.getElementById('cv-footer-cookies-link');
    const reopenBtn = document.getElementById('cv-reopen-cookie-btn');
    const statusMsg = document.getElementById('cv-cookie-status-msg');

    if (!banner) return;

    function getConsent() {
        try {
            return localStorage.getItem('cv_cookie_consent');
        } catch (e) {
            return null;
        }
    }

    function setConsent(val) {
        try {
            localStorage.setItem('cv_cookie_consent', val);
        } catch (e) {}
        updateStatusDisplay();
        hideBanner();
    }

    function updateStatusDisplay() {
        if (!statusMsg) return;
        const current = getConsent();
        if (current === 'all') {
            statusMsg.textContent = '✓ Estado actual: Has aceptado todas las cookies técnicas y de preferencias.';
            statusMsg.style.color = '#2E7D32';
        } else if (current === 'necessary') {
            statusMsg.textContent = '✓ Estado actual: Has configurado únicamente cookies técnicas obligatorias.';
            statusMsg.style.color = '#2E7D32';
        } else {
            statusMsg.textContent = 'Estado actual: Pendiente de confirmación.';
            statusMsg.style.color = '#8E6D4E';
        }
    }

    function showBanner(openDetails) {
        banner.classList.add('visible');
        banner.setAttribute('aria-hidden', 'false');
        if (openDetails && detailsContainer) {
            detailsContainer.hidden = false;
            if (toggleDetailsBtn) toggleDetailsBtn.textContent = 'Ocultar detalles';
        }
    }

    function hideBanner() {
        banner.classList.remove('visible');
        banner.setAttribute('aria-hidden', 'true');
    }

    // Comprobar consentimiento previo al cargar
    const existingConsent = getConsent();
    if (!existingConsent) {
        setTimeout(function() {
            showBanner(false);
        }, 700);
    }
    updateStatusDisplay();

    // Acciones de los botones
    acceptAllBtn?.addEventListener('click', function() {
        setConsent('all');
    });

    acceptNecessaryBtn?.addEventListener('click', function() {
        setConsent('necessary');
    });

    toggleDetailsBtn?.addEventListener('click', function() {
        if (!detailsContainer) return;
        const isHidden = detailsContainer.hidden;
        detailsContainer.hidden = !isHidden;
        toggleDetailsBtn.textContent = isHidden ? 'Ocultar detalles' : 'Configurar';
    });

    closeBtn?.addEventListener('click', function() {
        hideBanner();
    });

    // Clic en "Cookies" en el pie de página: abre el panel interactivo de preferencias
    footerCookiesLink?.addEventListener('click', function(e) {
        e.preventDefault();
        showBanner(true);
        banner.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });

    // Clic en botón "Configurar Preferencias de Cookies" en la página /cookies/
    reopenBtn?.addEventListener('click', function(e) {
        e.preventDefault();
        showBanner(true);
        banner.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
})();



