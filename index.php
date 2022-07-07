<?php
// INSERT INTO `notes` (`Sno.`, `title`, `description`, `tstamp`) VALUES (NULL, 'buy books', 'please buy books for DSA', current_timestamp());
//connect to the database
$insert=false;
$update=false;
$delete=false;
$servername ="localhost";
$username="root";
$password="";
$database="notes";

$conn = mysqli_connect($servername, $username, $password, $database);


if (!$conn){
    die("Sorry we failed to connect: ".mysqli_connect_error());
}


if(isset($_GET['delete'])){
    $Sno=$_GET['delete'];
    $delete=true;
    $sql ="DELETE FROM `notes` WHERE`Sno.` = '$Sno' ;";
    $result=mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD']=="POST"){
    
    if(isset($_POST['snoEdit'])){
        ///Update the record
        $Sno=$_POST["snoEdit"]; 
        $title=$_POST["titleEdit"]; 
        $description= $_POST["descriptionEdit"];
    
        $sql="UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`Sno.` = '$Sno';";
        $result= mysqli_query($conn,$sql);
        if ($result){
            $update=true;
        }
     else{
            echo"We could not update the record succesfully";
        }
    }
    else{
    $title=$_POST["title"]; 
    $description= $_POST["description"];

    $sql="INSERT INTO `notes` (`title`, `description`) VALUES ('$title','$description')";
    $result= mysqli_query($conn,$sql);
    if($result){
       // echo"The record has been succesfully inserted <br>";
       $insert=true;
    }
    else{
        echo"The record is not succesfully inserted because of this error---->".mysqli_error($conn);
    }
}

}
       

?>





<!doctype html>
<html lang="eng">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-dc2NSrAXbAkjrdm9IYrX10fQq9SDG6Vjz7nQVKdKcJl3pC+k37e7qJR5MVSCS+wR" crossorigin="anonymous">

    <title>iNotes - -Notes taking made easy</title>

</head>

<body>

    <!-- Button trigger modal -->
    <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editmodal">
  Edit Modal
</button>-->

    <!-- Modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit This Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                    <form action="http://localhost/saini/CRUD%20APP/index.php" method="POST">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="mb-3">
                            <label for="title" class="form-label">Note Title</label>
                            <input type="title" class="form-control" id="titleEdit" name="titleEdit"
                                aria-describedby="emailHelp">

                        </div>

                        <div class="mb-3">
                            <label for="desc" class="form-label">Note Description</label>
                            <textarea class="form-control" id="descriptionEdit" name="descriptionEdit"
                                rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Note</button>


                   

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>





    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PHP CRUD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact us!</a>
                    </li>
                </ul>



                <form class="d-flex" role="search">
                    <input class="form-control me-2 ms-1 w-25" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <?php
    if ($insert){
        echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Succes!</strong> Your notes has been inserted succesfully!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }


    ?>
    <?php
    if ($delete){
        echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Succes!</strong> Your notes has been deleted succesfully!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }


    ?>
    <?php
    if ($update){
        echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Succes!</strong> Your notes has been updated succesfully!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }


    ?>

    <div class="container my-4">
        <h2>Add a Note</h2>
        <hr>

        <form action="http://localhost/saini/CRUD%20APP/index.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Note Title</label>
                <input type="title" class="form-control" id="title" name="title" aria-describedby="emailHelp">

            </div>

            <div class="mb-3">
                <label for="desc" class="form-label">Note Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>

    </div>
    <div class="container my-5">

        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
        $sql="SELECT * FROM `notes`";
        $result= mysqli_query($conn, $sql);
        $Sno=0;
        while($row=mysqli_fetch_assoc($result)){
            $Sno = $Sno + 1;
            echo"<tr>
            <th scope='row'>". $Sno ."</th>
            <td>".$row['title']."</td>
            <td>".$row['description']."</td>
            <td>  <button class='edit btn btn-sm btn-primary' id=".$row['Sno.'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['Sno.'].">Delete</button> </td>
            </tr>";
            
        }
        ?>
            </tbody>
        </table>


    </div>
    <hr>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    -->
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit",);
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;
                console.log(title, description);
                titleEdit.value = title;
                descriptionEdit.value = description;
                snoEdit.value = e.target.id;
                console.log(e.target.id)
                $('#editmodal').modal('toggle');

            })
        })

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit",);
                sno = e.target.id.substr(1,)
                if (confirm("Are you sure you want to delete this note!")) {
                    console.log("Yes")
                    window.location = `http://localhost/saini/CRUD%20APP/index.php?delete=${sno}`;
                    //TODO: create a form and use post request to submit a form
                }
                else {
                    console.log("No")
                }



            })
        })
    </script>
</body>

</html>
