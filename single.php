<?php get_header(); ?>
	<div class="ts narrow container" style="padding-top: 20px;"><div class="ts stackable grid">
		<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
		<div class="twelve wide column">
			
			<div class="ts vertically very padded left aligned slate post">
				<div class="image">
					<script src="https://cdn.gnehs.com.tw/cdn/randompicture.js"></script>   
				</div>
				<span class="header"><?php the_title(); ?></span>
				<span class="description">
					<?php the_time('Y年n月j日') ?>
					<?php comments_popup_link('還沒有人留言', '1 則留言', '% 則留言', '', '已關閉留言'); ?>
					<?php edit_post_link('編輯', ''); ?>
				</span>
				<span class="description">
					<?php the_category(' ') ?>
				</span>
				<div class="action" id="PostOperation">
					<a class="ts inverted basic button" href="<?php echo get_post_meta($post->ID, $prefix . 'tg-link', true); ?>">加入</a>
				</div>						  
			</div>
			
			<div class="ts hidden divider"></div>
			
			<post>
				<?php the_content(); ?>
			</post>
			
			<div class="ts divider"></div>
			
			<?php comments_template(); ?>
		</div>
		<?php endif; ?>
		
		<div class="four wide column">
			<?php get_sidebar(); ?>
		</div>
	</div></div>
<?php get_footer(); ?>