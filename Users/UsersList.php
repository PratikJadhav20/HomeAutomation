<?php
include('../include/navbar.php');
?>
         <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">User List</h1>
                        </div>
                    </div>
                </div>
				
				<?php
				
				// include database and object files
				include_once '../config/database.php'; 
				include_once '../objects/Users.php';

				// instantiate database and user object 
				$database=new Database();
				$db=$database->getConnection();

				$users=new Users($db);

				$stmt=$users->read();

				$num = $stmt->rowCount();
				 ?>
				 <table class="table">
				 <thead><tr><th>#</th><th>username</th><th>password</th><th>emailid</th></tr>
				 </thead>
				 <tbody>
				 <?php
				 
				// check if more than 0 record found
				if($num>0){
				 
					// users array
					$users_arr=array();
					$users_arr["records"]=array();
				 
					// retrieve our table contents
					// fetch() is faster than fetchAll()    
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
						// extract row
						// this will make $row['name'] to
						// just $name only
						?><tr><?php
						extract($row);
						$user_item=array(
							"id" => $id,
							"username" => $username,
							"password" => html_entity_decode($password),
							"emailid" => $emailid,
							"mobileno" => $mobileno,
							"address" => $address,
							"usercreated" => $usercreated
						);
						echo "<td>".$row['id']."</td><td>".$row['username']."</td><td>".$row['password']."</td><td>".$row['emailid']."</td>";
						?>
						
						</tr>
						<?php
					}
				}
				else
				{
					echo "No Users found";
				}	

				?></tbody>
				</table>
         </div>
		 
		 