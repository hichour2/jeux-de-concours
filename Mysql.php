<?php
class mysql{
		private $id;
		
		function mysql($servername = "localhost", $username = "root", $password = "", $database = "youtube"){
			// Create connection
			$this->id = mysqli_connect($servername, $username, $password,$database);

				// Check connection
				if ($this->id->connect_error) {
					die("Connection failed: " . $this->id->connect_error);
					
				} 
				
				return $this->id;
		}
		function insert($sql) {
		
		  $result = $this->id->query($sql);
		  
		   if (!$result) {
			 return false;
		   } else {
			return $this->id ->insert_id; 
			}

		}
		function select($sql) {
			$resultat = $this->id->query($sql);
			$n = $resultat->num_rows;
			if($n==1){
				$array[]=$resultat->fetch_assoc();
				return $array[0];
				
			}elseif($n>1){
				for($i=0;$i<$n;$i++) {
					$array[]=$resultat->fetch_assoc();
				}
				return $array;
			}
			else return false;
		}
}
?>