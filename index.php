<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Al Shifa Hospital</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./JannaLTRegular.css">
</head>
<body>
    <div class="main">
        <div class="logo">
            <img src="images/logo.png">
            <h2>مستشفى الشفاء</h2>
        </div>
        <div class="book">
            <p>اهلا بك في مستشفى الشفاء ,, للحجز املء الإستمارة أدناة</p>
            <form action="index.php" method="post">
                <input type="text" placeholder="أدخل الاسم" name="name" required/>
                <input type="email" placeholder="أدخل البريد الالكتروني" name="email" required/>
                <input type="date" name="date" required/>
                <input type="submit" value="احجز الان" name="send"/>
            </form>

            <?php
            // الاتصال بالسيرفر او قاعدة البيانات
            $host       = "localhost";
            $user       = "root";
            $password   = ""; // Assuming the password is blank on XAMPP
            $dbName     = "hospital";

            // Create connection
            $conn = mysqli_connect($host, $user, $password, $dbName);

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // ارسال المعلومات المُدخله بواسطة المريض الى قاعدة البيانات
            if (isset($_POST['send'])) {
                $pName  = $_POST['name'];
                $pEmail = $_POST['email'];
                $pDate  = $_POST['date'];

                $query = "INSERT INTO patients(name, email, date, status) VALUES('$pName', '$pEmail', '$pDate', 'Pending')";
                if (mysqli_query($conn, $query)) {
                    echo "<p style='color:green'>" . "تم الحجز" . "</p>";
                } else {
                    echo "<p style='color:red'>" . "عفواً حدث خطأ ما .. حاول مجدد " . "</p>";
                }
            }

            // Close connection
            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>
</html>
