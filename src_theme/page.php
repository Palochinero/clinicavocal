<?php
get_header(); ?>
<div class="cv-wrap cv-wide-page-wrap">
    <main class="cv-page cv-page-fullwidth" id="contenido">
        <?php while (have_posts()): the_post(); ?>
            <?php 
            // Las páginas de especialidades, centros, equipo y perfiles tienen su propio encabezado H1 enriquecido
            $has_custom_hero = is_page(array(
                'contacto', 'plasencia', 'navaconcejo', 'centros', 
                'logopedia', 'psicologia', 'equipo', 'inicio',
                'cristina-iglesias-martin', 'jessica-serrano-diaz', 
                'andrea-montero-regadera', 'belen-mesa-montero',
                'aviso-legal', 'privacidad', 'cookies', 'blog'
            )) || ($post->post_parent && in_array(get_post($post->post_parent)->post_name, array('equipo', 'centros')));
            
            if (!$has_custom_hero): ?>
                <h1 class="cv-page-title"><?php the_title(); ?></h1>
            <?php endif; ?>
            <?php the_content(); ?>
        <?php endwhile; ?>
    </main>
</div>
<?php get_footer(); ?>
