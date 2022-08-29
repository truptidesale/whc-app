<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="Trupti D">
    <title>WHC App</title>
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/custom.css" rel="stylesheet">
  </head>
<body>
<div class="container py-3">
  <header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        <span class="fs-4">WHC App</span>
      </a>
    </div>
  </header>

  <main>
    <div class="whc-header p-3 pb-md-4 mx-auto text-center">
      <h4 class="display-4 fw-normal">Developer Test</h4>
      <h6>Pease use below examples for reference:</h6>
      <div class="info-div">
        <p>1) <span class="cmd">add</span> <span class="arg">1 2 3</span></p>
        <p>2) <span class="cmd">sort</span> <span class="arg">6 2 8</span></p>
        <p>3) <span class="cmd">repo-desc</span> <span class="arg">git-username git-repo-name</span></p>
      </div>
    </div>

    <div class="row mb-3 text-center">
      <div class="col-6 themed-grid-col">
        <form id="formData">
          <div class="mb-3 mt-3">
            <label for="input" class="form-label">Enter your input</label>
            <input type="text" class="form-control" id="input" name="input">
          </div>

          <div class="mb-3 mt-3" id="display-error">
            <p id="message-1"></p>
            <p id="message-2"></p>
            <p id="message-3"></p>
          </div>
          
          <div class="bd-example">
            <button type="submit" id="submit" class="btn btn-primary btn-sm">Submit</button>
            <button type="button" id="reset" class="btn btn-success btn-sm">Reset</button>
          </div>
        </form>
      </div>
      <div class="col-6 themed-grid-col">
        <h5>Results</h5>
        <div id="display-result">
            <p></p>
        </div>
      </div>
    </div>
  </main>

  <footer class="pt-4 my-md-5 pt-md-5 border-top"></footer>
</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function () {
        // Submit form using ajax method
        $("#submit").click(function(e){

          // Empty result and error div upon submit button click.
          $("#display-result p").empty();
          $("#message-1").empty();
          $("#message-2").empty();
          $("#message-3").empty();

          if ($("#formData")[0].checkValidity()) {
            e.preventDefault();

            let formData = {
              input: $("#input").val(),
            };

            $.ajax({
              type: "POST",
              url: "action.php",
              data: formData,
              dataType: "json",
              encode: true,
              success:function(response){
                if (!response.success) {
                  $("#message-1").html(response.errors.message_1);
                  $("#message-2").html(response.errors.message_2);
                  $("#message-3").html(response.errors.message_3);
                }
                
                $("#display-result p").html(response.result);
              }
            });
          }
        });

        // Form reset
        $("#reset").click(function(e){
            e.preventDefault();
            $("#input").val("");
            $("#message-1").empty();
            $("#message-2").empty();
            $("#message-3").empty();
            $("#display-result p").empty();
        });
    });
  </script>
</body>
</html>
