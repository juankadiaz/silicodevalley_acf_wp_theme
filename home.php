<?php
/**
 * Plantilla para la página de blog
 */
get_header();
?>

<header class="uk-section uk-padding-remove-bottom">
	<section class="uk-container uk-container-small uk-padding-remove">
		<h1 class="section-title uk-margin-medium-bottom"><?php single_post_title(); ?></h1>
	</section>
</header>
<section class="page-content">
	<section class="uk-section uk-padding-remove-top">
		<div class="uk-container uk-padding-large">
			<ul class="uk-grid-column-large uk-grid-row-large uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid uk-height-match="target: li > a > .uk-card">
			<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', 'excerpt-blog' );
				endwhile;
			?>
			</ul>
		</div>
	</section>
</section>

<?php get_footer(); ?>