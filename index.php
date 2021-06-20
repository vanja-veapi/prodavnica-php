<?php
   require_once "models/functions.php";

   require_once "views/fixed/head.php";
   require_once "config/connection.php";
?>
   <!-- body -->
   <body class="main-layout">
                        <!-- loader  -->
                        <!-- <div class="loader_bg">
                           <div class="loader"><img src="assets/images/loading.gif" alt="#" /></div>
                        </div> -->
                        <!-- end loader -->
      <!-- header -->
      <?php
         // require_once "views/fixed/header-nav.php";
      ?>
      <!-- end banner -->
      <?php
         if(isset($_GET['page']))
         {
            switch($_GET['page'])
            {
               case "about":
                  require_once "views/fixed/header-nav.php";
                  require_once "views/pages/about.php";
                  break;
               case "contact":
                  require_once "views/fixed/header-nav.php";
                  require_once "views/pages/contact.php";
                  break;
               case "shop":
                  require_once "views/fixed/header-nav.php";
                  require_once "views/pages/shop.php";
                  break;
               case "register":
                  require_once "views/fixed/header-nav.php";
                  require_once "views/pages/register.php";
                  break;
               case "login":
                  require_once "views/fixed/header-nav.php";
                  require_once "views/pages/login.php";
                  break;
               case "korisnik":
                  require_once "views/fixed/header-nav.php";
                  require_once "views/pages/korisnik.php";
                  break;
               case "admin":
                  require_once "views/pages/admin-panel.php";
                  break;
            }
         }
         else
         {
            require_once "views/fixed/header-nav.php";
?>
            <div class="container">
            <div class="row">
               <ul class="mt-2 w-100">
                  <li><h1 class='text-center'>Dobrodosli na najpovoljniji sajt za računare</h1></li>
                  <li><p class='text-center mb-3'>Očekuje Vas veliki izbor kompjuter, laptopova za bilo koju namenu.</p></li>
               </ul>
               <img src="assets/images/about_img.png" alt="About" class="img-fluid"/>
            </div>
         </div>
<?php
         }
?>
      <!-- two_box section -->
      <!-- end two_box section -->
      <!--  footer -->
      <?php
         require_once "views/fixed/footer.php";
      ?>
      <!-- end footer -->
      <!-- Javascript files-->
      <?php
         require_once "views/fixed/script.php";
      ?>
   </body>
</html>
