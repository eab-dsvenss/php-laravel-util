<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace se\eab\php\laravel\util\url;

use Illuminate\Http\Request;

/**
 * Description of UrlHandler
 *
 * @author dsvenss
 */
class UrlHelper
{

    public function __construct()
    {
        
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
     * @param Request $request
     * @param string $path
     * @param boolean $withQuery
     * @return redirect
     */
    public function performRedirect(Request &$request, $path, $withQuery, $forceSSL)
    {
        $request->flash();
        if ($withQuery) {
            $path .= $this->getQueryStringFromRequest($request);
        }
        if ($forceSSL) {
            return redirect()->secure($path);
        } else {
            return redirect($path);
        }
    }

}
