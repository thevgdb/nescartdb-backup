<?php

function adminer_object() {

    include_once "./plugins/plugin.php";
    include_once "./plugins/login-password-less.php";

    class AdminerCustomization extends AdminerPlugin
    {
        function loginFormField($name, $heading, $value) {
            return parent::loginFormField($name, $heading, str_replace('value="server"', 'value="sqlite"', $value));
        }
        function database() {
            return "./database.sqlite";
        }
    }

    return new AdminerCustomization([
        // TODO: inline the result of password_hash() so that the password is not visible in source codes
        new AdminerLoginPasswordLess(password_hash("password", PASSWORD_DEFAULT)),
    ]);
}

include "./versions/editor-4.17.1.php";
