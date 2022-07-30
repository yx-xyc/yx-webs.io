<!doctype html>
<html>
  <head>
    <title>Let's Chat</title>

    <!-- bring in the jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- custom styles -->
    <style>
      #chat_log {
        display: block;
        width: 100%;
        height: 300px;
      }
      /* #chat_log:hover{
        background-color: yellow;
      } */
      .hidden {
        display: none;
      }
      #error{
        background-color: red;
        color: white;
        padding: 0.5em;
      }
      #container{
        width: 50%;
        margin: auto;

      }
    </style>
  </head>
  <body>
    <div id="container">
      <h1>Let's Chat</h1>
      <div id="error" class="hidden"></div>
      <br>
      <div id="panel_name" class="hidden">
        Name: <input type="text" id="username">
        <br>
        Room: <select id="room">
          <option value="1">Room1</option>
          <option value="2">Room2</option>
          <option value="3">Room3</option>
          <option value="4">Room4</option>
          <option value="5">Room5</option>
        </select>
        <button id="button_save">Let's Chat!</button>
      </div>

      <div id="panel_rename" class="hidden">
        Change Name: <input type="text" id="rename">
        <br>
        Change Room: <select id="reroom">
          <option value="1">Room1</option>
          <option value="2">Room2</option>
          <option value="3">Room3</option>
          <option value="4">Room4</option>
          <option value="5">Room5</option>
        </select>
        <button id="button_change" type="button">Change</button>
      </div>

      <br>
      <strong id="current_room" class="hidden"></strong>
      <div id="panel_chat" class="hidden">
        <textarea readonly id="chat_log"></textarea>
        <input type="text" id="message">
        <button id="button_send">Send Message</button>
      </div>
    </div>

    <script>
      let selectedName;
      let selectedRoom;
      let org_message_num = 0;
      let new_message_num;
      $(document).ready(function() {
        // DOM refs
        let panel_name = document.getElementById('panel_name');
        let username = document.getElementById('username');
        let button_save = document.getElementById('button_save');
        let panel_chat = document.getElementById('panel_chat');
        let chat_log = document.getElementById('chat_log');
        let message = document.getElementById('message');
        let button_send = document.getElementById('button_send');
        let error = document.getElementById('error');
        let panel_rename = document.getElementById('panel_rename');
        let rename = document.getElementById('rename');
        let current_room = document.getElementById('current_room');

        if (window.localStorage.getItem('username')&&(window.localStorage.getItem('room_id'))){
          panel_rename.classList.remove('hidden');
          panel_chat.classList.remove('hidden');
          selectedName = window.localStorage.getItem('username');
          selectedRoom = window.localStorage.getItem('room_id');
          current_room.innerHTML = `Current Room: ${selectedRoom} <br> Your name: ${selectedName}`;
          current_room.classList.remove('hidden');
          getData();
        } else {
          panel_name.classList.remove('hidden');
        }

        button_save.addEventListener('click', function() {
          // validate the user's name using an AJAX call to the server
          $.ajax({
            url: 'validate_name.php',
            type: 'post',
            data: {
              name: username.value
            },
            success: function(data, status) {
              // console.log(data);
              // console.log(status);
              if (data == 'valid') {
                selectedName = username.value;
                selectedRoom = room.value;
                panel_name.classList.add('hidden');
                panel_chat.classList.remove('hidden');
                panel_rename.classList.remove('hidden');
                window.localStorage.setItem('username', username.value);
                window.localStorage.setItem('room_id', room.value);
                current_room.innerHTML = `Current Room: ${selectedRoom} <br> Your name: ${selectedName}`;
                current_room.classList.remove('hidden');
                error.classList.add('hidden');
                getData();
              } else if (data == 'invalid'){
                error.innerHTML = "In valid username!";
                error.classList.remove('hidden');
              }
            }
          });
          // if valid, hide the panel_name panel and show the
          // panel_chat panel
          // getData();
        })


        button_change.addEventListener('click', function(event) {
          $.ajax({
            url: 'validate_name.php',
            type: 'post',
            data: {
              name: rename.value
            },
            success: function(data, status){
              // console.log(data);
              // console.log(status);
              if (data == 'valid'){
                window.localStorage.setItem('username', rename.value);
                window.localStorage.setItem('room_id', reroom.value);
                selectedName = rename.value;
                selectedRoom = reroom.value;
                current_room.innerHTML = `Current Room: ${selectedRoom} <br> Your name: ${selectedName}`;
                current_room.classList.remove('hidden');
                error.classList.add('hidden');
              } else if (data == 'invalid'){
                error.innerHTML = "In valid username!";
                error.classList.remove('hidden');
              }
            }
          });
          // getData();
        })

        button_send.addEventListener('click', function() {
          // console.log(selectedName);
          // make an ajax call to the server to save the message
          $.ajax({
            url: 'save_message.php',
            type: 'post',
            data: {
              name: selectedName,
              room: selectedRoom,
              message: message.value
            },
            success: function(data, status) {
              console.log(data);
              // console.log(status);
              if (data=="saved"){
                chat_log.value += selectedName + ': ' + message.value + "\n";
                message.value = "";
                error.classList.add('hidden');
              } else if (data=="fail"){
                error.innerHTML = "Cannot send empty message!";
                error.classList.remove('hidden');
              } else if (data=="banned_word"){
                error.innerHTML = "You message contains banned word!";
                error.classList.remove('hidden');
              }
              // console.log($('chat_log:hover'));
              if (!chat_log.matches(':hover')){
                  chat_log.scrollTop = chat_log.scrollHeight;
                }
            }
          });
          // when it's successful we should add the message to
          // the chat log so we can see it
        });

        function getData() {
          $.ajax({
            url: 'get_messages.php',
            type: 'post',
            data: {
              room: selectedRoom
            },
            success: function(data, status) {
              // console.log(data);
              // console.log(status);
              let parsed = JSON.parse(data);
              let newChatroom = '';
              new_message_num = parsed.length;
              // console.log(org_message_num);
              // console.log(new_message_num);
              if (org_message_num < new_message_num){
                if (!chat_log.matches(':hover')){
                  chat_log.scrollTop = chat_log.scrollHeight;
                }
                org_message_num += new_message_num;
              }
              for (let i = 0; i < parsed.length; i++) {
                newChatroom += parsed[i].name + ': ' + parsed[i].message + "\n";
              }
              chat_log.value = newChatroom;
              setTimeout( getData, 3000 );
            }
          })
        }
      });
    </script>
  </body>
</html>
