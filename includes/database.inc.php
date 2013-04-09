<?php
require_once ('define/class.database.const.php');



class Database
{

	private $_connection;
	private static $_instance;
	private $_database;
	private $_pdo;

	/**
	 * Get Instance of database
	 * @return Database
	 */
	public static function getInstance()
	{
		if (!self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constractor
	 */
	public function __construct()
	{
		$this->_connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);


		// 1. create connection
		if (!$this->_connection) {
			die("Database connection failed: " . mysql_error());
		}
		// 2. Select a database to use
		$this->_database = mysql_select_db(DB_NAME, $this->_connection);
		if (!$this->_database) {
			die("Database selection failed: " . mysql_error());
		}
		try {
			$this->_pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

		} catch (PDOException $e) {
			echo "Failed to get DB handle: " . $e->getMessage() . "\n";
			exit;
		}


	}
	private function confirm_query($result_set)
	{
		if (!$result_set) {
			die("Database query failed: " . mysql_error());
		}
	}


	public function get_query($query)
	{

		$result = mysql_query($query, $this->_connection);

		$this->confirm_query($result);
		return $result;
	}

	public function insert_query($query)
	{
		if (mysql_query($query)){
		return mysql_insert_id();
        }else {
            return 0;
        }

	}

    function NewNote($user){
        $query='INSERT INTO tbl_notes ( x,  y, h, w, user, note ) VALUES (
                300,    100,    200,    150,    '.$user.',    ""    )';
        $result = $this->insert_query($query);
        return $result;
    }
}

