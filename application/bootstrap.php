<?php

$registry = new registry();

$registry->router = new router($registry);

$controller = $registry->router->get_controller();
$action = $registry->router->get_action();
$view_path = $registry->router->get_view_path();
$registry->script = $view_path.'scripts/'.$controller.'/'.$action.'.phtml';
$registry->session = new session($registry);
$registry->db = new db($registry);
$registry->navigator = new navigator($registry);
$registry->gatekeeper = new gatekeeper($registry);
$registry->router->load($registry);