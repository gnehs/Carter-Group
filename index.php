<?php get_header(); ?>
<div class="ts narrow container" style="padding-top: 20px;"><div class="ts stackable grid">
    <div class="twelve wide column">
		<!-- Blog Post -->
		<div class="ts two stackable waterfall cards">
		<?php $category_id_ch = get_cat_ID('頻道'); ?>
		<?php $category_id_group = get_cat_ID('群組'); ?>
		<?php $category_id_info = get_cat_ID('公告'); ?>
		<?php $category_id_site= get_cat_ID('網站'); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php if ( in_category($category_id_ch) ) { ?>
				<div class="ts inverted ch card" target="_blank">
			<?php }elseif ( in_category($category_id_group) ) { ?>
				<div class="ts inverted group card" target="_blank">
			<?php }elseif ( in_category($category_id_info) ) { ?>
				<div class="ts inverted info card" target="_blank">
			<?php }elseif ( in_category($category_id_site) ) { ?>
				<div class="ts inverted site card" target="_blank">
			<?php } else { ?>
				<div class="ts inverted card" target="_blank">
			<?php } ?>
		
			<div class="content">
				<div class="header"><?php the_title(); ?></div>
				<div class="meta">
					<a><?php the_time('Y年n月j日') ?></a>
				</div>
				<div class="meta">
					<?php the_category(' ') ?>
				</div>
				<div class="description">
					<?php the_excerpt(); ?>
				</div>
			</div>
			<div class="ts fluid bottom attached buttons post operation">
				<a class="ts opinion labeled icon button click load" href="<?php echo get_post_meta($post->ID, $prefix . 'tg-link', true); ?>"><i class="add user icon"></i>加入</a>
				<a class="ts secondary opinion labeled icon button click load" href="<?php the_permalink(); ?>"><i class="book icon"></i>閱讀</a>
				<?php edit_post_link( '<i class="write icon"></i>編輯', '', '', '','ts secondary opinion labeled icon button click load' ); ?> 
			</div>
		</div>
		<?php endwhile; ?>
		</div>
		<!-- Blog Navigation -->
		<p class="clearfix"></p>
		<div class="ts fluid buttons">
			<?php previous_posts_link('上一頁'); ?><?php next_posts_link('下一頁'); ?>
		</div>
		<?php endif; ?>
	</div>
    <div class="four wide column">
		<?php get_sidebar(); ?>
	</div>
</div></div>

<?php get_footer(); ?>