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

    $sql = "INSERT INTO users VALUES (NULL, '$username', md5('$password'), '$name', $admin, $created_by)"; 
    $conn->query($sql);
}

function votes($id, $candidates) {

    $conn = $GLOBALS['conn'];

    $sql = "INSERT INTO votes VALUES (NULL, '$candidates', '$id')"; 
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

session_start();
?>