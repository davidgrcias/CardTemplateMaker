<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Card Template Maker</title>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js">
    </script>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    Image <input type="file" id="image" value = "">
    Background Color <input type="text" id = "background" value="#734C99">
    Text Color <input type="text" id = "text" value="#fff">
    Border Color <input type="text" id = "border" value="#000"> <br>
    From <input type="text" id = "from" value="From">
    Message <input type="text" id = "message" value="Message">
    To <input type="text" id = "to" value="To">

    <hr>

    <div class="card">
      <div class="img">
        <img src="" id = "" style = "width: 100%; height: 100%;">
      </div>
      <div class="container">
        <h2 class = "left" id = "h2from"></h2>
        <p class = "center" id = "pmessage"></p>
        <h2 class = "right" id = "h2to"></h2>
      </div>
    </div>
    <button type="button" name="button"><a href="#" id = "download">Download</a></button>

    <script type="text/javascript">
      // Upload image to the directory
      var imagesrc = "img/example.png";
      $(document).ready(function() {
          $('#image').change(function(){
              var formData = new FormData();
              var files = $('#image')[0].files;
              formData.append('image', files[0]);
              $.ajax({
                  url: "upload.php",
                  type: "POST",
                  data: formData,
                  contentType: false,
                  processData: false,
                  success: function(response){
                    imagesrc = response;
                  }
              });
          });
      });

      // Real time preview card
      setInterval(function(){
        preview();
      }, 0);

      function preview(){
        var background = $('#background').val();
        var text = $('#text').val();
        var border = $('#border').val();
        var from = $('#from').val();
        var pmessage = $('#message').val();
        var to = $('#to').val();
        $("img").attr("src", imagesrc);
        $('.card').css("background", background);
        $('.card').css("color", text);
        $('.card').css("border-color", border);
        $('#h2from').text(from);
        $('#pmessage').text(pmessage);
        $('#h2to').text(to);
      }

      // Download card
      var element = $(".card");
      $("#download").on('click', function(){
        html2canvas(element, {
          onrendered: function(canvas) {
            var imageData = canvas.toDataURL("image/png");
            var newData = imageData.replace(/^data:image\/png/, "data:application/octet-stream");
            $("#download").attr("download", "image.png").attr("href", newData);
          }
        });
      });
    </script>
  </body>
</html>
