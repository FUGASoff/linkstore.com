<?php

class Index extends controller {

    public function __construct()
    {
        parent::__construct();
        if ($_POST['register'])
        {
<<<<<<< HEAD
            $render_file='register';
        }
        elseif ($_POST['login'])
        {
            $render_file='login';
        }
        elseif ($_POST['add_link'])
        {
            $render_file='add_link';
        }
        else
        {
            $render_file='index';
        }
        $view_set=array(
            'body_name'=>$render_file
        );
        $this->view->view_set=$view_set;
        $this->view->render('main_view');
    }

=======
            $this->view->render('register');
        }
        elseif ($_POST['login'])
        {
            $this->view->render('login');
        }
        elseif ($_POST['add_link'])
        {
            $this->view->render('add_link');
        }
        else
        {
            $this->view->render('index');
        }
    }
>>>>>>> f1e5d19b93c13a54aca5b9e9dcb38724149ba621
}
