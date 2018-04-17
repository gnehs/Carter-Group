<?php get_header(); ?>
	<div class="ts narrow container" style="padding-top: 20px;"><div class="ts stackable grid">
		<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
		<div class="twelve wide column">
			<div class="ts heading vertically padded slate attached post">
				<div class="image">
					<script>
						var perviewImg = Trianglify({
							width: 1600,
							height: 900,
							stroke_width: 60,
							cell_size: 80,
						});
						document.write('<img src="' + perviewImg.png() + '">');
					</script> 
				</div>
				<span class="header"><?php the_title(); ?></span>
				<span class="description"><i class="calendar icon"></i><?php the_time('Y/n/j') ?>
										  <i class="tag icon"></i><?php the_category(' ') ?> 
										  <i class="comment icon"></i><?php comments_popup_link(__( 'No one commented', 'Carter' ), __( '1 Comment', 'Carter' ),__( '% Comments', 'Carter' ), '',__( 'Comments are closed', 'Carter' )); ?> 
										  <?php edit_post_link('<i class="pencil icon"></i>'); ?><?php edit_post_link(__( 'Edit', 'Carter' ), ''); ?></span>
			</div>
			<a class="ts fluid bottom attached button" href="<?php echo get_post_meta($post->ID, $prefix . 'tg-link', true); ?>" data-dark>加入</a>
			
			<div class="ts hidden divider"></div>
			
			<post data-dark>
				<?php the_content(); ?>
			</post>
			
			<div class="ts clearing divider" data-dark></div>

    		<h3 class="ts header" data-dark>
				<?php esc_html_e( 'Share', 'Carter' ); ?>
				<div class="sub header"><?php esc_html_e( 'Share to your friends', 'Carter' ); ?></div>
			</h3>
			<div class="ts primary large icon separated buttons" id="share" data-dark='primary'>
    			<a class="ts button" href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&t=<?php the_title(); ?>"><i class="icon facebook f"></i></a>
    			<a class="ts button" href="https://telegram.me/share/url?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>"><i class="icon telegram"></i></a>
    			<a class="ts button" href="https://www.tumblr.com/widgets/share/tool?shareSource=legacy&canonicalUrl=&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>"><i class="icon tumblr"></i></a>
    			<a class="ts button" href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>"><i class="icon twitter"></i></a>
    			<a class="ts button" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="icon google plus"></i></a>
			</div>
			<div class="ts clearing divider" data-dark></div>
			
			<?php comments_template(); ?>
		</div>
		<?php endif; ?>
		
		<div class="four wide column">
			<?php get_sidebar(); ?>
		</div>
	</div></div>
<?php get_footer(); ?>