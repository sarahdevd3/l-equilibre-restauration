<?php include('partials/menu.php'); ?>

      <!-- main section starts !-->
      <div class="main-content">
      <div class="wrapper">
       <h1>Gestion des Catégories</h1>
       <br><br><br>
<?php
       if(isset($_SESSION['add']))
{
      echo $_SESSION['add'];
      unset($_SESSION['add']); //remove the message
}
if(isset($_SESSION['remove']))
{
      echo $_SESSION['remove'];
      unset($_SESSION['remove']); //remove the message
}
if(isset($_SESSION['delete']))
{
      echo $_SESSION['delete'];
      unset($_SESSION['delete']); //remove the message
}

if(isset($_SESSION['no-category-found']))
{
      echo $_SESSION['no-category-found'];
      unset($_SESSION['no-category-found']); //remove the message
}
if(isset($_SESSION['update']))
{
      echo $_SESSION['update'];
      unset($_SESSION['update']); //remove the message
}
if(isset($_SESSION['failed-remove']))
{
      echo $_SESSION['failed-remove'];
      unset($_SESSION['failed-remove']); //remove the message
}


?>

<br><br>
       <!-- add category form -->
<a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary"> Ajouter une categorie </a>
       <br> <br><br><br>


<table class= "tbl-full">

    <tr>
    <th> S.N </th>
    <th> Titre </th>
    <th> Image </th>
    <th> Featured </th>
    <th> Active </th>
    <th> Actions </th>
    </tr>
  <?php
        $sql="SELECT*FROM tbl_category";
        $res = mysqli_query($conn, $sql);

        $sn=1;

        //count rows

        $count = mysqli_num_rows($res);

        if($count>0)
        {
            // we have data in database
            while($row=mysqli_fetch_assoc($res)){
                  $id=$row['id'];
                  $title=$row['title'];
                  $image_name=$row['image_name'];
                  $featured=$row['featured'];
                  $active=$row['active'];
?>
    <tr>
    <td><?php echo $sn++; ?> </td>
    <td> <?php echo $title; ?> </td>

    <td> <?php 
        if($image_name!="")
        {
          ?>
          <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
          <?php
        }
        else
        {
            echo "<div class='error'>Image non ajoutée .</div>"; 
        }
    ?> </td>

    
    <td> <?php echo $featured; ?> </td>
    <td> <?php echo $active; ?></td>
    <td>  <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary"> Modifier la catégorie</a>
          <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-danger"> Supprimer la catégorie</a>
    </td>
    </tr>

<?php
            }
        }
        else
        {
            //no data display the message
            ?>
            <tr>
                  <td colspan="6"><div class="error">Aucune catégorie ajoutée</div> </td>
        </tr>
        <?php
        }

  ?>
    </table>

        </div>
</div>
    <!-- main section ends !-->

    

    <?php include('partials/footer.php'); ?>