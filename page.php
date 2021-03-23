<?php
/**
 * Plantilla por defecto para las páginas
 */
get_header();
?>

<main class="uk-container uk-margin">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h1 class="uk-h1"><?php the_title(); ?></h1>
		<?php the_content( ); ?>
	<?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>