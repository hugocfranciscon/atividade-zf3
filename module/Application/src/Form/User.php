<?php

namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class User extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->add([
            'name' => 'email',
            'options' => [
                'label' => 'Email',
            ],
            'type'  => 'Email',
        ]);
        $this->add([
            'name' => 'password',
            'options' => [
                'label' => 'Password',
            ],
            'type'  => 'Password',
        ]);

        $this->add([
            'name' => 'send',
            'type'  => 'Submit',
            'attributes' => [
                'value' => 'Submit',
            ],
        ]);

        $this->setAttribute('action', '/user/submit');
        $this->setAttribute('method', 'post');
    }
}
