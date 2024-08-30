<?php
    include "header.php";
?>

<table>
    <th>الرقم</th>
    <th>إسم المريض</th>
    <th>البريد الإلكتروني</th>
    <th>التاريخ</th>
    <th>الحالة</th>
    <th>تغيير الحالة</th>

<?php
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

    // إستيراد معلومات المرضى من قاعدة البيانات
    $query = "SELECT * FROM patients";
    $result = mysqli_query($conn, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['date'] . "</td>
                    <td>" . $row['status'] . "</td>
                    <td>
                        <form action='admin.php' method='post'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'/>
                            <select name='status'>
                                <option value='Pending'" . ($row['status'] == 'Pending' ? ' selected' : '') . ">Pending</option>
                                <option value='Confirmed'" . ($row['status'] == 'Confirmed' ? ' selected' : '') . ">Confirmed</option>
                            </select>
                            <input type='submit' name='update' value='Update'/>
                        </form>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "يوجد خطأ ما";
    }

    // تحديث حالة المريض
    if (isset($_POST['update'])) {
        $id     = $_POST['id'];
        $status = $_POST['status'];

        $updateQuery = "UPDATE patients SET status='$status' WHERE id='$id'";
        if (mysqli_query($conn, $updateQuery)) {
            echo "<p style='color:green'>تم تحديث الحالة بنجاح</p>";
        } else {
            echo "<p style='color:red'>عفواً حدث خطأ ما .. حاول مجدد</p>";
        }
        // Refresh the page to show updated data
        header("Location: admin.php");
    }

    // Close connection
    mysqli_close($conn);
?>
