<?php
/**
 * Plantilla para los posts de Blog
 */
get_header();
?>

<main class="site-main">
	<header class="uk-container uk-padding-remove-bottom">
		<nav class="section-nav uk-margin-small-bottom">
			<a href="<?php echo home_url();?>/noticias" class="uk-button uk-button-text uk-text-small uk-text-uppercase">
				<span class="fal fa-arrow-left"></span> Blog
			</a>
		</nav>
		<h1 class="uk-margin-medium-bottom"><?php the_title(); ?></h1>
		<p class="uk-text-meta uk-margin-bottom"><?php echo get_the_date('j \d\e\ F Y');?></p>
	</header>

	<?php if( has_post_thumbnail() ) {
		$post_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
	?>
		<figure class="uk-cover-container uk-height-large">
			<img src="<?php echo $post_thumb[0]; ?>" alt="" uk-cover>
		</figure>
	<?php } ?>

	<section class="section-content uk-section uk-container">
		<article class="entry-content">
			<?php the_content(); ?>
		</article>
	</section>
</main>

<?php get_footer(); ?>