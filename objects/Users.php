<?php 
class Users{
	private $conn;
	private $table_name="tblUsers";
	
	//entity attributes
	public $id;
	public $username;
	public $password;
	public $emailid;
	public $mobileno;
	public $address;
	public $usercreated;
	
	//connection for database
	public function __construct($db)
	{
		$this->conn=$db;
	}
	function read(){
		$query="SELECT * FROM ".$this->table_name;
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	
	function create()
	{
		$query="INSERT INTO
		".$this->table_name."
		SET
			username=:username, password=:password, emailid=:emailid, mobileno=:mobileno, address=:address";
			
		$stmt=$this->conn->prepare($query);
		
		$this->username=htmlspecialchars(strip_tags($this->username));
		$this->password=htmlspecialchars(strip_tags($this->password));
		$this->emailid=htmlspecialchars(strip_tags($this->emailid));
		$this->mobileno=htmlspecialchars(strip_tags($this->mobileno));
		$this->address=htmlspecialchars(strip_tags($this->address));
			
		// bind values
		$stmt->bindParam(":username", $this->username);
		$stmt->bindParam(":password", $this->password);
		$stmt->bindParam(":emailid", $this->emailid);
		$stmt->bindParam(":mobileno", $this->mobileno);
		$stmt->bindParam(":address", $this->address);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;	
	}
	
}

?>