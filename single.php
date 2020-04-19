<?php get_header(); ?>
<?php
$category_id_ch    = get_cat_ID('📣頻道');
$category_id_group = get_cat_ID('👥群組');
$category_id_info  = get_cat_ID('👤公告');
$category_id_site  = get_cat_ID('🧭網站');
?>
<?php if (have_posts()) : the_post();
	update_post_caches($posts); ?>
	<div id="content" class="single">
		<?php edit_post_link('<i class="write icon"></i>', '', '', '', 'ts large icon right floated edit opinion button m-16'); ?>
		<div class="header-wrapper">
			<div class="bg" style="background-image:url('<?php echo (has_post_thumbnail() ? the_post_thumbnail_url() : "https://picsum.photos/1200#" . rand()) ?>')"></div>
		</div>
		<div class="ts narrow container header">
			<div class="title"><?php the_title(); ?></div>
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
			</div>
		</div>
		<div class="ts narrow container" style="padding-top: 20px;">
			<div class="ts hidden divider"></div>

			<post>
				<?php the_content(); ?>
			</post>

			<div class="ts clearing divider"></div>
			<?php if (in_category($category_id_ch) || in_category($category_id_group)) { ?>
				<div class="ts stackable grid">
					<div class="two column row">
						<div class="column">
							<?php if (in_category($category_id_ch)) { ?>
								<h3 class="ts header">
									加入「<?php the_title(); ?>」頻道
									<div class="sub header">請點擊下方按鈕</div>
								</h3>
								<a class="ts join right labeled icon info button" target="_blank" href="<?php echo get_post_meta($post->ID, $prefix . 'tg-link', true); ?>">
									加入頻道<i class="plus icon"></i>
								</a>
							<?php } elseif (in_category($category_id_group)) { ?>
								<h3 class="ts header">
									加入「<?php the_title(); ?>」群組
									<div class="sub header">請點擊下方按鈕</div>
								</h3>
								<a class="ts join right labeled icon primary button" target="_blank" href="<?php echo get_post_meta($post->ID, $prefix . 'tg-link', true); ?>">
									加入群組<i class="plus icon"></i>
								</a>
							<?php } ?>
						</div>
						<div class="column">
							<?php get_template_part('share', 'buttons'); ?>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<?php get_template_part('share', 'buttons'); ?>
			<?php } ?>
			<div class="ts clearing divider"></div>
			<?php
			$categories = get_the_category();
			if (!empty($categories)) {
				$output = '<p>';
				foreach ($categories as $category) {
					$output .= '<a class="ts horizontal basic label" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
				}
				$output .= '</p>';
				echo $output;
			}
			?>
			<?php
			$tags = get_the_tags();
			if (!empty($tags)) {
				$output = '<p>';
				foreach ($tags as $tag) {
					$output .= '<a class="ts horizontal basic label" href="' . esc_url(get_category_link($tag->term_id)) . '">
					<i class="hashtag icon"></i>' . esc_html($tag->name) . '
				</a>';
				}
				$output .= '</p>';
				echo $output;
			}
			?>
			<div class="ts clearing divider"></div>
			<?php comments_template(); ?>

			<div class="ts clearing hidden divider"></div>
		</div>
	</div>
<?php endif; ?>
<?php get_footer(); ?>