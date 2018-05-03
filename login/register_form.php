<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
<!--     <link rel="stylesheet" href="../style/register.css">
    <link rel="stylesheet" href="../style/fontawesome.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        <?php include '../style/register.css'; ?>
        <?php include '../style/fontawesome.css'; ?>
    </style>
</head>
<body>

    <nav class="navbar navbar-expand navbar-dark bg-dark">
      <a class="navbar-brand" href="../barCrawler/index.html" style="color: #366e51; font-weight: bold; font-size: 24px;">BarCrawler</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </nav>

    <div class="container">

        <form action="register_confirmation.php" method="POST">

            <div class="form-group row">
                <label for="username-id" class="col-sm-3 col-form-label text-sm-right">Username: <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="username-id" name="username">
                    <small id="username-error" class="invalid-feedback">Username is required.</small>
                </div>
            </div> <!-- .form-group -->

            <div class="form-group row">
                <label for="email-id" class="col-sm-3 col-form-label text-sm-right">Email: <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" id="email-id" name="email">
                    <small id="email-error" class="invalid-feedback">Email is required.</small>
                </div>
            </div> <!-- .form-group -->

            <div class="form-group row">
                <label for="password-id" class="col-sm-3 col-form-label text-sm-right">Password: <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="password-id" name="password">
                    <small id="password-error" class="invalid-feedback">Password is required.</small>
                </div>
            </div> <!-- .form-group -->

            <div class="row">
                <div class="ml-auto col-sm-9">
                    <span class="text-danger font-italic">* Required</span>
                </div>
            </div> <!-- .form-group -->

            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9 mt-3">
                    <button type="submit" class="btn btn-primary" style="background-color: #366e51;">Register</button>
                    <a href="../barCrawler/index.html" role="button" class="btn btn-light">Cancel</a>
                </div>
            </div> <!-- .form-group -->

            <div class="row">
                <div class="col-sm-9 ml-sm-auto">
                    <a href="login.php" style="color: #366e51;">Already have an account</a>
                </div>
            </div> <!-- .row -->

        </form>
    </div> <!-- .container -->
    <script>
        document.querySelector('form').onsubmit = function(){
            if ( document.querySelector('#username-id').value.trim().length == 0 ) {
                document.querySelector('#username-id').classList.add('is-invalid');
            } else {
                document.querySelector('#username-id').classList.remove('is-invalid');
            }

            if ( document.querySelector('#email-id').value.trim().length == 0 ) {
                document.querySelector('#email-id').classList.add('is-invalid');
            } else {
                document.querySelector('#email-id').classList.remove('is-invalid');
            }

            if ( document.querySelector('#password-id').value.trim().length == 0 ) {
                document.querySelector('#password-id').classList.add('is-invalid');
            } else {
                document.querySelector('#password-id').classList.remove('is-invalid');
            }

            return ( !document.querySelectorAll('.is-invalid').length > 0 );
        }
    </script>
</body>
</html>