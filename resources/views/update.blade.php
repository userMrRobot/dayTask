<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать задачу</title>
    <style>
        /* Основные стили страницы */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }
        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        label {
            display: block;
            color: #333;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }
        .button {
            border: none;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .save-button {
            background-color: #4CAF50;
        }
        .cancel-button {
            background-color: #f44336;
            margin-left: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Редактировать задачу</h1>

    <!-- Форма для редактирования задачи -->
    <form id="editTaskForm" method="POST" action="{{ route('update', $task->id) }}">
        @csrf
{{--        @method('PATCH')--}}

        <!-- Поле для ввода нового названия задачи -->
        <label for="task">Название задачи</label>
        <input type="text" name="task" id="task" placeholder="{{ $task->name }}"  required>

        <!-- Кнопки сохранения и отмены -->
        <button type="submit" class="button save-button">Сохранить изменения</button>
        <a href="{{ route('home') }}" class="button cancel-button">Отмена</a>
    </form>
</div>

</body>
</html>
