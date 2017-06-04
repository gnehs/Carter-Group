<?php get_header(); ?>
<div class="ts narrow container" style="padding-top: 20px;"><div class="ts stackable grid">
    
<?php if ( have_posts() ) : ?>
<div class="twelve wide column"><div class="ts two stackable waterfall cards">

		<?php $category_id_ch = get_cat_ID('頻道'); ?>
		<?php $category_id_group = get_cat_ID('群組'); ?>
		<?php $category_id_info = get_cat_ID('公告'); ?>
		<?php $category_id_site= get_cat_ID('網站'); ?>
<?php while ( have_posts() ) : the_post(); ?>
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
					<a><?php edit_post_link('編輯', ''); ?></a>
					<a><?php the_category(‘,’) ?></a>
				</div>
				<div class="description">
					<?php the_excerpt(); ?>
				</div>
			</div>
			<div class="ts fluid bottom attached buttons">
				<a class="ts opinion button" href="<?php echo get_post_meta($post->ID, $prefix . 'tg-link', true); ?>">加入</a>
				<a class="ts secondary opinion button" href="<?php the_permalink(); ?>">更多資訊</a>
			</div>
		</div>
<?php endwhile; ?>
</div></div>
<?php else : ?>
<div class="twelve wide column"><br>
	<div class="ts large heading slate">
		<span class="header">搜尋結果</span>
		<span class="description">找不到你要的文章，要不要換個關鍵字看看?</span>
		<div class="action">
			<a class="ts primary button" title="<?php bloginfo('name'); ?>"  href="<?php echo get_option('home'); ?>/">回去首頁</a>
		</div>
	</div>
</div>
<?php endif; ?>
    <div class="four wide column">
		<?php get_sidebar(); ?>
	</div>
</div></div>

<?php get_footer(); ?>