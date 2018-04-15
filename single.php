<?php get_header(); ?>
	<div class="ts narrow container" style="padding-top: 20px;"><div class="ts stackable grid">
		<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
		<div class="twelve wide column">
			<div class="ts heading vertically padded slate attached post">
				<script>
					var perviewImg = Trianglify({
						width: 1600,
						height: 900,
					});
					document.write('<img src="' + perviewImg.png() + '">');
				</script>
				<span class="header"><?php the_title(); ?></span>
				<span class="description"><?php the_time('Y/n/j') ?> <?php edit_post_link(__( 'Edit', 'Carter' ), ''); ?><?php the_category(' ') ?></span>
			</div>
			<a class="ts fluid bottom attached button" href="<?php echo get_post_meta($post->ID, $prefix . 'tg-link', true); ?>">加入</a>
			
			<div class="ts hidden divider"></div>
			
			<post>
				<?php the_content(); ?>
			</post>
			
			<div class="ts clearing divider"></div>
			
			<?php comments_template(); ?>
		</div>
		<?php endif; ?>
		
		<div class="four wide column">
			<?php get_sidebar(); ?>
		</div>
	</div></div>
<?php get_footer(); ?>