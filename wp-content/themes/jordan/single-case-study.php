<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div class="case-<?php echo get_field('short_name'); ?>">

		<div class="hero" style="background-image:url(<?php the_post_thumbnail_url(); ?>);">
			<div class="shadow"></div>
			<div class="hero-overlay">
				<h1 class="large"><?php echo get_field('hero_title'); ?></h1>
				<h3 class="tagline"><?php echo get_field('tagline'); ?></h3>
			</div>
			<div class="project-details">
				<p class="role"><span>Role </span><?php echo get_field('role'); ?></p>
				<p class="date"><span>When </span><?php echo get_field('date_completed'); ?></p>
				<div class="clearfix"></div>
			</div>		
		</div>

		<div class="mockup">
			<?php $mock_image = get_field('mockup_image'); ?>
			<img src="<?php echo $mock_image['url']; ?>" alt="">
		</div>
		<div class="clearfix"></div>
		<div class="case-study-info">
			<?php $bg_logo = get_field('info_background_logo'); ?>
			<div class="brief" style="background-image:url(<?php echo $bg_logo['url']; ?>);background-color:<?php the_field('brand_primary_color'); ?>">
				<h4>Project Info</h4>
				<p><?php the_field('project_info'); ?></p>
			</div>
			<div class="color-scheme">
				<div class="color" style="background:<?php the_field('brand_primary_color'); ?>"></div>
				<div class="color" style="background:<?php the_field('color_two'); ?>"></div>
				<div class="color" style="background:<?php the_field('color_three'); ?>"></div>
				<div class="color" style="background:<?php the_field('color_four'); ?>"></div>
			</div>
			<div class="case-study-tech-tools">
				<h4>Tools/Technology Used</h4>
				<div class="clearfix"></div>
				<?php $field = get_field_object('tools'); ?>
				<?php $tools = $field['value']; ?>
				<?php foreach ( $tools as $tool ): ?>
					<li>
						<svg style="fill:<?php the_field('brand_primary_color'); ?>"><use xlink:href="#<?php echo $tool; ?>"></use></svg>
						 - <?php echo $field['choices'][ $tool ]; ?>
					</li>
				<?php endforeach; ?>
			</div>
			<div class="case-study-tech-tools">
				<h4>Additional Responsibilities</h4>
				<div class="clearfix"></div>
				<p><?php the_field('responsibilities'); ?></p>
			</div>
			<div class="next-project">
				<h4>Next Project</h4>
				<?php $post_object = get_field('related_project'); ?>
				<?php if( $post_object ): ?>
				<?php
					$post = $post_object;
					setup_postdata( $post ); 
				?>
			    <div class="next-container" style="background-color:<?php the_field('brand_primary_color'); ?>">
			    	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			    	<span><?php the_field('tagline'); ?></span>
			    </div>
			    <?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>

	<!-- <div id="contact">
		<div class="main-wrap">
			<h2>Let's Work Together</h2>
			<?php gravity_form(1, false, false, false, '', true, 12); ?>
		</div>
	</div> -->

<?php endwhile; endif; ?>