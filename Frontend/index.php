<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Студенты</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card" style="width: 18rem;">
            <div class="card-body">

            </div>
        </div>

        <form id="studentForm" class="mt-3">
            <h1>Добавление поста</h1>
            <div class="mb-3">
                <label class="form-label">Имя</label>
                <input type="text" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Фамилия</label>
                <input type="text" class="form-control" id="surname" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Группа</label>
                <input type="text" class="form-control" id="groups" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Почта</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <button type="submit" class="btn btn-primary" onclick="getStudents()">Добавить студента</button>
        </form>

        <form id="editStudentForm" class="mt-3">
            <h1>Редактирование поста</h1>
            <div class="mb-3">
                <label class="form-label">Имя</label>
                <input type="text" class="form-control" id="name-edit" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Фамилия</label>
                <input type="text" class="form-control" id="surname-edit" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Группа</label>
                <input type="text" class="form-control" id="groups-edit" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Почта</label>
                <input type="email" class="form-control" id="email-edit" required>
            </div>
            <button type="submit" class="btn btn-primary" onclick="updateStudent()">Редактирование студента</button>
        </form>
    </div>
</div>
    <script src="main.js"></script>
</body>
</html>