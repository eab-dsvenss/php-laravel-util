<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace se\eab\php\laravel\util\url;

use Illuminate\Http\Request;

/**
 * Description of RedirectContainer
 *
 * @author dsvenss
 */
class RedirectContainer
{

    private $request;
    private $redirectpath;
    private $includeQuery;
    private $forceSSL;

    /**
     * Construct
     * 
     * @param Request $request
     * @param string $redirectpath
     * @param boolean $includeQuery
     * @param boolean $forceSSL
     */
    public function __construct(Request $request, $redirectpath, $includeQuery, $forceSSL)
    {
        $this->request = $request;
        $this->redirectpath = $redirectpath;
        $this->includeQuery = $includeQuery;
        $this->forceSSL = $forceSSL;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getRedirectpath()
    {
        return $this->redirectpath;
    }

    public function shouldIncludeQuery()
    {
        return $this->includeQuery;
    }

    public function shouldForceSSL()
    {
        return $this->forceSSL;
    }

}
