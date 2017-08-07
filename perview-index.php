<?php $category_id_ch = get_cat_ID('頻道'); ?>
<?php $category_id_group = get_cat_ID('群組'); ?>
<?php $category_id_info = get_cat_ID('公告'); ?>
<?php $category_id_site= get_cat_ID('網站'); ?>
<?php if ( in_category($category_id_ch) ) { ?>
	<div class="ts inverted ch card">
<?php }elseif ( in_category($category_id_group) ) { ?>
	<div class="ts inverted group card">
<?php }elseif ( in_category($category_id_info) ) { ?>
	<div class="ts inverted info card">
<?php }elseif ( in_category($category_id_site) ) { ?>
	<div class="ts inverted site card">
<?php } else { ?>
	<div class="ts inverted card">
<?php } ?>
	<div class="content">
		<div class="header"><?php the_title(); ?></div>
		<div class="meta">
			<a><?php the_time('Y年n月j日') ?></a>
			<a><?php edit_post_link('編輯', ''); ?></a>
			<a><?php the_category(' ') ?></a>
		</div>
		<div class="description">
			<?php the_excerpt(); ?>
		</div>
	</div>
	<div class="ts fluid bottom attached buttons post operation">
		<a class="ts opinion button" href="<?php echo get_post_meta($post->ID, $prefix . 'tg-link', true); ?>">加入</a>
		<a class="ts opinion button click load" href="<?php the_permalink(); ?>">更多資訊</a>
		<?php edit_post_link( __( 'Edit', 'Carter' ), '', '', '','ts opinion button click load' ); ?> 
	</div>
</div>