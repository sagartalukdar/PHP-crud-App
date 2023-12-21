
<?php 
include 'connection.php';
$insert=false;
$update=false;
$delete=false;
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <title>PHP CRUD PROJECT</title>
  </head>
  <body>

    <!-- Modal -->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
            <form action="/crudproject/index.php" method="post">
              <input type="hidden" name="editid" id="editid">
             <div class="modal-body">  
              <div class="mb-3">
                <label for="editemail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="editemail" name="editemail">
            
              </div>
              <div class="mb-3">
                <label for="editpassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="editpassword" name="editpassword">
              </div>
              
                      
             </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Edit</button>
              </div>
            </form>

        </div>
      </div>
    </div>   

    <!-- modal end-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <img src="https://images.pexels.com/photos/390574/pexels-photo-390574.jpeg?auto=compress&cs=tinysrgb&w=600" height="50px" width="100px">
          <a class="navbar-brand" href="#">PHP CRUD</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
 
    <!-- crud -->
    <?php 
    if(isset($_GET['delete'])){
      $deleteid=$_GET['delete'];
      $sql="delete from `users` where `users`.`id`=$deleteid;";
      $res=mysqli_query($con,$sql);
      if($res){
        $delete=true;
      }
    }
    if($_SERVER['REQUEST_METHOD']=='POST'){
      // update
      if(isset($_POST['editid'])){
        $editid=$_POST['editid'];
        $editemail=$_POST['editemail'];
        $editpassword=$_POST['editpassword'];
        $sql="UPDATE `users` SET `email` = '$editemail', `password` = '$editpassword' WHERE `users`.`id` = $editid;";
        $res=mysqli_query($con,$sql);
        if($res){
          $update=true;
        }else echo "not updated";
      }
      // insert
      else{
      $email=$_POST['email'];
      $password=$_POST['password'];
      
      $sql="INSERT INTO `users` ( `email`, `password`) VALUES ( '$email', '$password');";
      $res=mysqli_query($con,$sql);
      if($res){
        $insert=true;
      }else echo "not inserted";
      }
    }
    ?>
    <!-- allerts -->
     <?php 
      if($insert==true){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Successfull!</strong> your data has been inserted.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
      if($update==true){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Successfull!</strong> your data has been updated.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
      if($delete==true){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Successfull!</strong> your data has been deleted.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
     ?>

    <!-- allerts -->

    <!-- form start -->
   
    <div class="container">
      <h1>Enter Your Email & password!</h1>
    <form action="/crudproject/index.php" method="post">
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email">
    
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>


  <div class="container">

  <table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Email</th>
      <th scope="col">Password</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $sql= "select * from `users`";
    $res=mysqli_query($con,$sql);
    while ($row =mysqli_fetch_assoc($res)){
    ?>
    <tr>
      <th scope="row"><?php echo $row['id'] ?></th>
      <td><?php echo $row['email']?></td>
      <td><?php echo $row['password']?></td>
      <td>
      <a href="" class="btn btn-sm btn-primary edit" data-bs-toggle="modal" data-bs-target="#edit"> Edit</a>
      <a herf="" class="btn btn-sm btn-danger delete">Delete</a>
      </td>
    </tr>
    <?php } ?>
   
  </tbody>
</table>

  </div>
    <!-- form end -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->



    <!-- custom js -->
    <script>
     edits=document.getElementsByClassName('edit');
     Array.from(edits).forEach((ele)=>{
        ele.addEventListener("click",(e)=>{
          tr=e.target.parentNode.parentNode;
          editemail.value=tr.getElementsByTagName('td')[0].innerText;
          editpassword.value=tr.getElementsByTagName('td')[1].innerText;
          
          ei=tr.getElementsByTagName('th')[0].innerText;
          editid.value=ei;
          console.log(ei);
        })
     })

     deletes=document.getElementsByClassName('delete');
     Array.from(deletes).forEach((ele)=>{
      ele.addEventListener("click",(act)=>{
        deleteid=act.target.parentNode.parentNode.getElementsByTagName('th')[0].innerText;
        console.log(deleteid);
        if(confirm("want to delete this !")){
          window.location=`/crudproject/index.php?delete=${deleteid}`;
        }
       
      })
     })
    </script>
  </body>
</html>