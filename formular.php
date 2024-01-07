<?php
if ( isset($_POST['sendform']) && ($_POST['security'] == 'secure') ) :
    if ( !empty($_POST['email']) ) :
      if ( !empty($_POST['optin']) ) :     
   
        $gender = htmlspecialchars($_POST['gender']);
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);
 
        $formmail = 'deineEmail@adresse.de';
 
        if ( preg_match("/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email) ) :          
           
          $subject = 'Eine neue Kontaktformularanfrage ist eingetroffen.';
          $message = "
            <html>
            <head>
            <title>Neue Anfrage</title>
            </head>
              <body>
                <p>Eine neue Anfrage von " . $gender . " " . $name . " ist eingegangen.</p>
                <p>Die hinterlegte E-Mail-Adresse lautet: " . $email . ".</p>
                <p><strong>Nachricht:</strong> <br> " . $message . "</p>
              </body>
            </html>
          ";
 
          $userSubject = 'Ihre Anfrage bei DeinName.';
          $userMessage = "
            <html>
            <head>
             <title>Deine Überschrift in der E-Mail</title>
            </head>
              <body>
                <p>Vielen Dank für Ihre Anfrage. <br>
                Sie bekommen schnellstmöglich eine Antwort</p>
              </body>
            </html>
          ";
 
          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= "From: <' . $formmail . '>" . "\r\n";
 
          mail($formmail, $subject, $message, $headers);
          mail($email, $userSubject, $userMessage, $headers);
 
          echo '
            <div class="container">
              <div class="alert alert-success" role="alert">
               <strong> Anfrage erfolgreich versendet!
              </div>
            </div>
          ';
 
        else :
 
          echo '
            <div class="container">
              <div class="alert alert-danger" role="alert">
                Bitte eine korrekte E-Mail-Adresse eingeben.
              </div>
            </div>
          ';
 
        endif;
       
      else :
 
        echo '
            <div class="container">
              <div class="alert alert-danger" role="alert">
                Haben Sie die Datenschutzerklärung gelesen? Dann bitte bestätigen.
              </div>
            </div>
          ';
 
      endif;
 
    else : 
 
      echo '
            <div class="container">
              <div class="alert alert-danger" role="alert">
                Bitte eine E-Mail-Adresse eingeben.
              </div>
            </div>
          ';
 
    endif;
  endif;
  ?>