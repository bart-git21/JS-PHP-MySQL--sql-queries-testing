<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Консоль SQL запросов</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <h1>Users queries list</h1>
    <button id="usersQueries">Show</button>
    <div id="usersQueriesList"></div>

    <script defer>
        class TableView {
            displayTable() {
                return `
                    <table class="table table-sm table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Пользователь</th>
                                <th scope="col">Название</th>
                                <th scope="col">Текст запроса</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody"></tbody>
                    </table>
                `
            }
            addRow(item) {
                return `
                <tr>
                    <th scope="row">${item.login}</th>
                    <td>${item.name}</td>
                    <td>${item.query}</td>
                </tr>`
            }
        }

        $(document).ready(function () {
            $("#usersQueries").on("click", function () {
                $.ajax({
                    url: "../server/users.php",
                    method: "GET",
                })
                    .done(response => {
                        console.log(response);
                        const data = response.map(e => {
                            e.name = decodeURI(encodeURI(e.name));
                            e.query = decodeURI(encodeURI(e.query));
                            return e;
                        })
                        const queriesTable = new TableView();
                        $("#usersQueriesList").html(queriesTable.displayTable());
                        data.forEach(e => {
                            $("#tableBody").append(queriesTable.addRow(e))
                        })
                    })
                    .fail((xhr, status, err) => { console.error("Error: ", err) })
                    .always()
            })
        })
    </script>
</body>

</html>