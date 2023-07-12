<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smartfarm";
extract($_POST);
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connect failed");
}
session_start();
$ruser = $_SESSION['log_username'];




if (isset($_POST['update_led1'])) {
    $fetch = mysqli_query($conn, "SELECT * FROM user WHERE id='1'");
    $row = mysqli_fetch_row($fetch);
    if ($row[4] === "0") {
        $query = "UPDATE user SET led_status = 1 WHERE id=1";
        $run = mysqli_query($conn, $query);

    }
    if ($row[4] === "1") {
        $query = "UPDATE user SET led_status = 0  WHERE id=1";
        $run = mysqli_query($conn, $query);
    }




}
if (isset($_POST['update_led2'])) {
    $fetch = mysqli_query($conn, "SELECT * FROM user WHERE id=1");
    $row = mysqli_fetch_row($fetch);
    if ($row[5] === "0") {
        $query = "UPDATE user SET water_status = 1 WHERE id=1";
        $run = mysqli_query($conn, $query);
    }
    if ($row[5] === "1") {
        $query = "UPDATE user SET water_status = 0  WHERE id=1";
        $run = mysqli_query($conn, $query);
    }
    
}
if (isset($_POST['update_led3'])) {
    $fetch = mysqli_query($conn, "SELECT * FROM user WHERE id=1");
    $row = mysqli_fetch_row($fetch);
    if ($row[6] === "0") {
        $query = "UPDATE user SET auto_farm = 1 WHERE id=1";
        $run = mysqli_query($conn, $query);
    }
    if ($row[6] === "1") {
        $query = "UPDATE user SET auto_farm = 0  WHERE id=1";
        $run = mysqli_query($conn, $query);
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 4px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" href="logo.png" type="image/icon type">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/f6dc56b1c3.js" crossorigin="anonymous"></script>
    <script>
        tailwind.config = {
            theme: {
                screens: {
                    'xl': { 'max': '1279px' },
                    'lg': { 'max': '1023px' },
                    'md': { 'max': '767px' },
                    'sm': { 'max': '639px' },
                },
                extend: {
                    colors: { clifford: '#da373d', },
                    fontFamily: { 'anony': ['Anonymous Pro', 'monospace'] },
                }
            }
        }
    </script>
</head>

<body class="transition-all  bg-slate-50" style="font-family: 'Anonymous Pro', monospace;">
    <nav class="sticky top-0 z-10 p-3 shadow-lg bg-zinc-100 rounded-xl shadow-black-500/40">
        <div class="flex items-center justify-between">
            <div>
                <a href="dashboard.php"><span class="mx-3 text-4xl font-bold font-anony">ISF</span><span
                        class="ml-3 md:hidden">iot smart farm</span></a>
            </div>
            <ul class="flex items-center gap-10 mx-4 text-lg md:mx-2 md:gap-5">
                <li>
                    <span class="cursor-pointer hover:text-zinc-600">
                        <?php echo $ruser ?>
                    </span>
                </li>

                <li>
                    <span class="cursor-pointer hover:text-zinc-600"><a href="login.php">Logout</a></span>
                </li>
            </ul>
        </div>
    </nav>
    <div class="flex justify-center p-5 xl:grid xl:grid-cols-2 lg:float-none">
        <div class="mr-2">
            <div class="flex  max-w-[500px] justify-center  ">
                <div
                    class="md:h-[200px] h-[250px] md:w-80 w-[500px] bg-base-100 shadow-xl border-zinc-200 border-2 shadow-green-200 hover:shadow-green-400 transition-all delay-75 rounded-2xl p-5 ">
                    <h1 class="text-2xl xl:text-xl">Dirt Moise</h1>
                    <div class="text-center p-5">
                        <i class="fa-solid fa-droplet-slash md:text-[50px] text-[100px]"></i>
                        <i class="fa-sharp fa-solid fa-droplet md:text-[50px] text-[100px]"></i>
                        <i class="fa-solid fa-hand-holding-droplet md:text-[50px] text-[100px]"></i>

                        <h2 class="text-[25px] mt-5">
                            <?php

                            $ruser = $_SESSION['log_username'];

                            $qtemp = "SELECT id,temp,moise_dirt,time_stamp FROM temp WHERE user = '$ruser' order by id DESC LIMIT 1";
                            $fetchtemp = $conn->query($qtemp);
                            if ($fetchtemp->num_rows > 0) {
                                // output data of each row
                                while ($temprow = $fetchtemp->fetch_assoc()) {
                                    echo $temprow['moise_dirt'];
                                }
                            } else {
                                echo "No stat appeared";
                            } ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="flex  max-w-[500px] justify-center ">
                <div
                    class="md:h-[200px] h-[250px] md:w-80 w-[500px] bg-base-100 shadow-xl rounded-2xl p-5 shadow-violet-200 hover:shadow-violet-400 border-2 border-zinc-200 transition-all delay-75 mt-2 ">
                    <h1 class="text-2xl xl:text-xl">Temperature</h1>
                    <div class="text-center p-5">
                        <i class="fa-solid fa-temperature-arrow-up md:text-[50px] text-[100px]"></i>
                        <i class="fa-solid fa-temperature-low md:text-[50px] text-[100px]"></i>
                        <i class="fa-solid fa-temperature-arrow-down md:text-[50px] text-[100px]"></i>

                        <h2 class=" text-[25px] mt-5">
                            <?php

                            $ruser = $_SESSION['log_username'];

                            $qtemp = "SELECT id,temp,moise_dirt,time_stamp FROM temp WHERE user = '$ruser' order by id DESC LIMIT 1";
                            $fetchtemp = $conn->query($qtemp);
                            if ($fetchtemp->num_rows > 0) {
                                // output data of each row
                                while ($temprow = $fetchtemp->fetch_assoc()) {
                                    echo $temprow['temp']."<span class='text-[20px]'>°C</span>";
                                }
                            } else {
                                echo "No stat appeared";
                            } ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center">
            <div
                class=" w-[500px] md:h-[410px] h-[510px] bg-base-100 shadow-xl shadow-cyan-200 hover:shadow-cyan-400 transition-all border-2  border-zinc-200 rounded-2xl  p-5  ">
                <h1 class="text-2xl">Control</h1>
                <div class="text-center card-body">
                    <h2 class="card-title"></h2>
                    <div class="flex justify-center">
                        <div class="justify-end card-actions">
                            <form action="dashboard.php" method="POST" id="btn-sent">
                                <button name="update_led1" id="button1"
                                    class="bg-green-300 hover:bg-yellow-400 md:block text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">led1</button>
                                <h1>Status :
                                    <?php $fetch = mysqli_query($conn, "SELECT * FROM user WHERE id='1'");
                                    $row1 = mysqli_fetch_row($fetch);
                                    if ($row1[4] == "0") {
                                        echo "on";
                                    } else if ($row1[4] == "1") {
                                        echo "off";
                                    } ?>
                                </h1>
                                <button name="update_led2" id="button2"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">led2</button>
                                <h1>Status :
                                    <?php $fetch = mysqli_query($conn, "SELECT * FROM user WHERE id='1'");
                                    $row2 = mysqli_fetch_row($fetch);
                                    if ($row2[5] == "0") {
                                        echo "on";
                                    } else if ($row2[5] == "1") {
                                        echo "off";
                                    } ?>
                                </h1>
                                <button name="update_led3" id="button3"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">led3</button>
                                <h1>Status :
                                    <?php $fetch = mysqli_query($conn, "SELECT * FROM user WHERE id='1'");
                                    $row3 = mysqli_fetch_row($fetch);
                                    if ($row3[6] == "0") {
                                        echo "on";
                                    } else if ($row2[6] == "1") {
                                        echo "off";
                                    } ?>
                                </h1>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="flex justify-center m-5">
        <div
            class="w-[1000px] xl:w-[100vw] md:h-[600px] h-[300px]bg-base-100 shadow-xl shadow-red-200 hover:shadow-red-400 transition-all rounded-2xl border-zinc-200 border-2 p-5 ">
            <h1 class="text-2xl text-center">History Stat</h1>
            <div class="flex justify-center md:h-[200px] h-[250px]">
                <div class="flex justify-center w-full h-full md:w-80 p-2 ">
                    <?php
                    $qtemp = "SELECT id, temp, moise_dirt, time_stamp FROM temp WHERE user = '$ruser' ORDER BY id DESC LIMIT 5";
                    $fetchtemp = $conn->query($qtemp);

                    if ($fetchtemp->num_rows > 0) {
                        echo '<table>';
                        echo '<tr><th>ID</th><th>Temperature</th><th>Dirt Moisture</th><th>Time Stamp</th></tr>';

                        while ($temprow = $fetchtemp->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $temprow['id'] . '</td>';
                            echo '<td>' . $temprow['temp'] . '</td>';
                            echo '<td>' . $temprow['moise_dirt'] . '</td>';
                            echo '<td>' . $temprow['time_stamp'] . '</td>';
                            echo '</tr>';
                        }

                        echo '</table>';
                    } else {
                        // Handle case when no data is found
                        echo "No Stat Appeared";
                    }
                    ?>

                </div>
            </div>
            <div class="text-center card-body">
                <h2 class="card-title"></h2>

                <div class="flex justify-center">
                    <div class="justify-end card-actions">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="">
        <nav class="p-3 shadow-lg rounded-xl shadow-black-500/40">
            <div class="flex items-center justify-center">
                <div>
                    <span>Copyright ©iot smart farm</span>
                </div>

            </div>
        </nav>
    </footer>
</body>



</html>
