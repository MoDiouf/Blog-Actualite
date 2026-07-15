<?php

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/Article.php';
require_once __DIR__ . '/models/Categorie.php';
require_once __DIR__ . '/controllers/ArticleController.php';
require_once __DIR__ . '/controllers/AdminController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$categorie = isset($_GET['categorie']) ? (int)$_GET['categorie'] : 0;

$articleController = new ArticleController($pdo);
$adminController = new AdminController($pdo);

switch ($action) {
    // Pages publiques
    case 'index':
        $articleController->index($categorie);
        break;

    case 'article':
        if ($id) {
            $articleController->show($id);
        } else {
            die("Article introuvable.");
        }
        break;

    // Pages admin
    case 'admin':
        $adminController->index();
        break;

    case 'admin_form':
        $adminController->form($id);
        break;

    case 'admin_save':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $adminController->save();
        } else {
            header('Location: index.php?action=admin');
            exit;
        }
        break;

    case 'admin_delete':
        if ($id) {
            $adminController->delete($id);
        } else {
            header('Location: index.php?action=admin');
            exit;
        }
        break;

    default:
        $articleController->index($categorie);
        break;
}
