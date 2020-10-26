<?php

if (!function_exists('aurl')) {
    function aurl($url = null)
    {
        return url('admin/' . $url);
    }
}

if (!function_exists('lang')) {
    function lang()
    {
        if (session()->has('lang')) {
            return session('lang');
        } else {
            return 'ar';
        }
    }
}

if (!function_exists('direction')) {
    function direction()
    {
        if (session()->has('lang')) {
            if (session('lang') == 'ar') {
                return 'rtl';
            } else {
                return 'rtl';
            }
        } else {
            return 'rtl';
        }
    }
}

if (!function_exists('active_menu')) {
    function active_menu($link)
    {
        if (preg_match('/' . $link . '/i', Request::segment(2))) {
            return ['menu-open', 'display:block'];
        } else {
            return ['', ''];
        }
    }
}

//  function for settings

// validate image function
if (!function_exists('v_image')) {
    function v_image($ext = null)
    {
        if ($ext === null) {
            return 'image|mimes:jpg,png,gif,pmb,jpeg';
        } else {
            return 'image|mimes' . $ext;
        }
    }
}
