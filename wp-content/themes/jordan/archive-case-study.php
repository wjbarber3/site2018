<?php ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div class="col-sm-4 case-study">
		<div class="inner" style="background-image:url(<?php the_post_thumbnail_url('large'); ?>);">
			<div class="shadow"></div>
			<a href="<?php echo the_permalink(); ?>"></a>
			<div class="case-overlay">
				<h3><?php echo the_title(); ?></h3>
			</div>
		</div>
	</div>

<?php endwhile; endif; ?>
