<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Расписание поездок</title>
</head>
<body>
    <a href="index.php">Страница добавления поездок</a>
    <h1>Расписание поездок курьеров</h1>
    <form id="filterForm">
        <label for="filterDate">Выберите дату:</label>
        <input type="date" name="filterDate" id="filterDate">
        <button type="submit">Фильтровать</button>
    </form>

    <h2>Список поездок</h2>

    <div id="tripsList"></div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#filterForm').submit(function(e) {
                e.preventDefault();
                var filterDate = $('#filterDate').val();

                $.ajax({
                    url: 'get_trips.php',
                    type: 'GET',
                    data: { date: filterDate },
                    success: function(response) {
                        console.log(response);
                        $('#tripsList').empty();
                        if (response.length > 0) {
                            for (let i = 0; i < response.length; i++) {
                                let trip = response[i];
                                console.log(trip);
                                var tripHTML = '<div class="trip">' +
                                    '<h3>' + trip.courier_name + ' - ' + trip.region_name + '</h3>' +
                                    'Дата выезда: ' + trip.start_date +
                                    ' Дата прибытия: ' + trip.end_date +
                                    '</div>';
                                $('#tripsList').append(tripHTML);
                            }
                        } else {
                            $('#tripsList').append('Нет поездок на выбранную дату');
                        }
                    },
                    error: function() {
                        alert('Ошибка при загрузке данных');
                    }
                });
            });
        });
    </script>
</body>
</html>
