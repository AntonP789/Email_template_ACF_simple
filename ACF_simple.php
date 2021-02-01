<?php

$message_raw = get_field('<NAME of email text field>', 'option');
$patterns = array();
$patterns[0] = '/\[text_1\]/'; 
$patterns[1] = '/\[text_2\]/'; 
$patterns[2] = '/\[link_3\]/';
$replacements = array();
$replacements[0] = '<<<ENTER dynamic data_1>>>';
$replacements[1] = '<<<ENTER dynamic data_2>>>';
$replacements[2] = get_home_url() . '<<<ENTER dynamic link_3>>>';
$message = preg_replace($patterns, $replacements, $message_raw);

// foreach( <<<if in loop>>> ){  
        $user_info = get_userdata('<user_id>');
        if (    is_object($user_info)
                // && <OTHER checks>
            ){
                $user_email = $user_info->user_email;
                $to = $user_email;
                $subject = get_field('<<<NAME of email subject field>>>', 'option');
                $headers = array(
                    'From: SomeSite <info@DOMAIN_OF_SITE_important!>', // if NOT DOMAIN_OF_SITE - email will NOT be send
                    'content-type: text/plain' // text/html  multipart/alternative  multipart/mixed  
                );
                $sent_mail = wp_mail( $to, $subject, $message, $headers );
                // update in ACF send flag if needed
                    // $res = update_sub_row(
                    //     array('rounds', count($rounds), 'bets'),
                    //     $key + 1,
                    //     array(
                    //         'em2' => 1,
                    //     )
                    // );
        }
// }