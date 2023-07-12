<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $log_username = $_POST['log_username'];
        $log_password = $_POST['log_password'];
    
        if(empty($log_username)){
            $error = "pls enter username";
        }elseif(empty($log_password)){
            $error = "pls enter password";
        }else{
            $conn = mysqli_connect('localhost', 'root', '', 'smartfarm');
            $ruser = mysqli_real_escape_string($conn, $log_username);
            $rpass = mysqli_real_escape_string($conn, $log_password);
    
            $log_query = "SELECT * FROM user WHERE username = '$ruser' AND passwordc=MD5('$rpass')";
            $log_result = mysqli_query($conn, $log_query);
            if (mysqli_num_rows($log_result) > 0) {
                session_start();
                $_SESSION['log_username'] = $ruser;
                header(sprintf('location: dashboard.php',$ruser));
            }else{
                
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
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
    <script>
        tailwind.config  = {
  
  content: ["./src/**/*.{html,php,js}"],
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

  plugins: [require("daisyui")],
  daisyui: {
    themes: false
  },
}
    </script>
</head>
<body class="transition-all" style="font-family: 'Anonymous Pro', monospace;" >
        <div class="flex items-center justify-center md:my-48 my-0 ">
            <div class="w-full max-w-2xl px-5 py-8  md:mx-10 mx-10   bg-white  border-2 shadow-2xl border-zinc-200 md:h-96 h-[500px] rounded-xl">
                <div class="max-w-md mx-auto space-y-6">
                    <h1 class="text-4xl text-center ">Iot Smart Farm</h1>
                    <form action="" method="post">
                        <label for="username">Username:</label>
                        <input type="text" id="log_username" name="log_username" class="relative w-full px-3 py-3 text-xs bg-white border-2 rounded border-zinc-200 outline-none placeholder-slate-300 text-slate-600 focus:outline-none focus:ring" required><br>
                        <label for="password1">Password:</label>
                        <input type="password" id="log_password" name="log_password" class="relative w-full px-3 py-3 text-xs bg-white border-2 rounded border-zinc-200 outline-none placeholder-slate-300 text-slate-600 focus:outline-none focus:ring" required><br>
                        <input class="max-[400px]:mx-28 mx-44    my-3   active:bg-gray-300 px-4 py-2 rounded shadow hover:shadow-md hover:bg-gray-300 outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150  " type="submit" value="Sign in"><br>
                        <div class="py-3 ">
                            <span><span>No account </span><a class="underline hover:text-emerald-300" href="register.php">Register here?</a></span>
                        </div> 
    
                    </form>
                </div>
            </div>
        </div>
</body>
</html>