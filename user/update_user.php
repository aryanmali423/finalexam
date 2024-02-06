<?php
    include( "../navbar1.php");
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update User</title>
    <link rel="shortcut icon" href="../../fevicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
    <link href="../css/updateuser.css" rel="stylesheet" type="text/css">

</head>
<body>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="login">
        <h1>Update User</h1>
        <form class="row  mg-auto" method="POST" action="update_user.php">
          <div class="form-group">
            <input type="text" class="form-control " id="user" name="username" placeholder="Username">
          </div>
          <button type="submit" class="btn btn-lg btn-block  ">UPDATE</button>
      </div>
    </div>
  </div>
</div>
<!-- PHPPPPP -->
<?php
error_reporting(0);

require "../connect.php";
session_start();
$username = md5(uniqid(rand(), TRUE));

if (isset($_POST['admin'])) {
  $admin = $_POST['admin'];
 // echo $admin;
  $type = $_POST['type'];

  $username = $_SESSION['username'];
  $s = "UPDATE login set type='$type',status='$admin' WHERE username='$username'";
  $qu = $conn->query($s);
  //echo mysqli_num_rows($qu) . "row selected";
 // echo $username;
} else {

  if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $_SESSION['username'] = $username;

    $sql = "SELECT l.p_id,l.type,l.status,p.name,d.name as department  FROM login as l JOIN professor as p ON l.p_id=p.p_id JOIN department as d ON p.d_id=d.d_id WHERE l.username='$username'";
    $q = $conn->query($sql);
    $count = mysqli_num_rows($q);
 //  echo $count;
    if ($count) {
      $userdata = mysqli_fetch_array($q);
      $p_id = $userdata['p_id'];
      $type = $userdata['type'];
      $status = $userdata['status'];
      $name = $userdata['name'];
      $department = $userdata['department'];


      ?>
      <form action="index.html" method="post">
<hr>
        <h1 style="color:white;font-weight: 500;" class="row justify-content-center">User Details</h1>


      </form>
      <div class="mainsize">
        <form method="POST" action="update_user.php" name="form2">
          <fieldset disabled>

            <div class="mb-3">
              <label for="disabledTextInput" class="form-label">Name : </label>
              <input type="text" id="disabledTextInput" class="form-control" value="<?php echo $name ?>">
            </div>
            <hr class="mx-n3">

            <div class="mb-3">
              <label for="disabledTextInput" class="form-label">Department : </label>
              <input type="text" id="disabledTextInput1" class="form-control" value="<?php echo $department ?>">
            </div>
            <hr class="mx-n3">

            <!-- <div class="mb-3">
              <label for="disabledTextInput" class="form-label">UserName : </label>
              <input type="text" id="disabledTextInput" class="form-control"name="username" value="">
            </div> -->
          </fieldset>
          <label for="disabledTextInput" class="form-label">Type : </label>
          <?php if ($type === 'A') { ?>
            <div class="form-check">

              <input class="form-check-input" type="radio" name="admin" id="admin1" value='A' checked>
              <label class="form-check-label" for="admin1">
                Admin
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="admin" id="admin2" value='O'>
              <label class="form-check-label" for="admin2">
                Other
              </label>
            </div>

          <?php } else {
            ?>
            <div class="form-check">

              <input class="form-check-input" type="radio" name="admin" id="admin1" value='A'>
              <label class="form-check-label" for="admin1">
                Admin
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="admin" id="admin2" value='O' checked>
              <label class="form-check-label" for="admin2">
                Other
              </label>
            </div>
            <?php
          }
          ?>
          <hr class="mx-n3">
          <label for="disabledTextInput" class="form-label">Active: </label>
          <?php if ($status === 'A') { ?>
            <div class="form-check">

              <input class="form-check-input" type="radio" name="type" id="type1" value='A' checked>
              <label class="form-check-label" for="type1">
                Yes
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="type" id="type2" value='I'>
              <label class="form-check-label" for="type2">
                No
              </label>
            </div>
          <?php } else {
            ?>
            <div class="form-check">

              <input class="form-check-input" type="radio" name="type" id="type1" value='A'>
              <label class="form-check-label" for="type1">
                Yes
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="type" id="type2" value='I' checked>
              <label class="form-check-label" for="type2">
                No
              </label>
            </div>
          <?php }
          ?>
          <hr class="mx-n3">

          <button style="    background: linear-gradient(to right, #aeaeae, #aaaaaa);
" type="submit" class="btn btn-lg btn-block ">Submit</button>

        </form>
        <?php


    }
    else{
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style=" width:100%; position: absolute; top: 0; left: 0; ">
        <strong>Error!</strong> Invalid username.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
  }
}
?>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>