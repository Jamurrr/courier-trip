<?php
include_once 'db.php';
    $regions = $mysqli->query("SELECT id, name FROM regions");
    $couriers = $mysqli->query("SELECT id, name FROM couriers");
    $mysqli->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить поездку</title>
</head>
<body>
    <a href="index2.php">Страница просмотра поездок</a>
    <h1>Добавление поездки</h1>
    <form id="trip-form">
        <label for="courier">Курьер:</label>
        <select id="courier" name="courier_id" required>
            <?php
                while ($courier = $couriers->fetch_assoc()) {
                    echo "<option value='{$courier['id']}'>{$courier['name']}</option>";
                }
            ?>
        </select><br><br>

        <label for="region">Регион:</label>
        <select id="region" name="region_id" required>
            <?php
                while ($region = $regions->fetch_assoc()) {
                    echo "<option value='{$region['id']}'>{$region['name']}</option>";
                }
            ?>
        </select><br><br>

        <label for="start_date">Дата выезда:</label>
        <input type="date" id="start_date" name="start_date" required><br><br>

        <button type="submit">Добавить поездку</button>
    </form>

    <div id="result"></div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#trip-form').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: 'add_trip.php', 
                    type: 'POST',
                    data: $(this).serialize(), 
                    success: function(response) {
                        $('#result').text(response);
                    },
                    error: function() {
                        $('#result').text('Произошла ошибка при добавлении поездки.');
                    }
                });
            });
        });
    </script>
</body>
</html>
