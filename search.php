<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> -->
    <title>Cherchez les informations</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="content_form">
     <div class="content-logo">
        <div class="content-logo">
            <h3>Les Cliniques Universitaires</h3>
            <hr>
            <?php if(!empty($_GET['message'])): ?>
                <div style="color: red;">
                    <?= $_GET['message']; ?>
                </div>
                <hr>
            <?php endif ?>
        </div>
         <div>
            <form method="post" action="find_search.php">
              <input class="input_box" name="identity" type="search" class="search" placeholder="Effectuer une recherche.....">
               <button  type="submit" id="btn">Faire la recherche</button>
            </form>
         </div>
     </div>
    </div>
    <!-- Start of Part dynamic !-->
    <div class="container">

    
    </div>
    <!-- The End of Part of dynamic !-->
</body>
</html>