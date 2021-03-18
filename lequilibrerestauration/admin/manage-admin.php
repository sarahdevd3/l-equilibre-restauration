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

    <tr>
    <td> 1 </td>
    <td> Samir Yakhlef </td>
    <td> Samir Yakhlef </td>
    <td>  <a href="#" class="btn-secondary"> Modifier administrateur</a>
          <a href="#" class="btn-danger"> Supprimer administrateur</a>
    </td>
    </tr>

    <tr>
    <td> 1 </td>
    <td> Samir Yakhlef </td>
    <td> Samir Yakhlef </td>
    <td>  <a href="#" class="btn-secondary"> Modifier administrateur</a>
          <a href="#" class="btn-danger"> Supprimer administrateur</a>
    </td>
    </tr>

    <tr>
    <td> 1 </td>
    <td> Samir Yakhlef </td>
    <td> Samir Yakhlef </td>
    <td>  <a href="#" class="btn-secondary"> Modifier administrateur</a>
          <a href="#" class="btn-danger"> Supprimer administrateur</a>
    </td>
    </tr>
        
        </table>
           
    </div>
</div>
    <!-- main section ends !-->

    

    <?php include('partials/footer.php'); ?>