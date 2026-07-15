<?php
/**
 * Plugin Name: RudraSpirit Custom Avatar
 * Description: Replaces the default Gravatar with the Rudra Spirit logo for the admin author.
 */

add_filter("pre_get_avatar_data", function($args, $id_or_email) {
    // Get user ID
    $user_id = 0;
    if (is_numeric($id_or_email)) {
        $user_id = (int)$id_or_email;
    } elseif (is_object($id_or_email) && isset($id_or_email->user_id)) {
        $user_id = $id_or_email->user_id;
    } elseif (is_string($id_or_email)) {
        $user = get_user_by("email", $id_or_email);
        if ($user) $user_id = $user->ID;
    } elseif ($id_or_email instanceof WP_User) {
        $user_id = $id_or_email->ID;
    }
    
    // Replace avatar for user ID 1 (admin/Rudraspirit)
    if ($user_id === 1) {
        $logo_url = wp_get_upload_dir()["baseurl"] . "/2025/12/Logo_Fav.png";
        $args["url"] = $logo_url;
        $args["found_avatar"] = true;
    }
    
    return $args;
}, 10, 2);

// Also override get_avatar for older themes
add_filter("get_avatar", function($avatar, $id_or_email, $size) {
    $user_id = 0;
    if (is_numeric($id_or_email)) {
        $user_id = (int)$id_or_email;
    } elseif (is_object($id_or_email) && isset($id_or_email->user_id)) {
        $user_id = $id_or_email->user_id;
    } elseif (is_string($id_or_email)) {
        $user = get_user_by("email", $id_or_email);
        if ($user) $user_id = $user->ID;
    }
    
    if ($user_id === 1) {
        $logo_url = content_url("/uploads/2025/12/Logo_Fav.png");
        return '<img alt="Rudraspirit" src="' . esc_url($logo_url) . '" class="avatar avatar-' . $size . ' photo" height="' . $size . '" width="' . $size . '" loading="lazy" />';
    }
    
    return $avatar;
}, 10, 3);
