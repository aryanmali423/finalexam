<?php
// Include the database connection file
include('../connect.php');

?>
<?php
    include( "../navbar1.php");
?>
   
<html>
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Timetable</title>
    <link rel="shortcut icon" href="../fevicon.png">
	<link rel="stylesheet" href="../css/indexmain.css" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<script type="text/javascript">
  $(document).ready(function(){
    // Programme dependent ajax
    $("#programee").on("change",function(){
      var countryId = $(this).val();
	  var progId = document.getElementById("programee").value;
	  
      $.ajax({
        url :"action.php",
        type:"POST",
        cache:false,
        data:{countryId:countryId},
        success:function(data){
          $("#semester").html(data);
        }
      });
    });


	   // Show dependent ajax
		$("#Show").on("click",function(){
      var progId = document.getElementById("programee").value;
	  var sem=document.getElementById("semester").value;
	  var year=document.getElementById("year").value;
	  var type=document.getElementById("examtype").value;
      $.ajax({
        url :"table.php",
        type:"POST",
        cache:false,
        data:{progid:progId,semid:sem,yearid:year,examid:type},
        success:function(data){
          $("#table").html(data);
        }
      });
    });
    

//Submit button show click Show

$("#Show").on("click",function(){
     $("#Submit").show();//display submit
	 $("#selectall").show();//display select all
});


  });


 //For Checkbox Toggle Function
 function toggle(checkbox,inputfield,ftime,ttime,nob){
inputfield.disabled=!checkbox.checked;
ftime.disabled=!checkbox.checked;
ttime.disabled=!checkbox.checked;
nob.disabled=!checkbox.checked;
//input.disabled=!true(false) 
//input.disabled=!false(true)
  }
  function toggleSelectAll(checkbox) {
            var dateInputs = document.querySelectorAll('.form-control.date-input');
            for (var i = 0; i < dateInputs.length; i++) {
                dateInputs[i].disabled = !checkbox.checked;
				//dateInputs[i].checked=checkbox.checked;
            }

			var checkboxes=document.querySelectorAll('input[type="checkbox"]');
            for (let i=1;i<checkboxes.length;i++){
            checkboxes[i].checked=checkbox.checked;
}
        }
		
</script>

<body>

<div style="margin-top:80px;background-color:white;border-radius:10px;padding:5px;max-width:800px;" class="container">
		<h3 style="font-size:30px;font-weight:bold;color:gray;text-align:center;">Feed Timetable</h3>
		  <!-- ACADEMIC YEAR BLOCK -->
		   <div>
        <h3>
          <label style="margin-top:10px;display:flex;justify-content:center;" class="d-flex justify-content-center" for="drop1">Academic Year:-
        
              <?php echo date("Y") . '-' . (date("y") + 1);  ?>
            </label>
        </h3>
      </div>
	</div>


	<div class="formm">
		<div class="sizeform">
		<form action="insert(feed).php" method="post">
			<div class="col-auto">

			<!-- Acedemic Year dropdown -->
			<div >
				<label for="yera">Acedemic Year:-</label>
				</div>
				<select class="form-control" id="year" name="year">
					<option value="" selected disabled>Select Year</option>
					<?php
					$year=date('Y');	
					echo '<option value="'.$year.'">'.$year.' - '.($year+1).'</option>';
					echo '<option value="'.($year+1).'">'.($year+1).' - '.($year+2).'</option>';
					?>
				</select>
		<br/>
				<!-- Programme dropdown -->
				<label for="programee">Programme:-</label>
				<select class="form-control" id="programee" name="programee1" require>
					<option value="" selected disabled>Select Programme</option>
					<?php
					$query = "SELECT * FROM programme";
					$result = $conn->query($query);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo '<option value="'.$row['pr_id'].'">'.$row['pr_name'].'</option>';
						}
					}else{
						echo '<option value="" selected disabled>Programee not available</option>';
					}
					?>
				</select>
        <br />

				<!-- Semester dropdown -->
				<label for="semester">Semester:-</label>
				<select class="form-control" id="semester" name="semester1" require>
					<option value="" selected disabled>Select Semester</option>
				</select>
		<br/>

		<!-- Exam type dropdown -->
				<label for="examtype">Exam Type:-</label>
				<select class="form-control" id="examtype" name="examtype1">
					<option value="" selected disabled>Select Type</option>
					<?php
					$query = "SELECT * FROM exam";
					$result = $conn->query($query);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							if($row['type']=='C'){
							echo '<option value="'.$row['e_id'].'">Class Test</option>';
						}
						elseif($row['type']=='R'){
							echo '<option value="'.$row['e_id'].'">Regular</option>';
						}
						elseif($row['type']=='A'){
							echo '<option value="'.$row['e_id'].'">ATKT</option>';
						}
					}
					}else{
						echo '<option value="" selected disabled>Exam type not available</option>';
					}
					?>
				</select>
		<br/>
		

		<!-- Show button-->
			<div style="display:flex;justify-content:center;">

				<div style="" class="d-grid gap-2 submit">
				<input type="button" class="btn mt-3"  value="Show" id="Show" name="Show">
          
              </div></div>	
        <!-- Select All Checkbox-->
		<div class=" row" style="display:none;" id="selectall">
			<div class="col-md-12 text-right">
			<label class="mr-3">Select All:</label>
				<input type="checkbox" onchange="toggleSelectAll(this)">
			</div>
		</div>
		<!-- Table-->	
		<div class="table-responsive">
                <table border='1' class='table table-hover mx-auto px-auto' id="table">
				</table>

				</div>
		<!-- Submit button-->
		<div style="display:flex;justify-content:center;">

				<div style="" class="d-grid gap-2 submit">
				<input type="submit" value="Submit" name="Submit" id="Submit" class="btn mt-3"  style="display:none;">

    </div></div>	
				</div></div>
		</form>
		</div>
</body>
</html>