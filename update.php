<!DOCTYPE html>
<html lang="en">
<?php
    require_once "conn.php";

    // Proses pembaruan data ketika form disubmit
    if (isset($_POST['submit'])) {
        // Mengambil ID dari URL
        $id = $_GET['id'];

        // Mengambil dan membersihkan data dari form
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $subject = trim($_POST['subject']);
        $message = trim($_POST['message']);

        // Query update menggunakan prepared statement
        $stmt = $conn->prepare("UPDATE contacts SET name = ?, email = ?, phone = ?, subject = ?, message = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $name, $email, $phone, $subject, $message, $id);

        if ($stmt->execute()) {
            // Redirect ke halaman utama setelah berhasil
            header("Location: index.php");
            exit;
        } else {
            echo "Something went wrong. Please try again.";
        }

        $stmt->close();
    }

    // Fetch data untuk mengisi form berdasarkan ID
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM contacts WHERE id = ?");
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
    <title>Update Contact</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<section>
    <h1 style="text-align: center; margin: 50px 0;">Update Contact</h1>
    <div class="container">
        <form action="update_contact.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
            <div class="mb-3">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="subject">Subject:</label>
                <input type="text" class="form-control" name="subject" value="<?php echo htmlspecialchars($row['subject']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="message">Message:</label>
                <textarea class="form-control" name="message" required><?php echo htmlspecialchars($row['message']); ?></textarea>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
