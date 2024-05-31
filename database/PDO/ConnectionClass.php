<?php 

namespace Database\PDO;


// el definir el namespace hace que las clases externas deban ponerse antes un "\" para indicar que es una clase del namespace global

class Connection {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $this->make_connection();
    }

    public static function getInstance(): Connection {
        if (!self::$instance instanceof self) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }

    private function make_connection(): void {
        $server = "localhost";
        $database = "test";
        $username = "santiscano";
        $password = "123123";

        try {
		        // se pone antes de PDO la "\" para indicar que es una clase del namespace global
            $this->conn = new \PDO("mysql:host=$server;dbname=$database", $username, $password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection(): \PDO {
        return $this->conn;
    }
}


// Obtener la instancia de la conexión
$connInstance = Connection::getInstance()->getConnection();

// Utilizar la conexión para realizar operaciones en la base de datos
$query = $connInstance->query("SELECT * FROM users");
$result = $query->fetchAll(\PDO::FETCH_ASSOC);

print_r($result);
?>
