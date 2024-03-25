<?php
if(isset($_POST['downloadBtn'])){
    $imgURL = $_POST['file']; 
    $regPattern = '/\.(jpe?g|png|gif|bmp)$/i';
    if(preg_match($regPattern, $imgURL)){ 
        $initCURL = curl_init($imgURL);
        curl_setopt($initCURL, CURLOPT_RETURNTRANSFER, true);
        $downloadImgLink = curl_exec($initCURL);
        curl_close($initCURL);
        header('Content-type: image/jpg');
        header('Content-Disposition: attachment;filename="image.jpg"');
        echo $downloadImgLink;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Download JPEG files!</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Download JPEG files for free</a>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>

</nav>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="title-description mt-5 mb-3">
                    <h2>Welcome!</h2>
                    <p>This is my second project of PHP. I will try to finish many others by the end of March.<br>
                        As in the Python projects, I will aim to offer solutions for everyday<br>tasks, problems, or practical applications.</p>
                </div>
                <div class="preview-box border p-3">
                    <div class="cancel-icon"><i class="fas fa-times"></i></div>
                    <div class="img-preview"></div>
                    <div class="content">
                        <div class="img-icon"><i class="far fa-image"></i></div>
                        <div class="text">Paste the image URL below, <br>to see a preview or download!</div>
                    </div>
                </div>
                <form action="index.php" method="POST" class="input-data mt-3">
                    <div class="input-group">
                        <input id="field" type="text" name="file" class="form-control" placeholder="Paste the image URL to download..." autocomplete="off">
                        <div class="input-group-append">
                            <button id="button" name="downloadBtn" class="btn btn-primary" type="submit">Download</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){

            $("#field").on("focusout", function(){
         
                var imgURL = $("#field").val();
                if(imgURL != ""){ 
                    var regPattern = /\.(jpe?g|png|gif|bmp)$/i; 
                    if(regPattern.test(imgURL)){ 
                        var imgTag = '<img src="'+ imgURL +'" alt="">'; 
                        $(".img-preview").append(imgTag);
                        $(".preview-box").addClass("imgActive");
                        $("#button").addClass("active");
                        $("#field").addClass("disabled");
                        $(".cancel-icon").on("click", function(){
                            $(".preview-box").removeClass("imgActive");
                            $("#button").removeClass("active");
                            $("#field").removeClass("disabled");
                            $(".img-preview img").remove();
                        });
                    }else{
                        alert("Invalid img URL - " + imgURL);
                        $("#field").val('');
                    }
                }
            });
        });
    </script>
</body>
</html>
