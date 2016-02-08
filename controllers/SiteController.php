<?php

use App\Components\View;
use App\Components\FunctionLibrary as FL;
use App\Models\CategoryModel;
use App\Models\ProductModel;


class SiteController
{
    public function actionIndex()
    {
        $showProducts = 6;

        $categories = CategoryModel::getAllUsingColumns();
        $products   = ProductModel::getAllUsingColumns(true, $showProducts);

        $view = new View;
        $view->categories = $categories;
        $view->products   = $products;
        $view->display('site/index.php');

        return true;
    }

    public function actionContact()
    {
        $email = '';
        $subject = '';
        $message = '';
        $result  = '';
        $errors  = [];

        $categories = CategoryModel::getAllUsingColumns();

        if (isset($_POST['submit'])) {
            $email   = FL::clearStr($_POST['email']);
            $subject = FL::clearStr($_POST['subject']);
            $message = FL::clearStr($_POST['message']);

            if (!FL::isEmail($email)) {
                $errors[] = 'Некорректный email';
            }

            if (!FL::isName($subject)) {
                $errors[] = 'Тема не может быть пустым';
            }

            if (!FL::isName($message)) {
                $errors[] = 'Сообщение не может быть пустым';
            }

            if (empty($errors)) {
                $adminEmail = 'testxamppphp@gmail.com';
                $subject = "Тема письма: $subject. От: $email";
                $message = "Текст письма: $message";
                $result = mail($adminEmail, $subject, $message);
            }
        }

        $view = new View;
        $view->categories = $categories;
        $view->email      = $email;
        $view->subject    = $subject;
        $view->message    = $message;
        $view->errors     = $errors;
        $view->result     = $result;
        $view->display('site/contact.php');

        return true;
    }
}