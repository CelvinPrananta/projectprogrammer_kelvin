<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lupa Kata Sandi | Monitoring - PPK Ormawa</title>
    <link rel="icon" href="images/faviconbrand.png" type="image/png">
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <div style="text-align:top; padding:0px 0px 0px 0px;"><img alt="favicon" src="images/fav.png" style="float:center;margin:0px 150px -20px 110px;"height="80" width="80"/></img>
                        </div>
                        <h2 class="form-title"><center>Lupa Kata Sandi</center></h2>
                        <?php
                        if(isset($_SESSION['userdata_email']) != ''){
                        header("location:/monitoring/gate/")
                            exit();
                        }

                        $err    = "";
                        $sukses = "";
                        $email  = "";

                        if(isset($_POST['submit'])){
                            $email  = $_POST['email'];
                            if($email == ''){
                                $err = "Silahkan masukkan email";
                            }else{
                                $sql1 = "select * from userdata where email = '$email'";
                                $q1   = mysqli_query($koneksi,$sql1);
                                $n1   = mysqli_num_rows($q1);

                                if($n1 < 1){
                                    $err = "Email: <b>$email</b> tidak ditemukan";
                                }
                            }

                            if(empty($err)){
                                $token_ganti_password   = md5(rand(0,1000));
                                $judul_email            = "Ganti Password";
                                $isi_email              = "Seseorang meminta anda untuk melakukan perubahan password. Silahkan klik link dibawah ini:<br/>";
                                $isi_email              .= url_dasar()."gantikatasandi.php?email=$email&token=$token_ganti_password";
                                kirim_email($email,$email,$judul_email,$isi_email);

                                $sql1     = "update userdata set token_ganti_password = '$token_ganti_password' where email = '$email'";
                                mysqli_query($koneksi,$sql1);
                                $sukses  ="Link ganti password sudah dikirimkan ke email anda.";
                            }
                        }
                        ?>
                        <?php if($err){ echo "<div class='error'>$err</div>";}?>
                        <?php if($sukses){ echo "<div class='sukses'>$sukses</div>";}?>
                        <form action="" method="POST" class="register-form">
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="text" name="email" class="input" required="required" value="<?php echo $email ?>" placeholder="Email"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="submit" class="form-submit" value="PERIKSA"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/favdaftar.png" alt="sing up image"></figure>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>