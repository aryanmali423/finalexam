<?php
// Include the database connection file
include('../../connect.php');
?>

<?php
//error_reporting(0);
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['professor']) && !empty($_POST['reason'])&& !empty($_POST['date'])){
       $pid=$_POST["professor"];
       $reason=$_POST["reason"];
       $dates=$_POST["date"];

	   $datesArray = explode(',', $dates[0]);

//echo"<script> alert($datesArray);</script> ";


// Debug: Output the received values
/*
echo '<pre>';
echo 'Professor ID: ' . $pid . '<br>';
echo 'Reason: ' . $reason . '<br>';
echo 'Dates: ' . print_r($datesArray, true) . '<br>';
echo '</pre>';
*/

	   foreach($datesArray as $d){
		if (!empty($d) && $d != '0000-00-00') {
		$sql="insert into unavailability(p_id,date,reason) values('$pid','$d','$reason')";
		if($result=$conn->query($sql)){
		   // Set the flag to true if at least one insertion is successful
		   $successFlag = true;
		}
		else{
		  // Display error message and break out of the loop if an error occurs
		  echo '<div class="alert alert-warning alert-dismissible fade-show">
		  <a href="index4.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Error!</strong> No Data Inserted.
	  </div>';
	  break;
		}
	}
}
// Display success message if at least one insertion was successful
if ($successFlag) {
    echo '<div class="alert alert-success alert-dismissible fade-show">
        <a href="index4.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> Record Inserted.
    </div>';
}
        
	 }
	 else{
		echo '<div class="alert alert-danger alert-dismissible fade-show" >
		<a href="index4.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Failed!</strong> Please Select Values.
	  </div>
	';
		//echo"<script>alert('Insert some data');</script> ";
	 }
}
?>

<html>
<head>
 <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>UAvailability Of Profesor</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="update_prof.css">

<!--IMPORTANT -->
	<link rel="stylesheet" type="text/css" href="multiselect/css/virtual-select.min.css">

</head>

<script type="text/javascript">
  $(document).ready(function(){
    // Department dependent ajax
    $("#department").on("change",function(){
      var departId = $(this).val();
      $.ajax({
        url :"action.php",
        type:"POST",
        cache:false,
        data:{depId:departId},
        success:function(data){
          $("#programee").html(data);
        }
      });
    });

	    // Program And Department dependent Professor ajax
		$("#programee").on("change",function(){
      var pr_id = $(this).val();
	  var dep_id=document.getElementById("department").value;
      $.ajax({
        url :"action.php",
        type:"POST",
        cache:false,
        data:{prId:pr_id,depid:dep_id},
        success:function(data){
          $("#professor").html(data);
        }
      });
    });

	// Reason Textarea onchange Professor ajax
	$("#professor").on("change",function(){
      var p_id = $(this).val();
      $.ajax({
        url :"action.php",
        type:"POST",
        cache:false,
        data:{pId:p_id},
        success:function(data){
          $("#prof_name").html(data);
        }
      });
    });
    
  });
</script>



<!--CSS For MultiSelect-->
<style>
	#multipleSelect{
  max-width: 100%;
  width: 100vw;
  
}
.vscomp-toggle-button{
  padding: 9px 9px 9px 9px ;
  border-radius: 5px;
 
}
.vscomp-toggle-button:hover {
	    color: black;
	    background: transparent;
	    box-shadow: none;
	    box-shadow:
	        -1px -1px 5px 0px #fff,
	        7px 7px 20px 0px #0003,
	        4px 4px 5px 0px #0002;
	}
	</style>
<body>
<div style="margin-top:40px;background-color:white;border-radius:10px;padding:5px;max-width:800px;"class="container">
		<h3 style="font-size:30px;font-weight:bold;color:gray;text-align:center;">UAvailability Of Profesor</h3>
    <br />
</div>

<div class="formm">
	<div class="sizeform">
		<form action="index4.php" method="post">
			<div class="col-auto">

				<!-- Department dropdown -->
				<label for="department">Department</label>
				<select class="form-control" id="department" name="department1">
					<option value="" selected disabled>Select Department</option>
					<?php
					$query = "SELECT * FROM department";
					$result = $conn->query($query);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo '<option value="'.$row['d_id'].'">'.$row['name'].'</option>';
						}
					}else{
						echo '<option value="">Country not available</option>';
					}
					?>
				</select>
        <br />

				<!-- Programme dropdown -->
				<label for="programee">Programee</label>
				<select class="form-control" id="programee" name="programee1">
					<option value="" selected disabled>Select Programee</option>
				</select>
		<br/>

		<!-- Professor dropdown -->
		<label for="professor">Professor</label>
				<select class="form-control" id="professor" name="professor">
					<option value="" selected disabled>Select Professor</option>
				</select>
		<br/>


		<div id="prof_name">
           
		</div>
		
		<!-- COMMENT
		<label for="multiSelect">Date</label>
		<br>
				
				<select  multiple id="multipleSelect" name="native-select" placeholder="Select a Date" data-search="true" data-silent-initial-value-set="true">
					
					<?php
					/*$query = "SELECT distinct date FROM timetable";
					$result = $conn->query($query);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo '<option value="'.$row['date'].'">'.$row['date'].'</option>';
						}
					}else{
						echo '<option value="">Date Not Avialble</option>';
					}
					*/
					?>
				</select>
				<br>
        <br />
				-->


		<!-- Submit-->
		<input type="submit" value="Submit" name="Submit" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>
	
</body>
</html>

<!-- IMPORTANT-->
<script type="text/javascript" src="multiselect/js/virtual-select.min.js"></script>
  <script>

VirtualSelect.init({ 
  ele: '#multipleSelect' 
});
  </script>

  