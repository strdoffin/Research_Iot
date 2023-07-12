<?php

if($_SERVER['REQUEST_METHOD']=='POST'){

    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if (empty($username)) {
        $error = 'Please enter your username!';
    }elseif (empty($email)){
        $error = 'Please enter your name!';
    }elseif (empty($password1)){
        $error = 'Please enter your password!';
    }elseif (empty($password2)){
        $error = 'Please confirm your password!';
    }else{
        $db = mysqli_connect('localhost', 'root', '', 'smartfarm');

        $emailquery = "SELECT * FROM user WHERE email = '$email'";
        $emailresult = mysqli_query($db, $emailquery);
        $usernamequery = "SELECT * FROM user WHERE username = '$username'";
        $usernameresult = mysqli_query($db, $usernamequery);
        if (mysqli_num_rows($emailresult)>0){
            $error = 'Email already exists';
        }elseif(mysqli_num_rows($usernameresult)){
            $error = 'Username already exists';
        }elseif($password1 != $password2){
            $error = 'Password not same!';
        }else{
            $query = "INSERT INTO user (username,email,passwordc,led_status,water_status,pump_status,auto_farm)VALUE('$username','$email',MD5('$password1'),0,0,0,0)";
            if(mysqli_query($db,$query)){
                header('location:login.php');

            }else{
                $error = 'error creating account';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo.png" type="image/icon type">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anonymous+Pro&display=swap" rel="stylesheet">
    <title>Register</title>
    <script>
        tailwind.config  = {
  
            
  theme: {
    extend: {
      screens: {
        'xl': {'max': '1279px'},
        'lg': {'max': '1023px'},
        'md': {'max': '767px'},
        'sm': {'max': '639px'},},
      fontFamily: {
        'anony': ['Anonymous Pro','monospace']
      },
    },
  },
  
}
    </script>
</head>
<body class="transition-all font-anony">
    <div class="flex items-center justify-center md:my-0 my-48">
        <div class="w-full max-w-2xl px-5 py-8 md:mx-5 mx-10  bg-white border-2 shadow-2xl rounded-xl border-zinc-200">
            <div class="max-w-md mx-auto space-y-6">
                <h1 class="text-4xl text-center ">Iot Smart Farm</h1>
                <form action="" method="post">
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" class="border-2 rounded border-zinc-200 relative w-full px-3 py-3 text-xs bg-white border-0 rounded shadow outline-none placeholder-slate-300 text-slate-600 focus:outline-none focus:ring" required><br>
                    <label for="username">Username:</label><br>
                    <input type="text" id="username" name="username" class="border-2 rounded border-zinc-200 relative w-full px-3 py-3 text-xs bg-white border-0 rounded shadow outline-none placeholder-slate-300 text-slate-600 focus:outline-none focus:ring" required><br>
                    <label for="password1">Password:</label><br>
                    <input type="password" id="password1" name="password1" class="border-2 rounded border-zinc-200 relative w-full px-3 py-3 text-xs bg-white border-0 rounded shadow outline-none placeholder-slate-300 text-slate-600 focus:outline-none focus:ring" required><br>
                    <label for="password2">Confirm Password:</label><br>
                    <input type="password" id="password2" name="password2" class="border-2 rounded border-zinc-200 relative w-full px-3 py-3 text-xs bg-white border-0 rounded shadow outline-none placeholder-slate-300 text-slate-600 focus:outline-none focus:ring" required><br>
                    <input class="max-[400px]:mx-28 mx-44    my-3   active:bg-gray-300 px-4 py-2 rounded shadow hover:shadow-md hover:bg-gray-300 outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150  " type="submit" value="submit"><br>
                    <div class="py-3">
                        <span><span>If you already have an Account please </span><a class="underline hover:text-emerald-300" href="login.php">Login here?</a></span>
                    </div>
                </form><br>
            </div>
           
        </div>
    </div>
</body>
</html>