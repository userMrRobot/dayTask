
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
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
            width: 80%;
            text-align: left;
        }
        h1 {
            color: #333;
            font-size: 24px;
        }
        /* Стили для задач */
        .task-list {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }
        .task {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            background-color: #e6f7ff;
            margin-bottom: 10px;
            transition: background-color 0.3s;
        }
        .task.done {
            background-color: #d3f9d8;
            text-decoration: line-through;
            color: #888;
        }
        /* Кнопки */
        .button {
            border: none;
            color: #ffffff;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            margin-left: 5px;
        }
        .add-button {
            background-color: #4CAF50;
        }
        .edit-button {
            background-color: #ffa726;
        }
        .delete-button {
            background-color: #f44336;
        }
        .toggle-button {
            background-color: #26a69a;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>To-Do List</h1>
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{session('success')}}
    </div>
    @endif
    <!-- Форма добавления новой задачи -->
    <form id="addTaskForm" method="POST" action="{{ route('store') }}">
        @csrf
        <input type="text" name="name" id="taskInput" placeholder="Введите новую задачу" required>
        <button type="submit" class="button add-button">Добавить задачу</button>
    </form>

    <!-- Список задач -->
    <ul class="task-list">

        @foreach ($tasks as $task)

            <li class="task {{ $task->is_done ? 'done' : '' }}">
                <span>{{ $task->name }}</span>

                <!-- Кнопка выполнения задачи -->
                <form action="{{ route('toggle', [$task->id]) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="button toggle-button">
                        {{ $task->is_done ? 'Выполнено' : 'Не выполнено' }}
                    </button>
                </form>

                <!-- Кнопка редактирования задачи -->
                <a class="button edit-button" href="{{ route('izmena', [$task->id]) }}">Изменить</a>
{{--                <button class="button edit-button" onclick="editTask({{ $task->id }}, '{{ $task->name }}')">Изменить</button>--}}

                <!-- Кнопка редактирования задачи -->


                <!-- Кнопка удаления задачи -->
                <form action="{{ route('delete', $task->id) }}" method="POST" style="display: inline;">
                    @csrf
{{--                    @method('DELETE')--}}
                    <button type="submit" class="button delete-button">Удалить</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>

<!-- JavaScript для редактирования задачи -->
<script>
    function editTask(taskId, taskName) {
        const newTaskName = prompt("Измените задачу:", taskName);
        if (newTaskName !== null && newTaskName.trim() !== "") {
            // Создаём форму и отправляем PATCH-запрос на сервер
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/update/${taskId}`;
            form.style.display = 'none';

            // Добавляем скрытые поля для отправки данных
            const csrfField = document.createElement('input');
            csrfField.type = 'hidden';
            csrfField.name = '_token';
            csrfField.value = '{{ csrf_token() }}';
            form.appendChild(csrfField);

            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'PATCH';
            form.appendChild(methodField);

            const taskField = document.createElement('input');
            taskField.type = 'hidden';
            taskField.name = 'task';
            taskField.value = newTaskName;
            form.appendChild(taskField);

            document.body.appendChild(form);
            form.submit();
        }
    }
</script>

</body>
</html>


