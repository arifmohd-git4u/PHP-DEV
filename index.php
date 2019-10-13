<?php 
  class DatabaseConnection {
    private $connection = '';
  	public function getConnection(){
  		$connection = new mysqli('localhost','root','','mydb');
  		if ($connection->connect_error) { echo "Connection failed";}
  		else {
  			echo "Connected Successfully";
  			return $connection;
  		}
  	}
  }
  class Register {
  	public $user;
  	public $con;
  	public $sql;
  	public function __construct($con,$user){
  		$this->con = $con;
  		$this->user = $user;
  		//echo "Username is {$this->user->name} and Email is {$this->user->email}";
  		$username = $this->user->name;
  		$useremail = $this->user->email;
  		$sql = "INSERT INTO USERS (username,useremail) VALUES ('$username','$useremail')";
  		if (mysqli_query($con,$sql)) {
  		      echo "User Registered Successfully";
  		}
  		else {
  			echo "Error ".mysqli_error($this->con);
  		}
  	}
  }
  class UserDetails {
  	public $name;
  	public $email;
  	public function __construct($name,$email){
  		$this->name = $name;
  		$this->email = $email;
  	}
  	public function getUser(){
  		return new UserDetails($this->name,$this->email);
  	}
  }
  $connection = new DatabaseConnection();
  $con = $connection->getConnection();
  $user = new UserDetails($_POST['name'],$_POST['email']);
  $userDetails = $user->getUser();
  $register = new Register($con,$userDetails);
?>