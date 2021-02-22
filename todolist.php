<?php
 $con=mysqli_connect("localhost","root","","todos");
 if(isset($_POST['todo']))
 {
    $todo=$_POST['todo'];
    mysqli_query($con,"insert into todo(task)values('$todo')");
}
if(isset($_GET['completes']))
{
    $todo=$_GET['completes'];
    mysqli_query($con,"update todo set completes=1 where id=$todo");  
}

if(isset($_GET['delete']))
{
    $todo=$_GET['delete'];
    mysqli_query($con,"delete from todo where id=$todo");  
}

 $todos=mysqli_query($con,"select * from todo;");
 $todos=mysqli_fetch_all($todos,MYSQLI_ASSOC);
 
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todolist</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="todo1.css">
</head>
<body>
    <h1 class="heading">todos</h1>
    <form action="todolist.php" method="POST">
        <div class="firstmaindiv">
            <div class="seconddiv">
                <input type="text" name="todo" class="task" placeholder="type your todo">
            </div>
            <div class="thirddiv">
                <button type="submit" class="btn"><i class="fa fa-plus" ></i></button>
            </div>
        </div>
    </form>

    <table class="table">
    <tr>
     <th>
         completed
     </th>
     <th>
         task
     </th>
     <th>
         time
     </th>
     <th>
         delete
     </th>
    </tr> 
    <?php foreach($todos as $todo)
    {?>
    <tr>
        <td>
            
            <?php
            if($todo['completes']==1)
            {
                ?>
                <button class="btn1"><i class="fa fa-check"></i></button>
                <?php
            }
            else
            {
                ?>
                <a href="?completes=<?php
                echo $todo['id'];
                ?>
                ">
                <button class="btn1"><i class="fa fa-times"></i></button></a>
                <?php
            }
            ?>
            
        </td>
        <td> 
          <?php
          echo $todo['task'];
          ?>
           
        </td>
        <td>
            <?php
            echo $todo['time'];
            ?>
        </td>
        <td><a href="?delete=<?php 
      echo $todo['id'];
        ?>">
        <button class="btn1">
            <i class="fa fa-trash"></i></button></a>
        </td>
    </tr>
     <?php  
    } 
    ?>
    </table>
   
</body>
</html>