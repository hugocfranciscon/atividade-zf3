<?php
namespace Application\Service;

class Auth
{
    private $request;
    private $adapter;

    public function __construct($request, $adapter)
    {
        $this->request = $request;
        $this->adapter = $adapter;
    }

    public function isAuthorized()
    {
        session_start();
        if (!isset($_SESSION["podeAcessar"])) {
            throw new \Exception("Not authorized", 401);
        }
        //if(! $this->request->getHeader('Authorization')){
        //    throw new \Exception("Not authorized", 401);
        //}
        /*
        if (!$this->isValid()) {
            throw new \Exception("Not authorized", 403);
        }
        */

        return true;
    }

    private function isValid()
    {
        $token = $this->request->getHeader('Authorization');
        //validar o token de alguma forma...
        return true;
    }
}
