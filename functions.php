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
    echo '<p>您好，歡迎來到網站控制台。如果操作過程中有遇到任何問題，歡迎騷擾 <a href="https://t.me/gnehs_OwO">棒棒勝</a> ，謝謝。</p>';
	echo '<p>喔對， <a href="https://tg.gnehs.com.tw/add/">這個</a> 是加入的教學</p>';
}
function wpc_add_dashboard_widgets() {
    wp_add_dashboard_widget('wp_dashboard_widgets', '歡迎使用OuO', 'wpc_dashboard_widget_function');
}
add_action('wp_dashboard_setup', 'wpc_add_dashboard_widgets' );

/*
	登入介面美化
*/
function gnehs_login_css_group() {
    echo '<style type="text/css">
            .login h1 a { 
                background-image:url(https://tg.gnehs.com.tw/wp-content/uploads/2017/04/cropped-logo.png) !important;
            }
            </style>';
}
add_action('login_head', 'gnehs_login_css_group');

/*
	登入 Logo 連結替換
*/
function custom_loginlogo_url($url) {
    return get_bloginfo('url');
}
add_filter( 'login_headerurl', 'custom_loginlogo_url' );
?>