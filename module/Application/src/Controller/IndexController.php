<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\PluginManager;

class IndexController extends AbstractActionController
{
    public $tableGateway;

    public function __construct($tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function indexAction()
    {
        /* configura o form */
        $form = new \Application\Form\User;
        $form->setAttribute('action', '');

        $view = new ViewModel(['form' => $form]);
        $view->setTemplate('application/index/index.phtml');

		$request = $this->getRequest();
		/* se a requisição é post os dados foram enviados via formulário*/
		if ($request->isPost()) {
            $user = new \Application\Model\User;
            /* configura a validação do formulário com os filtros e validators da entidade*/
            $form->setInputFilter($user->getInputFilter());
            /* preenche o formulário com os dados que o usuário digitou na tela*/
            $form->setData($request->getPost());
            /* faz a validação do formulário*/
            if ($form->isValid()) {
                /* pega os dados validados e filtrados */
                $data = $form->getData();
                unset($data['send']);

				$logado = $this->tableGateway->select(['email' => $data['email'], 'password' => $data['password']]);
        		if (count($logado) != 0) {

        			session_start();
        			$_SESSION["podeAcessar"] = true;
        			
            		return $this->redirect()->toUrl('/beer');
        		}

                echo "<p class='text-center'>Usuario ou senha não encontrados.</p>";
            }
		}

		$view = new ViewModel(['form' => $form]);
		return $view;
    }
}