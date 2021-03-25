<?php include('partials/menu.php'); ?>

      <!-- main section starts !-->
      <div class="main-content">
      <div class="wrapper">
       <h1>Gestion des Commandes</h1>
    
       <br> <br><br><br>
       
       <table class= "tbl-full">

    <tr>
    <th> S.N </th>
    <th> Plat </th>
    <th> Quantité </th>
    <th> Date de commande</th>
    <th> statut </th>
    <th> Nom du client </th>
    <th> Email </th>
    <th> Adresse </th>
    <th> Actions </th>
    </tr>
        
        </table>
        <?php
        $sql="SELECT*FROM tbl_order";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if($count>0)
        {

        }
        else
        {
              echo"<tr> <td colspan '12' class='error'>Image non ajoutée .</tr> <td/>"; 
        }
?>
        <tr>
    <td> S.N </td>
    <td> S.N </td>
    <td> S.N </td>
    <td> S.N </td>
    <td> S.N </td>
    <td> S.N </td>
    <td> S.N </td>
    <td> S.N </td>
    <td> S.N </td>
    </tr>

               
    </div>
</div>
    <!-- main section ends !-->

    

    <?php include('partials/footer.php'); ?>