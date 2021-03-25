<?php include('partials/menu.php'); ?>

      <!-- main section starts !-->
      <div class="main-content">
      <div class="wrapper">
       <h1>Gestionnaire</h1>
<?php
       if(isset($_SESSION['login'])){
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }

    ?>
       <div class="col-4 text-center">
           <h1>5</h1>
</br>
           Categories
           </div>

           <div class="col-4 text-center">
           <h1>5</h1>
</br>
           Categories
           </div>

           <div class="col-4 text-center">
           <h1>5</h1>
</br>
           Categories
           </div>

           <div class="col-4 text-center">
           <h1>5</h1>
</br>
           Categories
           </div>
           <div class="clearfix"></div>
    </div>
</div>
    <!-- main section ends !-->

    

</body>
</html><?php include('partials/footer.php'); ?>