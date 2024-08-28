<?php

namespace core\controllers;

use core\models\User;
use core\classes\Functions;


class UserController
{

    public function list_users_view()
    {
     
        $user = new User();
        $data = $user->list_users();
        

        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'list-users',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }
    //===================================================================


    public function show_user_view($id)
    {
        // Verifies if id is valid
        if (!isset($id) || filter_var($id, FILTER_VALIDATE_INT) === false || $id <= 0) {
            Functions::redirect('listar-usuarios');
            return;
        }

        $user = new User();
        $data = $user->show_user($id);

      
        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'show-user',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }
    //===================================================================


    public function update_user_view($id)
    {
        // Verifies if id is valid
        if (!isset($id) || filter_var($id, FILTER_VALIDATE_INT) === false || $id <= 0) {
            Functions::redirect('listar-usuarios');
            return;
        }

        $user = new User();

        $data['user'] = $user->show_user($id);
        $data['colors'] = $user->list_user_colors($id);

        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'update-user',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);

    }
    //===================================================================


    public function update_user_color_view($id)
    {
        // Verifies if id is valid
        if (!isset($id) || filter_var($id, FILTER_VALIDATE_INT) === false || $id <= 0) {
            Functions::redirect('listar-usuarios');
            return;
        }


        //List users
        $user = new User();
        $data['users'] = $user->show_user($id);
        $data['colors'] = $user->list_user_colors($id);

        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'update-user-color',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }
    //===================================================================


    public function create_user_view()
    {
        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'create-user',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }
    //===================================================================




    public function create_user()
    {


        $name = $_POST['name'];
        $email = $_POST['email'];
        $arr_colors = [];


        if (!isset($_POST['name']) || empty(trim($_POST['name']))) {
            $_SESSION['error'] = 'É necessário preencher o nome. ';
            Functions::redirect('criar-usuario');
            return;
        }

        if (!isset($_POST['email']) || empty(trim($_POST['email']))) {
            $_SESSION['error'] = 'É necessário preencher o e-mail. ';
            Functions::redirect('criar-usuario');
            return;
        }


        if (isset($_POST['Blue'])) {
            $arr_colors[] = 1;
        }
        if (isset($_POST['Red'])) {
            $arr_colors[] = 2;
        }
        if (isset($_POST['Yellow'])) {
            $arr_colors[] = 3;
        }
        if (isset($_POST['Green'])) {
            $arr_colors[] = 4;
        }



        $user = new User();
        $result = $user->create_user($name, $email, $arr_colors);

        //The method 'create_user' will return a string if there's an error
        if (is_string($result)) {
            $_SESSION['error'] = $result;
            Functions::redirect('criar-usuario');
            return;
        }


        $_SESSION['success'] = "Usuário criado com sucesso";
        Functions::redirect('listar-usuarios');
        return;


    }
    //===================================================================


    public function update_user($id)
    {

        // Verifies if id is valid
        if (!isset($id) || filter_var($id, FILTER_VALIDATE_INT) === false || $id <= 0) {
            Functions::redirect('listar-usuarios');
            return;
        }

        $name = $_POST['name'];
        $email = $_POST['email'];

        $arr_colors = [];

        //Validates input checks
        if (isset($_POST['Blue'])) {
            $arr_colors[] = 1;
        }
        if (isset($_POST['Red'])) {
            $arr_colors[] = 2;
        }
        if (isset($_POST['Yellow'])) {
            $arr_colors[] = 3;
        }
        if (isset($_POST['Green'])) {
            $arr_colors[] = 4;
        }

        $user = new User();

        $update_user_result = $user->update_user($id, $name, $email);
        $update_user_color_result = $user->update_color($id, $arr_colors);


        //Checks if there's an error editing user's name and email
        if (is_string($update_user_result)) {
            $_SESSION['error'] = $update_user_result;
            Functions::redirect('editar-usuario/' . $id);
            return;
        }
        //Checks if there's an error editing user's colors
        if (is_string($update_user_color_result)) {
            $_SESSION['error'] = $update_user_color_result;
            Functions::redirect('editar-usuario/' . $id);
            return;
        }


        $_SESSION['success'] = 'Usuário editado com sucesso.';
        Functions::redirect('editar-usuario/' . $id);
        return;

    }
    //===================================================================


    public function update_user_color($id)
    {
        // Verifies if id is valid
        if (!isset($id) || filter_var($id, FILTER_VALIDATE_INT) === false || $id <= 0) {
            Functions::redirect('listar-usuarios');
            return;
        }

        $arr_colors = [];

        //Validates input checks
        if (isset($_POST['Blue'])) {
            $arr_colors[] = 1;
        }
        if (isset($_POST['Red'])) {
            $arr_colors[] = 2;
        }
        if (isset($_POST['Yellow'])) {
            $arr_colors[] = 3;
        }
        if (isset($_POST['Green'])) {
            $arr_colors[] = 4;
        }



        $user = new User();
        $result = $user->update_color($id, $arr_colors);


        if (is_string($result)) {
            $_SESSION['error'] = $result;
            Functions::redirect('editar-cor/' . $id);
            return;
        }

        $_SESSION['success'] = 'Cor vinculada com sucesso.';
        Functions::redirect('editar-cor/' . $id);
        return;
    }
    //===================================================================


    public function delete_user($id)
    {

        // Verifies if id is valid
        if (!isset($id) || filter_var($id, FILTER_VALIDATE_INT) === false || $id <= 0) {
            Functions::redirect('listar-usuarios');
            return;
        }

        $user = new User();
        $result = $user->delete_user($id);

        if (!$result) {
            $_SESSION['error'] = 'Erro ao deletar usuário.';
            Functions::redirect('listar-usuarios');
            return;
        }


        $_SESSION['success'] = 'Usuário deletado com sucesso!';
        Functions::redirect('listar-usuarios');
        return;

    }
    //===================================================================



    //===================================================================





}

