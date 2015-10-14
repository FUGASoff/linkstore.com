<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 14.10.15
 * Time: 14:46
 */
class link extends controller
{
    public function add()
    {
        $model = new model_link();
        $model->add_link($_POST['link'], $_POST['description'], $_POST['name'], $_POST['type'], $_POST['user']);
    }
    public function edit()
    {
        $model = new model_link();
    }
    public function delete()
    {
        $model = new model_link();
    }
}