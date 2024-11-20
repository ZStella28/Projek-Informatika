<!DOCTYPE html>
<html lang="en">
<?php
    require_once "conn.php";

    if (isset($_POST['submit'])) {
        // Get data from form
        $id = $_GET['id']; // ID from URL
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $people_count = trim($_POST['people_count']);
        $appointment_date = trim($_POST['appointment_date']);
        $appointment_time = trim($_POST['appointment_time']);
        $message = trim($_POST['message']);

        // Update query using prepared statements
        $stmt = $conn->prepare("UPDATE reservasi SET name = ?, email = ?, phone = ?, people_count = ?, appointment_date = ?, appointment_time = ?, message = ? WHERE id = ?");
        $stmt->bind_param("sssisssi", $name, $email, $phone, $people_count, $appointment_date, $appointment_time, $message, $id);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            echo "Something went wrong. Please try again later.";
        }

        $stmt->close();
    }

    // Fetch existing data
    $id = $_GET['id'];
    $sql_query = "SELECT * FROM reservasi WHERE id = ?";
    $stmt = $conn->prepare($sql_query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "Record not found.";
        exit;
    }

    $stmt->close();
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty Salon Reservation</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-9ndCyUa3Y6k73lg+EVYlNqTZZZ1z8whjAN1l5+5eF3evo2uyQqV4q5p5jp9DIhFi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-pprn3073KE6tl6/2lgI1wItU1zWfAfg5TFEJeFaGc5j5UlKkq5wiUS5F5Y3y3e69x" 
    crossorigin="anonymous"></script>
</head>

<body>
<section>
    <h1 style="text-align: center; margin: 50px 0;">Update Data</h1>
    <div class="container">
        <form action="updatedata.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
            <div class="mb-3">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="phone">No.HP:</label>
                <input type="number" class="form-control" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="people_count">Jumlah Orang:</label>
                <input type="number" class="form-control" name="people_count" value="<?php echo htmlspecialchars($row['people_count']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="appointment_date">Tanggal:</label>
                <input type="date" class="form-control" name="appointment_date" value="<?php echo htmlspecialchars($row['appointment_date']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="appointment_time">Waktu:</label>
                <input type="time" class="form-control" name="appointment_time" value="<?php echo htmlspecialchars($row['appointment_time']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="message">Pesan:</label>
                <textarea class="form-control" name="message" required><?php echo htmlspecialchars($row['message']); ?></textarea>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</section>
</body>
</html>
