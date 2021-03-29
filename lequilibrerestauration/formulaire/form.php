<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
  
   
    
</head>

<body>
   
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
                      <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.jpg" alt="Restaurant Logo" class="img-responsive"> 
                </a>
               
            </div>
           
            <div class="menu text-right">
                <ul>
                    <li> <h1>L'<span style="color:  #00917C">Equilibre</span> R<span style="color:  #00917C">estauration</span></h1> </li>
                    <li>
                        <a href="index.html">Accueil</a>
                    </li>
                    <li>
                        <a href="foods.html">Notre histoire</a>
                    </li>
                    <li>
                        <a href="categories.html">Menu</a>
                    </li>
                    <li>
                        <a href="foods.html">Commander</a>
                    </li>

                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.html" method="POST">
                <input type="search" name="search" placeholder="Un plat vous tente? Recherchez-le.." required>
                <input type="submit" name="submit" value="Miam!" class="btn btn-primary">
            </form>

        </div>
    </section>
  
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="history">
        <div class="container_contact">
            <div class="image_contact">
                <img src='images/mail.png' alt='icone avion en papier'>
            </div>
            <div class="presentation_contact">
            <p>Vous souhaitez en savoir plus sur nos services traiteur ?</br>
            Nous vous répondons sous 48h.</p>
            </div>
            <div class="login-box">
        <form>
          <div class="user-box">
            <input type="text" name="nom" required="">
            <label>Votre nom</label>
          </div>
          <div class="user-box">
            <input type="text" name="mail" required="">
            <label>Mail</label>
          </div>
          <div class="user-box">
            <input type="text" name="telephone" required="">
            <label>Téléphone</label>
          </div>
          <div class="user-box">
            <input type="text" name="objet" required="">
            <label>Objet</label>
          </div>

          
          <div class="message-box">
          <textarea id="story" name="message" rows="5" cols="33" value="Votre message"></textarea>
          <label for="message">Message</label> 
          </div>
          <div class="submit-box">
            <input type="submit" name="" required="">
          </div>
        </form>
      </div>
            </div>

            </a>
            <a href="#">
            <div class="clearfix"></div>
        </div>
    </section>

        <!-- social Section Starts Here -->
       
        <div class="container text-center footer-grid social">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                <a href="#"><img src="images/mail.svg" class='mail'/></a>
                </li>
            </ul>
            <p class='adresse'>1866 route de Villefort,</br>Saint Martin de Valguagues</br>06 51 48 51 27</p>
            <p class='mentions'><a href="charte.html">Copyright 2021 l'Equilibre Restauration Mentions légales <!--Designed By Sarah Diom, Lindsay Chognon and Delphine Robert--></a></p>
            <p class='ouverture'>Nous sommes ouverts</br>Du mardi au dimanche</br> De 9h à 22h</p>
        </div>


    <!-- footer Section Starts Here -->

  
    <!-- footer Section Ends Here -->

</body>
</html>