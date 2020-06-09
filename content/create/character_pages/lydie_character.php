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
  		$smarty->assign('character_name', 'Lydie');
  		$smarty->assign('game_title', 'Lydie & Suelle: The Alchemists and the Mysterious Paintings');
  		$smarty->assign('character_image', '<img src="../../../images/lydie.png" width="25%" height="25%">');
      $smarty->assign('character_facts', '<b>Name:</b> Lydie Malen<br>
        <b>Role:</b> Alchemist<br>
        <b>Weapon:</b> None<br>
        <b>Item:</b> Staff<br>
        ');
      $smarty->assign('character_summary', '<p><b>Character Summary</b></p>
        <p>Lydie is the older twin between she and Suelle, her sister. Her father enjoys alchemy and her mother enjoys painting, though she passed away not too long ago. Lydie is the more softspoken and levelheaded of the twins, using logic and formal education to conduct her alchemy recipes.</p>');
  		//Display the page
  		$smarty->display('extends:jrpgrottolayout.tpl|characterprofiles.tpl'); 
      ?>
  </head>
  <body>  
  </body>
</html>