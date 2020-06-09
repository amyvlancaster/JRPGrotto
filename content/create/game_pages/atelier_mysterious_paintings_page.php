<!-- Debugging Complete -->
<!DOCTYPE html>
<html>
  <head>

    <?php
      // Initialize the session
      session_start();
      // Check if the user is logged in, if not then redirect him to login page
      if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
          header("location: ../../login.php");
          exit;
      }
  		//must be included in every script    
  		require_once '../../../layouts/layoutconfig.php';	
  		//Assign values to template variables
      $smarty->assign('game_title', 'Atelier Lydie & Suelle: The Alchemists and the Mysterious Paintings');
  		$smarty->assign('subseries', 'The Mysterious Series');
  		$smarty->assign('box_art', '<img src="../../../images/mysteriouspaintings.jpg" width="50%" height="50%">');
      $smarty->assign('platform', '<b>Platform(s):</b> Playstation 4, Nintendo Switch');
      $smarty->assign('release', '<b>Release Date:</b> December 21st, 2017');
      $smarty->assign('publisher', '<b>Publisher:</b> Koei Tecmo');
  			//Display page
  		$smarty->display('extends:jrpgrottolayout.tpl|games.tpl'); 
    ?>
  </head>
  <body> 
  </body>
</html>