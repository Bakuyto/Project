<div class="container-fluid fixed-bottom bg-white px-5" style="height: 60px; display: flex; justify-content: space-between; align-items: center;">
    <div style="display: flex; align-items: center;">
            <?php
            include '../connection/connect.php';

            $sql = "SELECT department_name, product_status FROM tbldepartment";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $labelClass = '';
                    if ($row["product_status"] == 1) {
                        // Add a class for success background color
                        $labelClass = 'bg-success text-light'; // You can define these classes in your CSS
                    } elseif ($row["product_status"] == 0) {
                        // Add classes for white background and dark text color
                        $labelClass = 'bg-danger text-light'; // You can define these classes in your CSS
                    }
                    echo '<label class="me-1 ' . $labelClass .  ' p-1">' . $row["department_name"] . '</label>';
                }
            } else {
                echo "0 results";
            }

            $conn->close();
            ?>
    </div>
    <div style="display: flex; align-items: center;">
        <div class="page-of mt-1 me-1">Page <span id="current-page">1</span> of <span id="total-pages">1</span></div>
        <button class="btn me-1 text-white" id="prev-btn" style="background-color: #28ACE8; height: 40px;">Prev</button>
        <input class="me-1 rounded text-center" type="number" placeholder="1" id="page-number" disabled style="width: 50px; height: 40px;">
        <button class="btn text-white" id="next-btn" style="background-color: #28ACE8; height: 40px;">Next</button>
    </div>
</div>
