<?php include('partials/menu.php'); ?>

      <!-- main section starts !-->
      <div class="main-content">
      <div class="wrapper">
       <h1>Gestion des administrateurs</h1>
      <br><br><br>
<?php
if(isset($_SESSION['add']))
{
      echo $_SESSION['add']; //display the message
      unset($_SESSION['add']); //remove the message
}

if(isset($_SESSION['delete']))
{
      echo $_SESSION['delete'];
      unset($_SESSION['delete']); //remove the message
}
if(isset($_SESSION['update']))
{
      echo $_SESSION['update'];
      unset($_SESSION['update']); //remove the message
}
if(isset($_SESSION['user-not-found']))
{
      echo $_SESSION['user-not-found'];
      unset($_SESSION['user-not-found']); //remove the message
}
if(isset($_SESSION['user-not-match']))
{
      echo $_SESSION['user-not-match'];
      unset($_SESSION['user-not-match']); //remove the message
}
if(isset($_SESSION['change-pwd']))
{
      echo $_SESSION['change-pwd'];
      unset($_SESSION['change-pwd']); //remove the message
}
?>
<br><br><br>
       <a href="add-admin.php" class="btn-primary"> Ajouter administrateur</a>
       <br> <br><br><br>
        <table class= "tbl-full">

    <tr>
    <th> S.N </th>
    <th> Nom </th>
    <th> Pseudo </th>
    <th> Actions </th>
    </tr>

    <?php
            $sql = "SELECT * FROM tbl_admin";

            $res = mysqli_query($conn,$sql);


      if($res==TRUE){
//count rows to check wether we have data or not
      $count = mysqli_num_rows($res);//function to get all the rows in database
      
      $sn=1; //create a variable and assign the value

      //check the num of rows
      if($count>0)
      {

            //we have data in database
            while($rows= mysqli_fetch_assoc($res)){

                  //using while loop to get all the data from database
               //and while loop will run as long as we have data in database

               //get individual data
                        $id=$rows['id'];
                        $full_name=$rows['full_name'];
                        $username=$rows['username'];

               //Display the values in our table
               ?>
<tr>
    <td> <?php echo $sn++?> </td>
    <td> <?php echo $full_name ?> </td>
    <td> <?php echo $username ?> </td>

    <td>   <a href="<?php echo SITEURL; ?>admin/update-password.php?id= <?php echo $id; ?>" class="btn-primary"> changer mot de passe</a>
          <a href="<?php echo SITEURL; ?>admin/update-admin.php?id= <?php echo $id; ?>" class="btn-secondary"> Modifier administrateur</a>
          <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id= <?php echo $id; ?>" class="btn-danger"> Supprimer administrateur</a>
    </td>
    </tr>
               <?php

               
            }
      }
      else{

      }
      }
      
    ?>

    
        </table>
           
    </div>
</div>
    <!-- main section ends !-->

    

    <?php include('partials/footer.php'); ?>