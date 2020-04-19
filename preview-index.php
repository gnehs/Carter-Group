<?php
$category_id_ch    = get_cat_ID('📣頻道');
$category_id_group = get_cat_ID('👥群組');
$category_id_info  = get_cat_ID('👤公告');
$category_id_site  = get_cat_ID('🧭網站');
?>

<div class="preview-index">
	<div class="ts inverted dimmer">
		<div class="ts loader"></div>
	</div>
	<div>
		<?php edit_post_link('<i class="write icon"></i>', '', '', '', 'ts large icon right floated edit opinion button m-8'); ?>
		<div class="header-wrapper">
			<div class="bg" style="background-image:url('<?php echo (has_post_thumbnail() ? the_post_thumbnail_url() : "https://picsum.photos/80?" . rand()) ?>')"></div>
		</div>
		<div class="header">
			<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<div class="meta">
				<?php if (in_category($category_id_ch)) { ?>
					<div><i class="bullhorn icon"></i>頻道</div>
				<?php } elseif (in_category($category_id_group)) { ?>
					<div><i class="user friends icon"></i>群組</div>
				<?php } else { ?>
					<div><i class="file alt outline icon"></i>文章</div>
				<?php } ?>
				<div><i class="calendar icon outline"></i><?php the_time('Y/n/j') ?></div>
				<div><i class="comment icon outline"></i><?php comments_number(__('No one commented', 'Carter'), __('1 Comment', 'Carter'), __('% Comments', 'Carter')); ?></div>
				<div><i class="user icon outline"></i><?php the_author(); ?></div>
			</div>
		</div>
		<div class="description">
			<?php the_tags('<div class="ts horizontal basic label">', '</div><div class="ts horizontal basic label">', '</div>'); ?>
			<?php the_content(''); ?>
		</div>
		<div class="continue">
			<?php if (in_category($category_id_ch)) { ?>
				<a class="ts join right labeled icon info button" target="_blank" href="<?php echo get_post_meta($post->ID, $prefix . 'tg-link', true); ?>">
					加入頻道<i class="plus icon"></i>
				</a>
				<a href="<?php the_permalink(); ?>" class="ts right labeled icon button">
					查看留言
					<i class="angle right icon"></i>
				</a>
			<?php } elseif (in_category($category_id_group)) { ?>
				<a class="ts join right labeled icon primary button" target="_blank" href="<?php echo get_post_meta($post->ID, $prefix . 'tg-link', true); ?>">
					加入群組<i class="plus icon"></i>
				</a>
				<a href="<?php the_permalink(); ?>" class="ts right labeled icon button">
					查看留言
					<i class="angle right icon"></i>
				</a>
			<?php } else { ?>
				<a href="<?php the_permalink(); ?>" class="ts right labeled icon button">
					<?php esc_html_e('Read More', 'Carter'); ?>
					<i class="angle right icon"></i>
				</a>
			<?php } ?>
		</div>
	</div>
</div>
<?php /*
<!--
<?php if (in_category($category_id_ch)) { ?>
	<div class="ts inverted ch card">
<?php } elseif (in_category($category_id_group)) { ?>
	<div class="ts inverted group card">
<?php } elseif (in_category($category_id_info)) { ?>
	<div class="ts inverted info card">
<?php } elseif (in_category($category_id_site)) { ?>
	<div class="ts inverted site card">
<?php } else { ?>
	<div class="ts inverted card">
<?php } ?>-->*/
?>