
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Display</title>
	<link rel="stylesheet" href="update_prof.css" type="text/css">
    <link rel="shortcut icon" href="../../fevicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
<div style="margin-top:40px;background-color:white;border-radius:10px;padding:10px;max-width:800px;"class="container">
		<h3 style="font-size:30px;font-weight:bold;color:gray;text-align:center;">Display Supervision Chart</h3>
		<!-- ACADEMIC YEAR BLOCK -->
		<div>
			<h3>
				<label style="margin-top:10px;display:flex;justify-content:center;"
					class="d-flex justify-content-center" for="drop1">Academic Year:-
					<?php
					if (date("m") > 5) {
						?>
						<?php echo date("Y") . '-' . (date("y") + 1); ?>
					<?php } else { ?>
						<?php echo (date("Y") - 1) . '-' . date("y"); ?>
					<?php } ?>
				</label>
			</h3>
		</div>
	</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<div class="formm">
		<div class="sizeform">
    <form style="padding:30px;" class="row g-1" method="post" action="display.php">
        <div style="padding: 15px;" class="container ">
            <label for="drop1">Academic Year:-</label>

            <div class="year">
                <select name="ay" class="form-select" aria-label="Default select example" id="drop1">

                    <option class="col-md-3 col-sm-3" value="<?php echo (date("Y")); ?>">
                        <?php echo date("Y") . '-' . (date("y") + 1);
                        ?></option>

                    <option class="col-md-3 col-sm-3" value="<?php echo (date("Y") - 1); ?>">
                        <?php echo (date("Y") - 1) . '-' . date("y");                                                               ?></option>
                </select>
            </div>
        </div>
        <div class="div">
            <hr class="mx-n3">
        </div>
        <div style="padding: 15px;" class=" department container justify-content-center">
            <label for="drop2">Exam type :-</label>
            <select name="exam" class="form-select" aria-label="Default select example" id="exam">
                <option disabled selected>Select Exam type </option>
                <option value="1">Class test </option>
                <option value="2">Regular </option>
                <option value="3">ATKT</option>
            </select>
        </div>
        <div class="div">
            <hr class="mx-n3">
        </div>
        <div style="padding: 20px;" class="container">

            <div class="d-grid gap-2">
                <button class="btn btn-outline-primary" type="submit">Display</button>
            </div>
        </div>
    </form>

</body>

</html>
    <?php require '../connect.php';
    if (isset($_POST['exam'])) { ?>
        <div class="table-responsive">
            <table border='1' class='table table-hover mx-auto px-auto' id="table">
            <?php
            echo "
            <div class='formm1'>
            <div class='sizeform1'>
            <div class='table-responsive'>
    
    <table border='1' class='table table-hover mx-auto px-auto'>
    <thead class='thead-dark'>
    <thead class='thead-dark'>
            
            <th>Date</th>
            <th>Name</th>
           
            </thead> 
            ";
        
            $e = $_POST["exam"];
            $ay = $_POST['ay'];
            $sql = "SELECT * FROM display  WHERE e_id='$e' and a_year='$ay';";
            
            $result = mysqli_query($conn, $sql);
           
            $count = mysqli_num_rows($result);
         
            if ($result) {
                $resultt = $result->fetch_all(MYSQLI_ASSOC);
               
                foreach ($resultt as $row){
                   
                        $p_id = $row['p_id'];
                        $date=$row['date'];
                        $sql1="SELECT * FROM professor WHERE p_id='$p_id'";
                        $result1=mysqli_query($conn,$sql1);
                        $userdata=mysqli_fetch_array($result1);
                        echo "<tr><td>$date</td><td>{$userdata['name']}</td></tr>";
                        
                    }     
            } else {
                echo "No data found";
            }
        } else {
            echo "<script>";
            echo 'alert("Please Select Exam type")';
            echo "</script>";
        }
        echo "
        </table>
        </div>
        </div>
        ";
            ?>
           
