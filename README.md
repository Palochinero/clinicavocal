# Clínica Vocal Cristina Iglesias — Logopedia y Psicología Sanitaria

[![Cloudflare Pages](https://img.shields.io/badge/Hosted_on-Cloudflare_Pages-F38020?logo=cloudflare&logoColor=white)](https://clinica-vocal.pages.dev)
[![Live Production](https://img.shields.io/badge/Status-Live_Production-2ea44f)](https://www.clinicavocal.es)
[![Domain](https://img.shields.io/badge/Domain-clinicavocal.es-blue)](https://www.clinicavocal.es)

Repositorio oficial y código fuente de producción del sitio web de **Clínica Vocal Cristina Iglesias**, centro clínico especializado en **Logopedia Integral, Psicología Sanitaria y Cuidado de la Voz**.

---

## 🌐 URLs de Producción y Despliegue
* **Dominio Principal (Canónico):** [https://www.clinicavocal.es](https://www.clinicavocal.es)
* **Cloudflare Pages Production URL:** [https://clinica-vocal.pages.dev](https://clinica-vocal.pages.dev)
* **Despliegue Activo en Cloudflare:** `328edab7` (Sincronizado al 100% con la versión en vivo)

---

## 🏥 Centros Clínicos Verificados y Contacto
* **Sede Plasencia:** Calle Sierra de Tormantos, 22, 10600 Plasencia, Cáceres, España.
* **Sede Navaconcejo:** Avenida de Extremadura, 117, 10613 Navaconcejo, Cáceres, España.
* **Teléfono Cita Previa:** [+34 611 16 92 64](tel:+34611169264)
* **Modalidades:** Consulta presencial en Plasencia y Navaconcejo, y terapia psicológica online.

---

## 👩‍⚕️ Equipo Profesional Clínico
1. **Cristina Iglesias Martín**: Directora clínica y Logopeda especializada (Neonatal, pediátrico, MO, AC, deglución, habla y voz).
2. **Jessica Serrano Díaz**: Psicóloga General Sanitaria (Terapia individual, ansiedad, trauma y consulta online).
3. **Andrea Montero Regadera**: Psicóloga Sanitaria (Adultos, adolescentes y familias).
4. **Belén Mesa Montero**: Psicóloga Sanitaria (Enfoque infanto-juvenil y psicopedagogía).

---

## 📐 Arquitectura Técnica y Estructura del Repositorio

El sitio web está implementado como una arquitectura Jamstack de alto rendimiento optimizada para **Cloudflare Pages**:

```
.
├── index.html                  # Página de Inicio oficial (Hero, Especialidades, Sedes, Equipo)
├── contacto/                   # Contacto, Cita Previa, Formulario y Mapas interactivos
├── centros/                    # Directorio de Sedes Clínicas
│   ├── plasencia/              # Sede Plasencia (Calle Sierra de Tormantos 22)
│   └── navaconcejo/            # Sede Navaconcejo (Avda. Extremadura 117)
├── equipo/                     # Equipo Profesional Clínico
│   ├── cristina-iglesias-martin/
│   ├── jessica-serrano-diaz/
│   ├── andrea-montero-regadera/
│   └── belen-mesa-montero/
├── logopedia/                  # Especialidad Logopedia Integral
├── psicologia/                 # Especialidad Psicología Sanitaria
│   └── online/                 # Terapia Psicológica Online
├── como-trabajamos/            # Metodología de Intervención Clínica
├── primera-cita/               # Guía del Paciente para la Primera Consulta
├── preguntas-frecuentes/       # FAQ y Respuestas Clínicas
├── blog/                       # Artículos y Divulgación de Salud
├── privacidad/                 # Política de Privacidad RGPD
├── aviso-legal/                # Aviso Legal y Registro Sanitario
├── cookies/                    # Política y Configuración de Cookies
├── wp-content/                 # Activos estáticos optimizados (WebP/PNG, CSS, Fuentes, JS)
├── wp-includes/                # Librerías cliente (Leaflet para mapas, scripts esenciales)
├── _headers                    # Cabeceras HTTP de seguridad (HSTS, CSP, X-Frame-Options)
├── robots.txt                  # Directivas para rastreadores de búsqueda
├── sitemap.xml                 # Mapa del sitio canónico para Google Search Console
├── src_theme/                  # Código fuente del tema Astra Child Theme
├── tools/                      # Scripts de compilación y saneamiento de datos
└── branding/                   # Manual de identidad de marca, paleta de colores y logos
```

---

## 🚀 Despliegue en Cloudflare Pages

Para desplegar este repositorio directamente a Cloudflare Pages mediante Wrangler CLI:

```bash
npx wrangler pages deploy . --project-name=clinica-vocal
```

O conectando directamente este repositorio de GitHub en el panel de Cloudflare Pages:
* **Build command:** *(dejar vacío)*
* **Build output directory:** `/`

---

## 🛡️ Estándares de Privacidad y SEO
* Metadatos Schema.org JSON-LD estructurados (`MedicalBusiness`, `LocalBusiness`).
* Google Site Verification activo para Search Console: `02fqVbJWm4BdLNH5IPOD9FDuNLV8J7nNrZRLU9kiaag`.
* Seguridad por defecto: HSTS preloaded, protección XSS, X-Content-Type-Options y Referrer-Policy estricta.
