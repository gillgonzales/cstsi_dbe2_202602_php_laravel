<?php

namespace CSTSI\Dbe2\core;

use CSTSI\Dbe2\controllers\Controller;
use CSTSI\Dbe2\controllers\api\Controller as ApiController;
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
		$isApi = false;

		try {
			if ($uriQuery) {
				$class_name = $uriQuery[0];

				if($class_name==='api'){
					$class_name = $uriQuery[1];
					$isApi = true;
				}

				if (count($uriQuery) > 1 && !$isApi) {
					$method = $uriQuery[1];
					$param = (count($uriQuery) > 2) ? $uriQuery[2] : null;
				}

				if (count($uriQuery) > 2 && $isApi) {
					$method = $uriQuery[2];
					$param = (count($uriQuery) > 3) ? $uriQuery[3] : null;
				}


				if (isset($routes[$class_name]) || ($isApi && isset($routes["/api/$class_name"]))) {
					
					if($isApi) $class = new $routes["api/$class_name"]; //produtos
					else $class = new $routes[$class_name];

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
			error_log($error);
			header('HTTP/1.0 503 Servico Indisponivel!!!');
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
