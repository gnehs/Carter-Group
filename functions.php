<?php
/*
	tg 連結欄位
*/
register_meta('post', 'tg-link', [
    'type'         => 'string',
    'description'  => '連結',
    'single'       => true,
    'show_in_rest' => true,
]);
?>
