<html>
    <head>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        jQuery(function(){
            jQuery('#startNewGame').click(function(){
                jQuery.ajax({
                    url: 'startGame.php',
                    type: 'POST',
                    success: function(response){
                        jQuery("#startFeeding").attr("disabled", false);
                        jQuery("#startFeeding").css("display", "inline");
                        jQuery('#message').html("");
                        jQuery('#content').html(response);
                    },
                });
            });
            jQuery('#startFeeding').click(function(){
                var cow = "";
                jQuery.ajax({
                    url: 'feeder.php',
                    type: 'POST',
                    success: function(response){
                        response = response.split("~");
                        if(response[1] == "1" || response[1] == "4") {
                            jQuery("#startFeeding").attr("disabled", true);
                            jQuery('#message').html(response[0]);
                            jQuery('#cell0_'+response[1]).css("color", "red");
                        }
                        if(response.indexOf("~") == -1) {
                            jQuery("#cell"+response).html("FEED");
                        }
                    },
                });
            });
        });        
    </script>
    </head>
    <body>
        <button id="startNewGame">Start New Game</button>
        <button id="startFeeding" style="display: none;">Feed</button>
        <p id="message" style="color: red; font-weight: bold;"></p>
        <div id="content">
        </div>
    </body>
</html>