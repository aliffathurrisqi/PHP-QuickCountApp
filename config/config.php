<?php 

$base_url = "http://localhost/quickcount/";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quick_count";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// if ($conn->query($sql) === TRUE) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }

// $conn->close();

function login($username, $password) {

    $conn = $GLOBALS['conn'];

    $sql = "SELECT * FROM users WHERE username = '$username'"; 
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['password'] == md5($password)){
                $_SESSION["user_id"] = $row['id'];
                $_SESSION["user_username"] = $row['username'];
                $_SESSION["user_name"] = $row['name'];
                $_SESSION["user_role"] = $row['admin'];

                if($row['admin'] == 1){
                    echo "<script> location.href='admin-dashboard.php'; </script>";
                } else{
                    echo "<script> location.href='dashboard.php'; </script>";
                }

            } else{
                echo "<script>document.getElementById('wrong-password').style.display = 'block';</script>";
            }
        }
      } else {
        echo "<script>document.getElementById('wrong-username').style.display = 'block';</script>";
    }
}

function add_user($username, $password, $name, int $admin, int $created_by) {

    $conn = $GLOBALS['conn'];

    $sql = "INSERT INTO users VALUES (NULL, '$username', md5('$password'), '$name', $admin, $created_by, NULL)"; 
    $conn->query($sql);

    echo "<script> location.href='user.php'; </script>";
}

function edit_user($id, $name) {

    $conn = $GLOBALS['conn'];

    $sql = "UPDATE users SET name = '$name' WHERE id = '$id'"; 

    $conn->query($sql);

    echo "<script> location.href='user.php'; </script>";
}

function delete_user($id) {

    $conn = $GLOBALS['conn'];

    $sql = "DELETE FROM users WHERE id = '$id'"; 

    $conn->query($sql);

    echo "<script> location.href='user.php'; </script>";
}

function add_candidate($name, $color) {

    $conn = $GLOBALS['conn'];

    if($_FILES["img"]["tmp_name"] != NULL){
        $target_dir = "assets/img/candidate/";
        $foto = date('Ymdhis') . '.jpg';

        move_uploaded_file($_FILES["img"]["tmp_name"],  $target_dir . $foto);

        $sql = "INSERT INTO candidates VALUES (NULL, '$name', '$foto', '$color')"; 
    }
    else{
        $sql = "INSERT INTO candidates VALUES (NULL, '$name', NULL, '$color')"; 
    }


    $conn->query($sql);

    echo "<script> location.href='candidate.php'; </script>";
}


function edit_candidate($id, $name, $color) {

    $conn = $GLOBALS['conn'];

    if($_FILES["img"]["tmp_name"] != NULL){

        $sql = "SELECT * FROM candidates WHERE id = $id"; 
        $result = $conn->query($sql);
        
        if ($result) {
            while($row = $result->fetch_assoc()) {
                if($row['image'] != NULL){
                    unlink("assets/img/candidate/". $row['image']);
                }
            }
        }

        $target_dir = "assets/img/candidate/";
        $foto = date('Ymdhis') . '.jpg';

        move_uploaded_file($_FILES["img"]["tmp_name"],  $target_dir . $foto);

        $sql = "UPDATE candidates SET name = '$name', image = '$foto', color = '$color' WHERE id = '$id'"; 
    }
    else{
        $sql = "UPDATE candidates SET name = '$name', color = '$color' WHERE id = '$id'";
    }


    $conn->query($sql);

    echo "<script> location.href='candidate.php'; </script>";
}

function delete_candidate($id) {

    $conn = $GLOBALS['conn'];

        $sql = "SELECT * FROM candidates WHERE id = $id"; 
        $result = $conn->query($sql);
        
        if ($result) {
            while($row = $result->fetch_assoc()) {
                if($row['image'] != NULL){
                    unlink("assets/img/candidate/". $row['image']);
                }
            }
        }

        $sql = "DELETE FROM candidates WHERE id = '$id'"; 

    $conn->query($sql);

    echo "<script> location.href='candidate.php'; </script>";
}

function votes($id, $candidates) {

    $conn = $GLOBALS['conn'];

    $sql = "INSERT INTO votes VALUES (NULL, '$candidates', md5('$id'))"; 
    $conn->query($sql);

    echo "<script> location.href='result.php'; </script>";
}

function check() {

    $conn = $GLOBALS['conn'];
    $id = $_SESSION["user_login"];

    $sql = "SELECT * FROM votes WHERE voted_by = $id"; 
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "alert('Anda Sudah melakukan voting');";
        // echo "<script> location.href='new_url'; </script>";
    } 

}

function logout(){
    session_destroy();
 
    echo "<script> location.href='index.php'; </script>";
}

session_start();
?>