<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace se\eab\php\laravel\util\locale;

use App;
use se\eab\php\laravel\util\provider\EabUtilServiceProvider;

/**
 * Description of LocaleHandler
 *
 * @author dsvenss
 */
class LocaleHelper {

    private $locales;
    private static $instance;

    /**
     * Constructor
     */
    private function __construct() {
        $this->locales = config(EabUtilServiceProvider::CONFIG_FILENAME . ".locales");
    }
    
    /**
     * Get singleton instance
     * @return LocaleHelper
     */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new LocaleHelper();
        }
        
        return self::$instance;
    }

    /**
     * Returns current locale
     * @return string
     */
    public function getCurrentLocale() {
        return App::getLocale();
    }

    /**
     * REturns whether or not the locale is valid
     * @param string $locale
     * @return boolean
     */
    public function isValidLocale($locale) {
        foreach ($this->locales as $validLocale) {
            if (strcmp($validLocale, $locale) == 0) {
                return true;
            }
        }
        return false;
    }

    /**
     * Sets locale 
     * @param string $locale
     */
    public function setLocale($locale) {
        App::setLocale($locale);
    }
    
    /**
     * Returns available locales
     * @return array
     */
    public function getAvailableLocales() {
        return $this->locales;
    }
    
    /**
     * REturns the default locale. Cannot use config("app.locale") since it does not return sv at all times during
     * application execution
     * 
     * @return string
     */
    public function getDefaultLocale() {
        return config(EabUtilServiceProvider::CONFIG_FILENAME . ".default_locale");
    }

}
