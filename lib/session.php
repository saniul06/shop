<?php

/**
 *Session Class
 **/
class Session
{
    public static function init()
    {
        if (version_compare(phpversion(), '5.4.0', '<')) {
            if (session_id() == '') {
                session_start();
            }
        } else {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }
    }

    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function checkSession($url)
    {
        self::init();
        if (self::get("login") == false) {
            header("Location:login.php?page=$url");
        }
    }

    public static function checkLogin($url)
    {
        self::init();
        if (self::get("login") == true) {
            if (empty($url)) {
                header("Location: index.php");
            } else
                header("Location: $url");
        }
    }

    public static function destroy()
    {
        session_unset();
        session_destroy();
        header("Location: login.php");
    }
}
