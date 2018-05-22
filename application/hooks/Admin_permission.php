<?php
class Admin_permission {
    function initialize() {
        $CI = & get_instance();
        $admin_role = $CI->session->userdata('user_role');
        $directory = $CI->router->fetch_directory();
        $controller = $CI->router->fetch_class();
        $action = $CI->router->fetch_method();
        if (empty($admin_role) && ($controller == 'Mobile_WS' || $controller == 'Crone')) {
            
        } else if (empty($admin_role) && $controller != 'login') {
            $redirect = site_url(uri_string());
            redirect('login?redirect=' . base64_encode($redirect));
        } else {
            if (!empty($admin_role) && ($controller == 'login' && $action == 'index')) {
                redirect('dashboard');
            }
        }
    }
}
?>