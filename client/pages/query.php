<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Выполнение запроса</title>

    <!-- bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <header><?php include "../layouts/header.php" ?></header>
    <main class="container">
        <h1 class="text-center">Query sandbox</h1>

        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <div class="input-group mb-3">
                    <select class="custom-select" id="queriesSelect">
                        <option selected disabled value="-1">Выбор запроса</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">u</button>
                    </div>
                </div>
                <div class="border mb-2" id="queryText">
                    <div>Текст запроса (только чтение)</div>
                </div>
                <button id="requestQueryBtn">Выполнить</button>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Результат запроса
            </div>
            <div class="card-body">
                <div id="table"></div>
            </div>
        </div>
    </main>

    <script defer type="module">
        import { TableModel, TableView, TableController } from "./../components/table.js";

        class selectModel {
            constructor(list) {
                this.list = list;
            }
        }
        class selectView {
            constructor() {
                this.select = $("#queriesSelect");
            }
            option({ id, name }) {
                return `
                    <option value="${id}">${name}</option>
                `
            }
            fetchQueryResult() {
                this.select.on("change", function (event) {
                    const queryId = event.target.value;
                    $.ajax({
                        url: "../../server/queries.php",
                        method: "POST",
                        data: JSON.stringify({ id: queryId }),
                        headers: { "contentType": "application/json" },
                    })
                    .done(response => {
                        $("#queryText").text(response.query);
                    })
                    .then(response => {
                        console.log(response.userResult);
                        const createTable = new TableController(new TableView(), new TableModel(response.userResult));
                        createTable.display();
                    })
                    .fail()
                    .always()
                })
            }
        }
        class selectController {
            constructor(view, model) {
                this.view = view;
                this.model = model;
            }
            apendOptions() {
                this.model.list.forEach(elem => $("#queriesSelect").append(this.view.option(elem)));
                $("#queriesSelect").val('-1');
            }
            change() {
                this.view.fetchQueryResult();
            }
        }
        $(document).ready(function () {
            $.ajax({
                url: "../../server/queries.php",
                method: "GET",
            })
                .done(response => {
                    const queriesSelect = new selectController(new selectView(), new selectModel(response));
                    queriesSelect.apendOptions();
                    queriesSelect.change();
                })
                .fail()
                .always()
            $("#requestQueryBtn").on("click", function () {
                $("#queriesSelect").trigger("change");
            })
        })
    </script>
</body>

</html>