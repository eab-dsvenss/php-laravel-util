<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace se\eab\php\laravel\util\url;

use se\eab\php\laravel\util\url\RedirectContainer;
use se\eab\php\laravel\util\locale\LocaleHelper;

/**
 * Description of UrlHandler
 *
 * @author dsvenss
 */
class UrlHelper
{

    private static $instance;
    private $localeHelper;

    private function __construct()
    {
        $this->localeHelper = LocaleHelper::getInstance();
    }

    /**
     * Return singleton instance
     * @return UrlHelper
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new UrlHelper();
        }

        return self::$instance;
    }

    /**
     * Returns query string from request
     * @param Request $request
     * @return string
     */
    public function getQueryStringFromRequest(Request &$request)
    {
        return $request->getQueryString() ? "?" . $request->getQueryString() : "";
    }

    /**
     * Returns the requested locale
     * @param Request $request
     * @return string
     */
    public function getRequestLocale(Request $request)
    {
        return $request->segment(1);
    }

    /**
     * Returns localized url
     * @param string $locale
     * @param string $path
     * @return string
     */
    public function getLocalizedUrl($locale, $path)
    {
        return url($this->getLocalizedPath($path, $locale));
    }

    public function getLocalizedPath($path, $locale)
    {
        $delocalizedPath = $this->delocalizePath($path);
        return rtrim($locale . "/" . $delocalizedPath, '/');
    }

    private function delocalizePath($path)
    {
        $segments = explode("/", $path);
        if (count($segments) > 0 && $this->localeHelper->isValidLocale($segments[0])) {
            array_shift($segments);
            return implode("/", $segments);
        }

        return $path;
    }

    /**
     * Delocalizes segments in path
     * @param array $segments
     */
    public function delocalizeSegments(array &$segments)
    {
        if (count($segments) > 0) {
            $locale = $segments[0];
            if ($this->localeHelper->isValidLocale($locale)) {
                array_shift($segments);
            }
        }
    }

    /**
     * Redirects to path with or without querystring
     * @param RedirectContainer $container
     */
    public function performRedirect(RedirectContainer $container)
    {
        $path = $container->getRedirectpath();
        $request = $container->getRequest();
        $request->flash();
        if ($container->shouldIncludeQuery()) {
            $path .= $this->getQueryStringFromRequest($request);
        }
        if ($container->shouldForceSSL()) {
            return redirect()->secure($path);
        } else {
            return redirect($path);
        }
    }

}
