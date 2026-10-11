import subprocess
import os
import shutil
import re
from PIL import Image

php_exe = r"C:\Users\Aitor\AppData\Local\Programs\Local\resources\extraResources\lightning-services\php-8.2.29+0\bin\win64\php.exe"
php_ini = r"C:\Users\Aitor\.gemini\antigravity\scratch\ClinicaVocal\runtime\php.ini"
wp_dir = r"C:\Users\Aitor\.gemini\antigravity\scratch\ClinicaVocal\wordpress"
dist_dir = r"C:\Users\Aitor\.gemini\antigravity\scratch\ClinicaVocal\dist_cloudflare"

print("--- STARTING CLINICA VOCAL STATIC EXPORT (OPTIMIZED V2) ---")

# 1. Clean & recreate dist
if os.path.exists(dist_dir):
    shutil.rmtree(dist_dir)
os.makedirs(dist_dir, exist_ok=True)

routes = [
    ("", "index"),
    ("psicologia/", "psicologia"),
    ("logopedia/", "logopedia"),
    ("equipo/", "equipo"),
    ("centros/", "centros"),
    ("centros/plasencia/", "centros_plasencia"),
    ("centros/navaconcejo/", "centros_navaconcejo"),
    ("contacto/", "contacto"),
    ("equipo/cristina-iglesias-martin/", "equipo_cristina"),
    ("equipo/jessica-serrano-diaz/", "equipo_jessica"),
    ("equipo/andrea-montero-regadera/", "equipo_andrea"),
    ("equipo/belen-mesa-montero/", "equipo_belen"),
    ("blog/", "blog"),
    ("psicologia/online/", "psicologia_online"),
    ("como-trabajamos/", "como_trabajamos"),
    ("primera-cita/", "primera_cita"),
    ("preguntas-frecuentes/", "preguntas_frecuentes"),
    ("privacidad/", "privacidad"),
    ("aviso-legal/", "aviso_legal"),
    ("cookies/", "cookies")
]

# Pages that actually use Leaflet map
MAP_PAGES = {"centros/plasencia/", "centros/navaconcejo/", "contacto/"}

def optimize_html(raw_html, route):
    canonical_url = f"https://www.clinicavocal.es/{route}".rstrip("/") + ("/" if route else "/")
    
    # 1. Domain URL cleanup
    cleaned = raw_html.replace("http://localhost:8091/", "/")
    cleaned = cleaned.replace("http://127.0.0.1:8091/", "/")
    cleaned = cleaned.replace("http:\/\/localhost:8091\/", "\/")
    cleaned = cleaned.replace("http:\/\/127.0.0.1:8091\/", "\/")
    cleaned = cleaned.replace("http://localhost:8091", "")
    cleaned = cleaned.replace("http://127.0.0.1:8091", "")
    
    # 2. CRITICAL SEO FIX: Remove 'noindex, nofollow' and enforce indexing
    cleaned = re.sub(
        r'<meta\s+name=[\'"]robots[\'"]\s+content=[\'"][^\'"]*[\'"]\s*/?>',
        '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />',
        cleaned,
        flags=re.IGNORECASE
    )
    if 'name="robots"' not in cleaned:
        cleaned = cleaned.replace('</head>', '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />\n</head>')
    
    # 3. Canonical Tag: Ensure absolute production URL
    if '<link rel="canonical"' in cleaned or "<link rel='canonical'" in cleaned:
        cleaned = re.sub(
            r'<link\s+rel=[\'"]canonical[\'"]\s+href=[\'"][^\'"]*[\'"]\s*/?>',
            f'<link rel="canonical" href="{canonical_url}" />',
            cleaned,
            flags=re.IGNORECASE
        )
    else:
        cleaned = cleaned.replace('</head>', f'<link rel="canonical" href="{canonical_url}" />\n</head>')
        
    # Google Site Verification for Search Console
    if 'google-site-verification' not in cleaned:
        cleaned = cleaned.replace('</head>', '<meta name="google-site-verification" content="02fqVbJWm4BdLNH5IPOD9FDuNLV8J7nNrZRLU9kiaag" />\n</head>')
        
    # 4. Remove WP emoji & unused metadata bloat
    cleaned = re.sub(r'<script\s+id=[\'"]wp-emoji-settings[\'"].*?</script>', '', cleaned, flags=re.DOTALL)
    cleaned = re.sub(r'<script\s+type=[\'"]module[\'"]>.*?wpEmojiSettingsSupports.*?</script>', '', cleaned, flags=re.DOTALL)
    cleaned = re.sub(r'<link[^>]*alternate[^>]*wp-json[^>]*>', '', cleaned)
    cleaned = re.sub(r'<link[^>]*alternate[^>]*(?:feed|comments)[^>]*>', '', cleaned)
    
    # Purge huge unused inline astra-theme-css-inline-css (saves ~60KB of blocking HTML)
    cleaned = re.sub(r'<style\s+id=[\'"]astra-theme-css-inline-css[\'"].*?</style>', '', cleaned, flags=re.DOTALL)
    
    # Purge unused Astra frontend JS and inline config to eliminate forced reflows
    cleaned = re.sub(r'<script[^>]*frontend\.min\.js[^>]*></script>', '', cleaned)
    cleaned = re.sub(r'<script\s+[^>]*?id=[\'"]astra-theme-js-extra[\'"].*?</script>', '', cleaned, flags=re.DOTALL)
    
    # Defer custom site.js so it never blocks FCP/LCP
    cleaned = cleaned.replace('src="/wp-content/themes/clinica-vocal/site.js?ver=1.1"', 'src="/wp-content/themes/clinica-vocal/site.js?ver=1.1" defer')
    
    # 5. Remove Leaflet CSS and JS on pages that don't have a map
    if route not in MAP_PAGES:
        cleaned = re.sub(r'<link[^>]*leaflet\.css[^>]*>', '', cleaned)
        cleaned = re.sub(r'<script[^>]*leaflet\.js[^>]*></script>', '', cleaned)
    else:
        # On map pages, make Leaflet script defer
        cleaned = cleaned.replace(
            'src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js?ver=1.9.4"',
            'src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js?ver=1.9.4" defer'
        )
        
    # 6. Optimize LCP image on Homepage:
    # Replace the heavy local-acuarela-v2.png with WebP and fetchpriority="high"
    if route == "":
        old_img_pattern = r'<img\s+([^>]*?)src=[\'"][^\'"]*local-acuarela-v2\.png[\'"]([^>]*?)>'
        def replace_acuarela(m):
            return (
                '<picture>'
                '<source media="(max-width: 520px)" srcset="/wp-content/themes/clinica-vocal/assets/local-acuarela-v2-480.webp" type="image/webp">'
                '<source media="(max-width: 800px)" srcset="/wp-content/themes/clinica-vocal/assets/local-acuarela-v2-750.webp" type="image/webp">'
                '<source srcset="/wp-content/themes/clinica-vocal/assets/local-acuarela-v2-900.webp" type="image/webp">'
                '<img fetchpriority="high" decoding="async" '
                'src="/wp-content/themes/clinica-vocal/assets/local-acuarela-v2-750.webp" '
                'width="750" height="500" '
                'alt="Ilustración en acuarela de la entrada a Clínica Vocal en Plasencia" '
                'style="aspect-ratio: 3/2; width: 100%; height: auto; max-width: 900px; display: block;">'
                '</picture>'
            )
        cleaned = re.sub(old_img_pattern, replace_acuarela, cleaned, count=1)
        
        # Also optimize the logo on welcome/hero with exact display dimensions (300x299 for mobile, 460x458 for retina/desktop)
        welcome_logo_picture = (
            '<picture>'
            '<source media="(max-width: 760px)" srcset="/wp-content/themes/clinica-vocal/assets/logo-negro-transparente-300.webp?v=5" type="image/webp" width="300" height="299">'
            '<source srcset="/wp-content/themes/clinica-vocal/assets/logo-negro-transparente-460.webp?v=5" type="image/webp" width="460" height="458">'
            '<img fetchpriority="high" decoding="async" class="cv-welcome-logo" '
            'src="/wp-content/themes/clinica-vocal/assets/logo-negro-transparente-300.webp?v=5" '
            'width="300" height="299" alt="Clínica Vocal · Cristina Iglesias">'
            '</picture>'
        )
        cleaned = re.sub(
            r'<img\s+[^>]*?class=[\'"][^\'"]*cv-welcome-logo[^\'"]*[\'"][^>]*?>',
            welcome_logo_picture,
            cleaned
        )
        
        # Header brand logo (44x44 CSS)
        cleaned = re.sub(
            r'(<a\s+class=[\'"]cv-brand[\'"][^>]*?>)\s*<img\s+[^>]*?>',
            r'\1<img src="/wp-content/themes/clinica-vocal/assets/logo-header.webp?v=5" width="44" height="44" alt="Logotipo de Clínica Vocal Cristina Iglesias">',
            cleaned
        )
        
        # Footer brand logo (175x175 CSS)
        cleaned = re.sub(
            r'(<div\s+class=[\'"]cv-footer-brand[\'"][^>]*?>\s*<a[^>]*?>)\s*<img\s+[^>]*?>',
            r'\1<img src="/wp-content/themes/clinica-vocal/assets/logo-footer.webp?v=5" width="175" height="175" alt="Logotipo de Clínica Vocal Cristina Iglesias">',
            cleaned
        )
        
        # Fallback generic logo replace
        cleaned = re.sub(
            r'<img\s+[^>]*?src=[\'"][^\'"]*logo(?:\.jpg|\.webp)[\'"][^>]*?>',
            '<img src="/wp-content/themes/clinica-vocal/assets/logo-header.webp?v=5" width="44" height="44" alt="Logotipo de Clínica Vocal Cristina Iglesias">',
            cleaned
        )
        
        # Responsive preloads in <head> for LCP & critical fonts
        preloads = (
            '<link rel="preload" as="image" href="/wp-content/themes/clinica-vocal/assets/local-acuarela-v2-480.webp" type="image/webp" media="(max-width: 520px)" fetchpriority="high">\n'
            '<link rel="preload" as="image" href="/wp-content/themes/clinica-vocal/assets/local-acuarela-v2-750.webp" type="image/webp" media="(min-width: 521px)" fetchpriority="high">\n'
            '<link rel="preload" as="image" href="/wp-content/themes/clinica-vocal/assets/logo-negro-transparente-300.webp?v=5" type="image/webp" media="(max-width: 760px)" fetchpriority="high">\n'
            '<link rel="preload" href="/wp-content/themes/clinica-vocal/assets/fonts/editorial.woff2" as="font" type="font/woff2" crossorigin>\n'
            '<link rel="preload" href="/wp-content/themes/clinica-vocal/assets/fonts/signature.woff2" as="font" type="font/woff2" crossorigin>\n'
        )
        cleaned = cleaned.replace('</head>', preloads + '</head>')
    else:
        # Header brand logo (44x44 CSS)
        cleaned = re.sub(
            r'(<a\s+class=[\'"]cv-brand[\'"][^>]*?>)\s*<img\s+[^>]*?>',
            r'\1<img src="/wp-content/themes/clinica-vocal/assets/logo-header.webp?v=5" width="44" height="44" alt="Logotipo de Clínica Vocal Cristina Iglesias">',
            cleaned
        )
        
        # Footer brand logo (175x175 CSS)
        cleaned = re.sub(
            r'(<div\s+class=[\'"]cv-footer-brand[\'"][^>]*?>\s*<a[^>]*?>)\s*<img\s+[^>]*?>',
            r'\1<img src="/wp-content/themes/clinica-vocal/assets/logo-footer.webp?v=5" width="175" height="175" alt="Logotipo de Clínica Vocal Cristina Iglesias">',
            cleaned
        )
        
        cleaned = re.sub(
            r'<img\s+[^>]*?src=[\'"][^\'"]*logo(?:\.jpg|\.webp)[\'"][^>]*?>',
            '<img src="/wp-content/themes/clinica-vocal/assets/logo-header.webp?v=5" width="44" height="44" alt="Logotipo de Clínica Vocal Cristina Iglesias">',
            cleaned
        )
        cleaned = re.sub(
            r'<img\s+[^>]*?class=[\'"][^\'"]*cv-welcome-logo[^\'"]*[\'"][^>]*?>',
            '<img fetchpriority="high" decoding="async" class="cv-welcome-logo" src="/wp-content/themes/clinica-vocal/assets/logo-negro-transparente-300.webp?v=5" width="300" height="299" alt="Clínica Vocal · Cristina Iglesias">',
            cleaned
        )
        cleaned = cleaned.replace(
            'src="/wp-content/themes/clinica-vocal/assets/logo-negro-transparente.png"',
            'src="/wp-content/themes/clinica-vocal/assets/logo-negro-transparente-300.webp?v=5"'
        )
        
    # 7. CSS BUNDLING & UNBLOCKING: Replace all 7 separate stylesheets with 1 single minified bundle
    # Strip Gutenberg block library styles entirely (not used)
    cleaned = re.sub(r'<link[^>]*wp-block-library[^>]*>', '', cleaned)
    
    # Replace the remaining theme styles with single bundled stylesheet
    css_patterns = [
        r'<link[^>]*astra-theme-css[^>]*>',
        r'<link[^>]*cv-design[^>]*>',
        r'<link[^>]*cv-overrides[^>]*>',
        r'<link[^>]*cv-third-review[^>]*>',
        r'<link[^>]*cv-footer-review[^>]*>',
        r'<link[^>]*cv-welcome[^>]*>',
        r'<link[^>]*cv-rediseno[^>]*>'
    ]
    bundle_tag_inserted = False
    for p in css_patterns:
        if not bundle_tag_inserted and re.search(p, cleaned):
            cleaned = re.sub(p, '<link rel="stylesheet" id="cv-bundle-css" href="/wp-content/themes/clinica-vocal/bundle.min.css?v=18" media="all" />', cleaned, count=1)
            bundle_tag_inserted = True
        else:
            cleaned = re.sub(p, '', cleaned)
            
    return cleaned

print(f"Rendering {len(routes)} pages headlessly...")
for route, name in routes:
    uri = "/" + route
    cmd = [php_exe, "-c", php_ini, "render_single_page.php", uri]
    res = subprocess.run(cmd, cwd=r"C:\Users\Aitor\.gemini\antigravity\scratch\ClinicaVocal", capture_output=True, text=True, encoding="utf-8", errors="ignore")
    
    if res.returncode != 0 or not res.stdout:
        print(f"  [FAIL] {uri} : return code {res.returncode}")
        continue
    
    html = optimize_html(res.stdout, route)
    
    if route == "":
        target_file = os.path.join(dist_dir, "index.html")
        with open(target_file, "w", encoding="utf-8") as f:
            f.write(html)
        print(f"  [OK] / -> index.html ({len(html)} bytes)")
    else:
        folder = os.path.join(dist_dir, route.strip("/"))
        os.makedirs(folder, exist_ok=True)
        target_file = os.path.join(folder, "index.html")
        with open(target_file, "w", encoding="utf-8") as f:
            f.write(html)
        
        flat_file = os.path.join(dist_dir, route.strip("/") + ".html")
        with open(flat_file, "w", encoding="utf-8") as f:
            f.write(html)
        print(f"  [OK] /{route} -> {route.strip('/')}/index.html ({len(html)} bytes)")

print("\nCopying & optimizing theme assets, plugins, and core assets...")

# 1. Clinica Vocal child theme assets
src_cv_theme = os.path.join(wp_dir, "wp-content", "themes", "clinica-vocal")
dst_cv_theme = os.path.join(dist_dir, "wp-content", "themes", "clinica-vocal")
if os.path.exists(src_cv_theme):
    shutil.copytree(src_cv_theme, dst_cv_theme, ignore=shutil.ignore_patterns("*.php", "*.sql", "*.bak"))
    print("  Copied clinica-vocal theme assets & styles")

# 2. Convert and optimize heavy assets in dst_cv_theme/assets
assets_dir = os.path.join(dst_cv_theme, "assets")
if os.path.exists(assets_dir):
    # A. local-acuarela-v2 multi-resolution responsive WebP
    acuarela_src = os.path.join(assets_dir, "local-acuarela-v2.png")
    if os.path.exists(acuarela_src):
        im = Image.open(acuarela_src)
        # 900x600 for desktop
        im_900 = im.resize((900, 600), Image.Resampling.LANCZOS)
        im_900.save(os.path.join(assets_dir, "local-acuarela-v2-900.webp"), "WEBP", quality=82, method=6)
        im_900.save(os.path.join(assets_dir, "local-acuarela-v2.webp"), "WEBP", quality=82, method=6)
        
        # 750x500 for tablet/small desktop
        im_750 = im.resize((750, 500), Image.Resampling.LANCZOS)
        im_750.save(os.path.join(assets_dir, "local-acuarela-v2-750.webp"), "WEBP", quality=80, method=6)
        
        # 480x320 for mobile phones
        im_480 = im.resize((480, 320), Image.Resampling.LANCZOS)
        im_480.save(os.path.join(assets_dir, "local-acuarela-v2-480.webp"), "WEBP", quality=78, method=6)
        
        # Also replace the png itself with optimized 750x500 PNG fallback
        im_750.save(acuarela_src, "PNG", optimize=True)
        print(f"  [RESPONSIVE WEBP] local-acuarela-v2: 900px={os.path.getsize(os.path.join(assets_dir, 'local-acuarela-v2-900.webp'))}B, 750px={os.path.getsize(os.path.join(assets_dir, 'local-acuarela-v2-750.webp'))}B, 480px={os.path.getsize(os.path.join(assets_dir, 'local-acuarela-v2-480.webp'))}B")

    # B. logo-negro-transparente responsive WebP
    logo_negro_src = os.path.join(assets_dir, "logo-negro-transparente.png")
    if os.path.exists(logo_negro_src):
        im_logo = Image.open(logo_negro_src)
        # 300x299 for mobile (exact match for 301x300 display)
        im_logo_300 = im_logo.resize((300, 299), Image.Resampling.LANCZOS)
        im_logo_300.save(os.path.join(assets_dir, "logo-negro-transparente-300.webp"), "WEBP", quality=78, method=6)
        im_logo_300.save(os.path.join(assets_dir, "logo-negro-transparente-v3.webp"), "WEBP", quality=78, method=6)
        im_logo_300.save(os.path.join(assets_dir, "logo-negro-transparente.webp"), "WEBP", quality=78, method=6)
        
        # 460x458 for desktop / high-res
        im_logo_460 = im_logo.resize((460, 458), Image.Resampling.LANCZOS)
        im_logo_460.save(os.path.join(assets_dir, "logo-negro-transparente-460.webp"), "WEBP", quality=78, method=6)
        print(f"  [OPTIMIZED LOGO HERO] 300px={os.path.getsize(os.path.join(assets_dir, 'logo-negro-transparente-300.webp'))}B, 460px={os.path.getsize(os.path.join(assets_dir, 'logo-negro-transparente-460.webp'))}B")

    # C. Header and Footer logos
    logo_jpg_src = os.path.join(assets_dir, "logo.jpg")
    if os.path.exists(logo_jpg_src):
        im_lj = Image.open(logo_jpg_src)
        # Header logo (90x90 for 44px display)
        im_header = im_lj.resize((90, 90), Image.Resampling.LANCZOS)
        im_header.save(os.path.join(assets_dir, "logo-header.webp"), "WEBP", quality=80, method=6)
        
        # Footer logo (200x200 for 175px display)
        im_footer = im_lj.resize((200, 200), Image.Resampling.LANCZOS)
        im_footer.save(os.path.join(assets_dir, "logo-footer.webp"), "WEBP", quality=80, method=6)
        im_footer.save(os.path.join(assets_dir, "logo-v3.webp"), "WEBP", quality=80, method=6)
        im_footer.save(os.path.join(assets_dir, "logo.webp"), "WEBP", quality=80, method=6)
        print(f"  [OPTIMIZED LOGOS BRAND] header={os.path.getsize(os.path.join(assets_dir, 'logo-header.webp'))}B, footer={os.path.getsize(os.path.join(assets_dir, 'logo-footer.webp'))}B")

# 3. Create single unified bundled stylesheet (bundle.min.css)
bundle_css_path = os.path.join(dst_cv_theme, "bundle.min.css")
css_sources = [
    os.path.join(src_cv_theme, "style.css"),
    os.path.join(src_cv_theme, "overrides.css"),
    os.path.join(src_cv_theme, "third-review.css"),
    os.path.join(src_cv_theme, "footer-review.css"),
    os.path.join(src_cv_theme, "welcome.css"),
    os.path.join(src_cv_theme, "rediseno-claude.css")  # Rediseño Claude: siempre el último
]
combined_css = ".screen-reader-text{border:0;clip:rect(1px,1px,1px,1px);clip-path:inset(50%);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px;word-wrap:normal!important;}\n"
for cs in css_sources:
    if os.path.exists(cs):
        with open(cs, "r", encoding="utf-8", errors="ignore") as f:
            combined_css += "\n" + f.read()

# Minify bundle
combined_css = re.sub(r'/\*.*?\*/', '', combined_css, flags=re.DOTALL)
combined_css = re.sub(r'\s+', ' ', combined_css)
combined_css = re.sub(r'\s*([\{\}\:\;\,])\s*', r'\1', combined_css)
combined_css = combined_css.replace(';}', '}')

with open(bundle_css_path, "w", encoding="utf-8") as f:
    f.write(combined_css.strip())
print(f"  [CSS BUNDLE CREATED] {bundle_css_path} ({len(combined_css)} bytes minified)")

# 3. Minify all CSS files in child theme
def minify_css_file(filepath):
    try:
        with open(filepath, 'r', encoding='utf-8', errors='ignore') as f:
            c = f.read()
        c = re.sub(r'/\*.*?\*/', '', c, flags=re.DOTALL)
        c = re.sub(r'\s+', ' ', c)
        c = re.sub(r'\s*([\{\}\:\;\,])\s*', r'\1', c)
        c = c.replace(';}', '}')
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(c.strip())
    except Exception as e:
        print(f"  CSS min error {filepath}: {e}")

for root, _, files in os.walk(dst_cv_theme):
    for fl in files:
        if fl.endswith('.css'):
            minify_css_file(os.path.join(root, fl))
print("  Minified all theme stylesheets (third-review.css, style.css, overrides.css, footer-review.css, welcome.css)")

# 3. Astra theme assets (CSS, JS, fonts)
src_astra = os.path.join(wp_dir, "wp-content", "themes", "astra")
dst_astra = os.path.join(dist_dir, "wp-content", "themes", "astra")
if os.path.exists(src_astra):
    shutil.copytree(src_astra, dst_astra, ignore=shutil.ignore_patterns("*.php", "*.po", "*.mo"))
    print("  Copied astra theme styles & scripts")

# 4. wp-includes (CSS, JS, fonts)
src_includes = os.path.join(wp_dir, "wp-includes")
dst_includes = os.path.join(dist_dir, "wp-includes")
if os.path.exists(src_includes):
    shutil.copytree(src_includes, dst_includes, ignore=shutil.ignore_patterns("*.php"))
    print("  Copied wp-includes assets")

# 5. wp-content/uploads
src_uploads = os.path.join(wp_dir, "wp-content", "uploads")
dst_uploads = os.path.join(dist_dir, "wp-content", "uploads")
if os.path.exists(src_uploads):
    shutil.copytree(src_uploads, dst_uploads, ignore=shutil.ignore_patterns("*.php", "*.log"))
    print("  Copied uploads")

# 6. Root favicon & robots.txt
src_logo = os.path.join(wp_dir, "wp-content", "themes", "clinica-vocal", "assets", "logo.jpg")
if os.path.exists(src_logo):
    shutil.copy2(src_logo, os.path.join(dist_dir, "favicon.ico"))
    print("  Created root favicon.ico")

with open(os.path.join(dist_dir, "robots.txt"), "w", encoding="utf-8") as f:
    f.write("User-agent: *\nAllow: /\n\nSitemap: https://www.clinicavocal.es/sitemap.xml\n")

# Generate sitemap.xml
with open(os.path.join(dist_dir, "sitemap.xml"), "w", encoding="utf-8") as f:
    f.write('<?xml version="1.0" encoding="UTF-8"?>\n')
    f.write('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">\n')
    for route, _ in routes:
        u = f"https://www.clinicavocal.es/{route}".rstrip("/") + ("/" if route else "/")
        priority = "1.0" if route == "" else ("0.8" if route in ["psicologia/", "logopedia/", "centros/", "contacto/"] else "0.6")
        f.write(f'  <url>\n    <loc>{u}</loc>\n    <changefreq>weekly</changefreq>\n    <priority>{priority}</priority>\n  </url>\n')
    f.write('</urlset>\n')
print("  Generated sitemap.xml with all 20 production routes")

# Cloudflare _headers for optimal caching & security
with open(os.path.join(dist_dir, "_headers"), "w", encoding="utf-8") as f:
    f.write("""/*
  X-Frame-Options: SAMEORIGIN
  X-Content-Type-Options: nosniff
  Referrer-Policy: strict-origin-when-cross-origin
  Strict-Transport-Security: max-age=31536000; includeSubDomains; preload

/wp-content/themes/clinica-vocal/assets/*
  Cache-Control: public, max-age=31536000, immutable

/wp-content/*
  Cache-Control: public, max-age=2592000

/wp-includes/*
  Cache-Control: public, max-age=2592000
""")

print("\n--- CLINICA VOCAL STATIC EXPORT (OPTIMIZED V2) COMPLETED SUCCESSFULLY! ---")
