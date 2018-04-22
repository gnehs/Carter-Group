<?php
/*
	自訂群組欄位
*/
$meta_box = array(
    'id' => 'post-meta-tg',
    'title' => 'Telegram 蒐集君',
    'page' => 'post',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => '連結',
            'desc' => '在此填入連結',
            'id' => $prefix . 'tg-link',
            'type' => 'text',
            'std' => 'https://t.me/xxxxxxxx'
        )
    )
);
add_action('admin_menu', 'mytheme_add_box');

// Add meta box
function mytheme_add_box() {
    global $meta_box;

    add_meta_box($meta_box['id'], $meta_box['title'], 'mytheme_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}
// Callback function to show fields in meta box
function mytheme_show_box() {
    global $meta_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
        switch ($field['type']) {
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />', $field['desc'];
                break;
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '<br />', $field['desc'];
                break;
            case 'select':
                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                }
                echo '</select>';
                break;
            case 'radio':
                foreach ($field['options'] as $option) {
                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                }
                break;
            case 'checkbox':
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                break;
        }
        echo     '<td>',
            '</tr>';
    }

    echo '</table>';
}
add_action('save_post', 'mytheme_save_data');

// Save data from meta box
function mytheme_save_data($post_id) {
    global $meta_box;

    // verify nonce
    if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    foreach ($meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
 return $post_id;
}

/*
	後台新增訊息方塊
*/
function wpc_dashboard_widget_function() {
    echo '<p>您好，歡迎來到網站控制台。如果操作過程中有遇到任何問題，歡迎騷擾 <a href="https://t.me/gnehs_OwO">棒棒勝</a></p>';
	echo '<p><a class="button button-primary" href="/wp-admin/post-new.php">提交群組 / 頻道</a>   <a class="button" href="/23">加入教學</a></p>';
}
function wpc_add_dashboard_widgets() {
    wp_add_dashboard_widget('wp_dashboard_widgets', '歡迎使用OuO', 'wpc_dashboard_widget_function');
}
add_action('wp_dashboard_setup', 'wpc_add_dashboard_widgets' );

/*
	登入 Logo 連結替換
*/
function custom_loginlogo_url($url) {
    return get_bloginfo('url');
}
add_filter( 'login_headerurl', 'custom_loginlogo_url' );

/*
    對不是管理員者隱藏多餘頁面
*/
function remove_menu_pages_for_not_admins() {
 
    global $user_ID;
 
    if ( !current_user_can('level_10') ) {
        remove_menu_page('tools.php'); // Tools
        remove_menu_page('profile.php'); // profile
        remove_menu_page('edit-comments.php'); // comments
    }
}
add_action( 'admin_init', 'remove_menu_pages_for_not_admins' );

/*
    對不是管理員者隱藏多餘控制台項目
*/
function remove_dashboard_widgets_for_not_admins() {
    if ( !current_user_can('level_10') ) {
        global $wp_meta_boxes;
        // 收到新鏈結
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
        // 外掛
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
        // WordPress Blog
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
        // Other WordPress News
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
        // 快速草稿
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
        // 概況
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
        // 活動
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
    }
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets_for_not_admins');

/*
    Hide admin Bar
*/
function hide_admin_bar_for_not_admins($flag) {
    if ( !current_user_can('level_10') ) {
        return false;
    }else{
        return true;
    }
}
add_filter('show_admin_bar','hide_admin_bar_for_not_admins');

/*
    文章編輯頁
*/
function remove_post_metaboxes_for_not_admins() {
    if ( !current_user_can('level_10') ) {
        remove_meta_box( 'authordiv','post','normal' ); // 作者模块
        remove_meta_box( 'commentstatusdiv','post','normal' ); // 评论状态模块
        remove_meta_box( 'commentsdiv','post','normal' ); // 评论模块
        remove_meta_box( 'postcustom','post','normal' ); // 自定义字段模块
        remove_meta_box( 'postexcerpt','post','normal' ); // 摘要模块
        remove_meta_box( 'revisionsdiv','post','normal' ); // 修订版本模块
        remove_meta_box( 'slugdiv','post','normal' ); // 别名模块
        remove_meta_box( 'trackbacksdiv','post','normal' ); // 引用模块
        remove_meta_box( 'formatdiv','post','normal' ); // 文章格式模块
        remove_meta_box( 'tagsdiv-post_tag','post','normal' ); // 标签模块
    }
}
add_action('admin_menu','remove_post_metaboxes_for_not_admins');

?>