<?php

class error extends controller
{
    public function __construct()
    {
        parent::__construct();
<<<<<<< HEAD
        $view_set=array(
            'body_name'=>'error'
        );
        $this->view->view_set=$view_set;
        $this->view->render('main_view');
=======
        echo "Error controller";
        echo '<br>';
        $this->view->msg = 'Страницы не существует!';
        $this->view->render('error/index');
>>>>>>> f1e5d19b93c13a54aca5b9e9dcb38724149ba621

    }
}
