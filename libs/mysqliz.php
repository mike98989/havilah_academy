<?php
class MySQLiz {
	private $mysqli_handler;

	public function __construct($hostname, $username, $password, $database) {
		$this->mysqli_handler = new mysqli($hostname, $username, $password, $database);

		if ($this->mysqli_handler->connect_error) {
      		trigger_error('Error: Could not make a database link (' . $this->mysqli_handler->connect_errno . ') ' . $this->mysqli_handler->connect_error);
		}

		$this->mysqli_handler->query("SET NAMES 'utf8'");
		$this->mysqli_handler->query("SET CHARACTER SET utf8");
		$this->mysqli_handler->query("SET CHARACTER_SET_CONNECTION=utf8");
		$this->mysqli_handler->query("SET SQL_MODE = ''");
  }

    public function multi_query($sql) {
		
		$result = $this->mysqli_handler->multi_query($sql);
		if (!$result) {
		    $data= "Multi query failed: (" . $this->mysqli_handler->errno . ") " . $this->mysqli_handler->error;
		    return ($data);
		}else{
		$i = 0;
		$data = array();
		do {

    if ($result = $this->mysqli_handler->store_result()) {
    	
        while ($row = mysqli_fetch_array($result)) 

			/* store your results */    
			{
			$data[$i] = $row;
			$i++;
			}
			mysqli_free_result($result);
			}   
			} while ($this->mysqli_handler->more_results() && $this->mysqli_handler->next_result());

			return $data;

			}

			
		exit;

  }

  public function query($sql) {
		
		$result = $this->mysqli_handler->query($sql, MYSQLI_STORE_RESULT);
		if ($result !== FALSE) {
			if (is_object($result)) {
				$i = 0;

				$data = array();

				while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					$data[$i] = $row;

					$i++;
				}

				$result->close();

				$query = new stdClass();
				$query->row = isset($data[0]) ? $data[0] : array();
				$query->rows = $data;
				$query->num_rows = count($data);


				unset($data);



				return $query;


			}
			else {
				return true;
			}
		}
		else {
			trigger_error('Error: ' . $this->mysqli_handler->error . '<br />Error No: ' . $this->mysqli_handler->errno . '<br />' . $sql);
			exit();
		}
  }

	public function escape($value) {
		return $this->mysqli_handler->real_escape_string($value);
	}

	public function countAffected() {
		return $this->mysqli_handler->affected_rows;
	}

	public function getLastId() {
		return $this->mysqli_handler->insert_id;
	}

	public function __destruct() {
		$this->mysqli_handler->close();
	}
}
?>
