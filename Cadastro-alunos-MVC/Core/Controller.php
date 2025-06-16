<?php
class Controller
{
    protected function view($viewName, $data = [])
{
    list($data['menu_ativo']) = explode('/', $viewName);

    extract($data);
    require_once __DIR__ . '/../App/Views/templates/header.php';
    require_once __DIR__ . '/../App/Views/' . $viewName . '.php';
    require_once __DIR__ . '/../App/Views/templates/footer.php';
}
}