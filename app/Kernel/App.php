<?php

namespace App\Kernel;

class App
{
    private static App $app;
    private static Router $router;
    private static ViewEngine $view;
    private static DB $db;
    private static SessionManager $session;
    private string $home_dir;
    private string $home_url;

    public function __construct($dir, $url = null)
    {
        $this->home_dir = $dir;
        $this->home_url = $url ?? 'http://' . $_SERVER['HTTP_HOST'];

        self::$app = $this;
        self::$session = new SessionManager();
        self::session()->init();
        self::$router = new Router();
        self::$view = new ViewEngine();
        self::$db = new DB();
    }

    public function run(): void
    {
        try {
            self::$router->resolve();
        } catch (\Exception $e) {
            echo $e;
        }
    }

    public static function app(): App
    {
        return self::$app;
    }

    public static function router(): Router
    {
        return self::$router;
    }

    public static function view(): ViewEngine
    {
        return self::$view;
    }

    public static function db(): DB
    {
        return self::$db;
    }

    public static function session(): SessionManager
    {
        return self::$session;
    }

    public static function getDir(string $path): string
    {
        if ($path[0] != '/' && $path[0] != '\\') {
            $path = '/' . $path;
        }
        return self::$app->home_dir . $path;
    }

    public static function getUrl(string $path): string
    {
        if ($path[0] != '/' && $path[0] != '\\') {
            $path = '/' . $path;
        }
        return self::$app->home_url . $path;
    }
}