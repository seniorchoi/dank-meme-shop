<?php

class i18n
{
    protected static $current_lang_code = null;

    protected static $translations = null;

    public static function getLanguages()
    {
        return config::get('languages', array());
    }

    public static function getDefaultLangCode()
    {
        return config::get('default_language', 'en');
    }

    public static function getCurrentLangCode()
    {
        if(static::$current_lang_code === null)
        {
            //var_dump($_COOKIE); die();
            if(isset($_COOKIE['lang_code']) && array_key_exists($_COOKIE['lang_code'], static::getLanguages()))
            {
                static::$current_lang_code = $_COOKIE['lang_code'];
            }
            else
            {
                static::$current_lang_code = static::getDefaultLangCode();
            }
        }
        return static::$current_lang_code;
    }

    public static function setCurrentLangCode($code)
    {   
        if(array_key_exists($code, static::getLanguages()))
        { 
            static::$current_lang_code = $code;
            $_COOKIE['lang_code'] = $code;
            setcookie(
                'lang_code', 
                $code, 
                time()+30*86400 // 30 days
            );
        }
    }

    public static function processLanguageChange()
    {
        if(request::isPost() && request::post('change_language'))
        {
            static::setCurrentLangCode(request::post('change_language'));
        }
    }

    public static function loadTranslations()
    {
        if(static::$translations===null)
        {
            static::$translations = array();
            $file = CONFIG_DIR.'/translations-'.self::getCurrentLangCode().'.ini';
            if(file_exists($file))
            {
                $data = parse_ini_file($file);
                if(is_array($data))
                {
                    static::$translations = $data;
                }
            }
        }
    }

    public static function translate($identifier, $default = null)
    {
        static::loadTranslations();
        if(isset(static::$translations[$identifier]))
        {
            return static::$translations[$identifier];
        }
        else
        {
            return $default;
        }
    }
}

function l($identifier, $default = null)
{
    return i18n::translate($identifier, $default);
}