<?php
// Include the database connection file
include('../connect.php');
error_reporting(0);
//If DATE and TIME Are Send(Set)
if(isset($_POST['course_date']) && !empty($_POST['f_time'])&& !empty($_POST['to_time'])&& !empty($_POST['nob'])){
    $year=$_POST["year"];
    $prog=$_POST["programee1"];
    #$sem=$_POST["semester1"];
    $e_id=$_POST["examtype1"];
    $date=$_POST["course_date"];
    $f_time=$_POST["f_time"];
    $t_time=$_POST["to_time"];
    $nob=$_POST["nob"];

    $success1=false;
    $success2=false;

    //Checking Old Record Exist
    foreach($date as $c_id=>$date1){
        $sql="select*from timetable where pr_id='$prog' AND c_id='$c_id' AND e_id='$e_id' AND academic_year='$year'";
        $result=$conn->query($sql);

         //If Exist Update
        if($result->num_rows>0){

          $update=true;  //for validation alert message

          //echo"Old record yes";
          if(array_key_exists($c_id,$f_time)){
            $time=$f_time[$c_id];
            #echo $time;
            }
          if(array_key_exists($c_id,$t_time)){
            $time1=$t_time[$c_id];
            #echo $time1;
           }
           if(array_key_exists($c_id,$nob)){
            $nob1=$nob[$c_id];
            #echo $nob1;
           }
          $update="update timetable SET date='$date1',f_time='$time',t_time='$time1',nob='$nob1' where pr_id='$prog' AND c_id='$c_id' AND e_id='$e_id' AND academic_year='$year'";
          if($conn->query($update) ===TRUE){
            /*
            echo "
            <script>
            alert('Record Updated Sucessfully');
            </script>
             ";
             
            echo'<META HTTP-EQUIV="Refresh" Content="0.5;URL=index2.php">';
            */

            $success1= true;
          }
          else{
            /*
            echo "
            <script>
            alert('ERROR! Updating Record');
            </script>
             ";
            echo'<META HTTP-EQUIV="Refresh" Content="0.5;URL=index2.php">';
            */

            break;
           //echo "Error Updating Record".$conn->error;

           }
        }

        //If Does'nt Exist Insert
        else{
          $newr=true; //validation alert message

            //echo"New Record Yes";
            if(array_key_exists($c_id,$f_time)){
                $time=$f_time[$c_id];
                #echo $time;
            }
            if(array_key_exists($c_id,$t_time)){
                $time1=$t_time[$c_id];
                #echo $time1;
            }
            if(array_key_exists($c_id,$nob)){
              $nob1=$nob[$c_id];
              #echo $nob1;
             }
            $sql1="insert into timetable(pr_id,c_id,e_id,date,f_time,t_time,nob,academic_year) values('$prog','$c_id','$e_id','$date1','$time','$time1','$nob1','$year')";
            if($conn->query($sql1) ===TRUE){
              /*
              echo "
              <script>
              alert('New Record Inserted Sucessfully');
              </script>
               ";
               echo'<META HTTP-EQUIV="Refresh" Content="0.5;URL=index2.php">';
               */
              $success2=true;
               }
               else{
                /*
                echo "
                <script>
                alert('ERROR Inserting New Record!');
                </script>
                 ";
                 echo'<META HTTP-EQUIV="Refresh" Content="0.5;URL=index2.php">';

                // echo "Error Inserting New Record".$conn->error;
                */
                break;
                }
        }
        }
        if($update){
        if($success1){
          echo "
          <script>
          alert('Record Updated Sucessfully');
          </script>
           ";
           
          echo'<META HTTP-EQUIV="Refresh" Content="0.5;URL=index2.php">';
        }
        else{
          echo "
            <script>
            alert('ERROR! Updating Record');
            </script>
             ";
            echo'<META HTTP-EQUIV="Refresh" Content="0.5;URL=index2.php">';
        }
      }
        elseif($newr){
        if($success2){
          echo "
          <script>
          alert('New Record Inserted Sucessfully');
          </script>
           ";
           echo'<META HTTP-EQUIV="Refresh" Content="0.5;URL=index2.php">';
        }
        else{
          echo "
          <script>
          alert('ERROR Inserting New Record!');
          </script>
           ";
           echo'<META HTTP-EQUIV="Refresh" Content="0.5;URL=index2.php">';
        }
      }

}

else{
    echo "
    <script>
alert('Please Insert Some Values!');
document.location.href='index2.php';
    </script>
    ";

}
?>