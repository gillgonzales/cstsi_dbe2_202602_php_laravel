<?php

namespace CSTSI\Dbe2\core;

use CSTSI\Dbe2\controllers\Controller;
use Exception;

// use CSTSI\Dbe2\views\View;

class Route
{

	// localhost:porta/controllers/method/param
	public static function resolve(array $routes): void
	{
		$uriQuery = self::parseURI();

		$class = null;
		$method = null;
		$param = null;

		try {
			if ($uriQuery) {
				$class_name = $uriQuery[0];
				if (count($uriQuery) > 1) {
					$method = $uriQuery[1];
					$param = (count($uriQuery) > 2) ? $uriQuery[2] : null;
				}


				if (isset($routes[$class_name])) {
					$class = new $routes[$class_name]; //produtos
					if ($class instanceof Controller) {
						if ($method && method_exists($class, $method)) {
							if ($param) {
								$class->$method($param);
							} else {
								$class->$method();
							}
						} else {
							if (method_exists($class, 'index'))
								$class->index();
							else $class = null;
						}
					}
				}
			}
			// if (!$class) View::pageNotFound();
			if (!$class) header('HTTP/1.0 404 Not Found');
		} catch (Exception $error) {
			// echo "Erro banco!!";
			var_dump($error);
			// header('HTTP/1.0 503 Servico Indisponivel!!!');
		}
	}

	private static function parseURI(): array
	{
		if ($_SERVER['REQUEST_URI'] == '/') {
			return [$_SERVER['REQUEST_URI']];
		} else {
			$url_path = trim($_SERVER['REQUEST_URI'], '/');
			error_log("ROUTE: $url_path");
			return explode('/', $url_path);
		}
	}
}
