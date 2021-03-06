<?php
	namespace Lib;
	use \PDO as PDO;
	class PostgreSQL implements DB{

		private pdo;

		public function connection($config){
			$pgsql = $config["connections"]["pgsql"];
			$driver = $pgsql["driver"];
			$host = $pgsql["host"];
			$dbname = $pgsql["database"];
			$charset = $pgsql["charset"];
			$username = $pgsql["username"];
			$password = $pgsql["password"];
			$port = $pgsql["port"];
			$dsn = "{$driver}:host={$host};dbname={$dbname};port:{$port};charset={$charset}";

			try{
				$this->pdo = new PDO($dsn,$username,$password);
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				die($e->getMessage());
			}

			return $this;
		}

		public function query($sql){
			try{
				return $this->pdo->query($sql);
			}catch(PDOException $e) {
				die("Error Nro: {$e->getCode()} Msg: {$e->getMessage()}");
			}
		}
	}