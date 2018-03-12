<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace se\eab\php\laravel\util\url;

use se\eab\php\laravel\util\url\RedirectContainer;

/**
 * Description of UrlHandler
 *
 * @author dsvenss
 */
class UrlHelper
{

    private static $instance;

    private function __construct()
    {
        
    }

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
