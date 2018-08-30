<?php
spl_autoload_register(function($class){
    include_once("classes/" .  $class . ".class.php");
});

session_start();
if (empty($_SESSION['usernaam'])) { header('Location: login.php'); }

$messages_obj = new Bericht();
$users_obj = new AppUser();
$users_obj->setId($_SESSION['user_id']);

$friends = $users_obj->getUsersByUser();

// var_dump($friends)

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mål</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/styletwee.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
  <div class="message_modal">
    <div class="modal_inner">
      <div class="modal_header"></div>
      <div class="modal_content"></div>
      <div class="modal_footer">
        <form method="post" action="#">
          <input type="text" class="message_input"  placeholder="Typ je bericht hier" />
          <button type="button" id="send_message">Versturen</button>
      </div>
    </div>
  </div>
  <div class="row">
    <div class=navigation>
      <nav class="navbar-fixed-left">
        <ul class="nav navbar-nav">
          <li>
            <h2 id="cuser"><?php echo $_SESSION["voornaam"],' ',$_SESSION["achternaam"]?></h2>
          </li>
          <li><a href="dashboard.php">Dashboard</a></li>
          <li><a href="patienten.php">Patiënten</a></li>
          <li><a href="modules.php">Modules</a></li>
          <li><a href="berichten.php">Berichten</a></li>
          <li><a href="extramodules.php" id="extra">Extra modules</a></li>
          <li><a href="mijnaccount.php">Profiel</a>
          <li>
          <li><a href="logout.php">Uitloggen</a>
          <li>
        </ul>
      </nav>
    </div>
    <div class="offset-3 col-md-7 berichten_container" data-id=<?php echo $_SESSION['user_id']; ?>>
      <h2>Berichten</h2>
      <div class="inner_container">
        <?php foreach ($friends as $friend): ?>
        <?php $newMessage = Bericht::checkForNewMessages($friend->id, $_SESSION['user_id'])?>
          <div class="friend_container">
            <a href="#" id="friend_<?php echo $friend->id?>" data-id="<?php echo $friend->id?>" class="conversation_container">
              <img src="<?php echo $friend->profielfoto; ?>">
              <p class="message_header"><?php echo $friend->voornaam.' '.$friend->achternaam; ?></p>
              <?php if ($newMessage > 0):?>
                <p class="message_preview new_message">Je hebt nieuwe berichten<p>
              <?php else: ?>
                <p class="message_preview">Geen nieuwe berichten<p>
              <?php endif;?>
             </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</body>
<script>
  $(document).ready(function(){

    $('a.conversation_container').on('click', function(e){

      let user_id = $('.berichten_container').data('id');
      let partner_id = $(this).data('id')
      let partner_name = $(this).children('.message_header').text()

      console.log(partner_name)

      $.ajax({
        method: 'POST',
        url: 'AJAX/getMessageHistory.php',
        data: {
          user_id: user_id,
          partner_id: partner_id
        }
      }).done(function(response){
        $('.message_modal').css('display', 'flex');
        $('.modal_header').append('<p class="partner_name">'+partner_name+'</p>')
        $('.modal_header').attr('data-id', partner_id)

        if (response.length > 0){
          response.map(message => {
            let position = message.verzender_id == user_id ? 'right' : 'left'
            let div = '<div class="message_container" data-position="'+position+'"><p class="message" data-sender-id="'+message.verzender_id+'">'+message.bericht+'</p></div>'
            $('.modal_content').append(div)
          })
          $('.modal_content').scrollTop($('.modal_content').get(0).scrollHeight)
        } else {
          $('.modal_content').html('<p style="color:#AAA; font-style: italic">Je hebt nog geen chat geschiedenis.</p>')
        }
      }).then(
        $.ajax({
          method: 'POST',
          url: 'AJAX/setLastMessageAsRead.php',
          data: {
            user_id: user_id,
            partner_id: partner_id
          }
        }).done(function(response){
          console.log(response)
        })
      )
    });

    $('#send_message').on('click', function(e){
      sendMessage()
    })

    $(window).keydown(function(e){
      if (e.keyCode == 13){
        e.preventDefault();

        sendMessage()
      } else if (e.keyCode == 27){
        closeModal()
      }
    });

    function escapeHtml(text) {
      var map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
      };

      return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }

    sendMessage = () => {
      let text = $('.message_input').val();
      let receiver_id = $('.modal_header').data('id')
      let user_id = $('.berichten_container').data('id');

      $.ajax({
        method: 'POST',
        url: 'AJAX/sendMessage.php',
        data:{
          text: text,
          receiver_id: receiver_id,
          sender_id: user_id
        }
      }).done(function(response){
        if (response) {
          let div = '<div class="message_container" data-position="right"><p class="message" data-sender-id="'+user_id+'">'+escapeHtml(text)+'</p></div>'
          $('.modal_content').append(div)
          $('.message_input').val('')
        }
        $('.modal_content').scrollTop($('.modal_content').get(0).scrollHeight)

      })
    }

    closeModal = () => {
      $('.modal_header').html('');
      $('.modal_content').html('');

      $('.message_modal').hide();
    }
  })
</script>
</html>
