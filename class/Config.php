<?php

class Config
{
    //properties
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $database = "psychiatrist_system";
    public $conn;

    public function __construct()
    {
        $db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
        $this->servername = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
        $db['dbname'] = ltrim($db['path'], '/');
        $dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8";
        $this->username = $db['user'];
        $this->password = $db['pass'];
        $this->database = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_USE_BUFFERED_QUERY =>true,
          );
        //Create the connection
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

        //check connection
        if ($this->conn->connect_error) {
            die("Connection error: " . $this->conn->connect_error);

        }
        return $this->conn;
    }

    public function redirect($url)
    {
        #ob_clean - remove all output before header
        ob_clean();
        $this->redirect(" $url");
        exit;
    }
    public function redirect_js($url)
    {
        echo "<script>window.location.replace('$url')</script>";
        exit;
    }
}
