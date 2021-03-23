<?php 
/*  Template part for the excerpt of blog posts
*/
?>

<li>
	<a href="<?php the_permalink() ?>">
		<div class="uk-card uk-card-default uk-card-hover">
			<figure class="uk-card-media-top">
				<?php the_post_thumbnail('medium'); ?>
			</figure>
			<div class="uk-card-body">
				<h3 class="uk-h4 uk-margin-small-bottom"><?php the_title(); ?></h3>
				<p class="uk-text-small uk-text-muted uk-margin-remove-bottom"><?php echo get_the_date('j \d\e\ F Y');?></p>
			</div>
		</div>
	</a>
</li>