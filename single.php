<?php get_header(); ?>
	<?php if ( in_category(get_cat_ID('NSFW')) ) { ?>	
		<style>.swal-overlay {background-color: rgba(66, 66, 66, 1);}</style>
		<script>
			if(!window.localStorage["adultAlert"]){
				swal({
					title: "警告 WARNING",
					text: "該內容可能令人反感；不可將本物品內容派發，傳閱，出售，出租，交給或出借予年齡未滿 18 歲的人士出示，播放或播映。This article contains material which may offernd and may not be distributed, circulated, sold, hired, given, lent, shown, played or projected to a person under the age of 18 years. All models are 18 or older. ",
					icon: "info",
					buttons: true,
					dangerMode: true,
				}).then((value) => {
					if (!value)
						document.location.href="/";
					else
						window.localStorage["adultAlert"] = true
				});
			}
		</script>
	<?php } ?>
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
			<?php if ( in_category(get_cat_ID('NSFW')) ) { ?>
				<a class="ts fluid bottom attached button" data-R18href="<?php echo get_post_meta($post->ID, $prefix . 'tg-link', true); ?>" data-dark>加入</a>
			<?php } else { ?>
				<a class="ts fluid bottom attached button" href="<?php echo get_post_meta($post->ID, $prefix . 'tg-link', true); ?>" data-dark>加入</a>
			<?php } ?>
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