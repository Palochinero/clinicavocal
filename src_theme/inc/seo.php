<?php
defined('ABSPATH') || exit;
add_filter('pre_get_document_title',function($title) {
    if(is_singular() && cv_meta('seo_title')) return cv_meta('seo_title');
    if(is_404()) return 'Página no encontrada | Clínica Vocal';
    return $title;
});
add_filter('wp_robots',function($robots) {
    if(is_archive() || is_search() || is_404() || isset($_GET['tema']) || isset($_GET['buscar']) || isset($_GET['pagina'])) { $robots['noindex']=true; unset($robots['index']); }
    return $robots;
});
add_filter('wp_sitemaps_add_provider',function($provider,$name) { return in_array($name,['users','taxonomies']) ? false : $provider; },10,2);
add_action('template_redirect',function() {
    if(is_author() || is_date()) { wp_safe_redirect(home_url('/blog/'),301); exit; }
    if(is_category()) { $term=get_queried_object(); wp_safe_redirect(add_query_arg('tema',$term->slug,home_url('/blog/')),301); exit; }
});
add_action('wp_head',function() {
    echo '<meta name="theme-color" content="#1C1A17">';
    foreach (['editorial','sans'] as $font) echo '<link rel="preload" as="font" type="font/woff2" crossorigin href="'.esc_url(cv_asset('fonts/'.$font.'.woff2')).'">';
    if (is_front_page()) echo '<link rel="preload" as="font" type="font/woff2" crossorigin href="'.esc_url(cv_asset('fonts/signature.woff2')).'">';
    if(!is_singular()) return;
    $id=get_queried_object_id(); $url=get_permalink($id); $home=home_url('/'); $description=cv_meta('description',$id) ?: wp_strip_all_tags(get_the_excerpt($id));
    $title=cv_meta('seo_title',$id) ?: get_the_title($id).' | Clínica Vocal';
    $image=cv_asset(cv_meta('art',$id) ?: 'clinica-fachada.webp');
    echo '<meta name="description" content="'.esc_attr($description).'">'."\n";
    foreach(['og:locale'=>'es_ES','og:type'=>is_singular('post')?'article':'website','og:site_name'=>'Clínica Vocal Cristina Iglesias','og:title'=>$title,'og:description'=>$description,'og:url'=>$url,'og:image'=>$image,'og:image:alt'=>cv_meta('art',$id)?'Ilustración de Clínica Vocal':'Fachada de Clínica Vocal'] as $key=>$value) echo '<meta property="'.esc_attr($key).'" content="'.esc_attr($value).'">'."\n";
    echo '<meta name="twitter:card" content="summary_large_image">'."\n";
    $org=['@type'=>'Organization','@id'=>$home.'#organizacion','name'=>'Clínica Vocal Cristina Iglesias','url'=>$home,'logo'=>['@type'=>'ImageObject','url'=>cv_asset('logo.jpg')],'telephone'=>'+34611169264'];
    $graph=[$org,['@type'=>'WebSite','@id'=>$home.'#website','url'=>$home,'name'=>'Clínica Vocal','publisher'=>['@id'=>$home.'#organizacion'],'inLanguage'=>'es-ES'],['@type'=>'WebPage','@id'=>$url.'#webpage','url'=>$url,'name'=>$title,'description'=>$description,'inLanguage'=>'es-ES','isPartOf'=>['@id'=>$home.'#website']]];
    $locations=['plasencia'=>['Plasencia','Calle Sierra de Tormantos, 22','10600'],'navaconcejo'=>['Navaconcejo','Avenida de Extremadura, 117','10613']];
    $path=trim(get_page_uri($id) ?: '', '/');
    if (is_front_page() || in_array($path,['centros','contacto','centros/plasencia','centros/navaconcejo'])) foreach($locations as $slug=>[$city,$street,$postal]) {
        if(str_starts_with($path,'centros/') && $path!=='centros/'.$slug) continue;
        $locurl=home_url('/centros/'.$slug.'/');
        $graph[]=['@type'=>'MedicalClinic','@id'=>$locurl.'#centro','name'=>'Clínica Vocal '.$city,'url'=>$locurl,'telephone'=>'+34611169264','image'=>cv_asset('logo.jpg'),'parentOrganization'=>['@id'=>$home.'#organizacion'],'address'=>['@type'=>'PostalAddress','streetAddress'=>$street,'postalCode'=>$postal,'addressLocality'=>$city,'addressRegion'=>'Cáceres','addressCountry'=>'ES']];
    }
    if(!is_front_page()) { $crumbs=[]; foreach(cv_breadcrumb_items() as $i=>[$name,$link]) $crumbs[]=['@type'=>'ListItem','position'=>$i+1,'name'=>$name,'item'=>$link]; $graph[]=['@type'=>'BreadcrumbList','@id'=>$url.'#breadcrumb','itemListElement'=>$crumbs]; }
    if(in_array($path,['logopedia','psicologia','voz-profesional','psicologia/online'])) $graph[]=['@type'=>'Service','@id'=>$url.'#servicio','name'=>get_the_title($id),'url'=>$url,'description'=>$description,'provider'=>['@id'=>$home.'#organizacion'],'areaServed'=>$path==='psicologia/online'?'España':['Plasencia','Navaconcejo','Valle del Jerte']];
    if(str_starts_with($path,'equipo/') && cv_meta('role',$id)) $graph[]=['@type'=>'Person','@id'=>$url.'#profesional','name'=>get_the_title($id),'jobTitle'=>cv_meta('role',$id),'url'=>$url,'worksFor'=>['@id'=>$home.'#organizacion']];
    if($path==='blog') $graph[]=['@type'=>'Blog','@id'=>$url.'#blog','name'=>'Cuaderno Vocal','url'=>$url,'description'=>$description,'publisher'=>['@id'=>$home.'#organizacion'],'inLanguage'=>'es-ES'];
    if(is_page() && preg_match_all('~<details><summary>(.*?)</summary><p>(.*?)</p></details>~s',get_post_field('post_content',$id),$matches,PREG_SET_ORDER)) {
        $questions=[];
        foreach($matches as $match) $questions[]=['@type'=>'Question','name'=>wp_strip_all_tags($match[1]),'acceptedAnswer'=>['@type'=>'Answer','text'=>wp_strip_all_tags($match[2])]];
        $graph[]=['@type'=>'FAQPage','@id'=>$url.'#preguntas','mainEntity'=>$questions];
    }
    if(is_singular('post')) $graph[]=['@type'=>'BlogPosting','@id'=>$url.'#articulo','headline'=>get_the_title($id),'description'=>$description,'url'=>$url,'mainEntityOfPage'=>['@id'=>$url.'#webpage'],'image'=>[$image],'datePublished'=>get_the_date('c',$id),'dateModified'=>get_the_modified_date('c',$id),'author'=>['@id'=>$home.'#organizacion'],'publisher'=>['@id'=>$home.'#organizacion'],'inLanguage'=>'es-ES'];
    echo '<script type="application/ld+json">'.wp_json_encode(['@context'=>'https://schema.org','@graph'=>$graph],JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_HEX_TAG).'</script>'."\n";
}, 20);
