<?php
$db_options = require 'db.php';

global $db;
$db = new mysqli($db_options['host'], $db_options['user'], $db_options['password'], $db_options['dbname']);
if (!empty($_POST) && !empty($_POST['method'])) {
    do_method($_POST['method']);
}
else {
    show_html();
}

// functions
function do_method($method)
{
    switch ($method) {
    case 'add':
        add_task($_POST['text']);
        break;

    case 'done':
        done_task($_POST['index']);
        break;

    case 'delete':
        delete_task($_POST['index']);
        break;

    default:
        throw new Exception('Unknown method: ' . $method);
    }
    header("Location: {$_SERVER['REQUEST_URI']}");
}

function add_task($text)
{
    global $db;
    $st = $db->prepare('INSERT INTO tasks (description, date_added) VALUES (?, ?)');
    $st->bind_param('ss', $text, strftime('%F %T'));
    if (!$st->execute()) throw new Exception($st->error);
}

function done_task($index)
{
    global $db;
    $st = $db->prepare('UPDATE tasks SET is_done = true WHERE id = ?');
    $st->bind_param('i', $index);
    if (!$st->execute()) throw new Exception($st->error);
}

function delete_task($index)
{
    global $db;
    $st = $db->prepare('DELETE FROM tasks WHERE id = ?');
    $st->bind_param('i', $index);
    if (!$st->execute()) throw new Exception($st->error);
}

function get_tasks()
{
    global $db;
    $q = $db->query('SELECT * FROM tasks');
    if ($q === false && $db->errno != 0) throw new Exception($db->error);
    if (empty($q)) return [];
    $array = $q->fetch_all(MYSQLI_ASSOC);
    return $array;
}

function show_html()
{
    $form_start = "<form method='post' action='{$_SERVER['REQUEST_URI']}'>";
    $form_end = '</form>';
    // heredoc-string
    $html = <<<HTML
          $form_start
               <p>Добавить</p>
               <p><input type="text" name="text"></p>
               <input type="hidden" name="method" value="add">
               <p><input type="submit" value="Отправить"></p>
          $form_end
          <table>
HTML;
    foreach(get_tasks() as $task) {
        $text = $task['is_done'] ? "<s>{$task['description']}</s>" : $task['description'];
        $html.= <<<HTML
               <tr>
               <td>{$text}</td>
               <td>{$task['date_added']}</td>
               <td>
                    $form_start
                         <input type="hidden" name="method" value="done">
                         <input type="hidden" name="index" value="{$task['id']}">
                         <input type="submit" value="Выполнить">
                    $form_end
               </td>
               <td>
                    $form_start
                         <input type="hidden" name="method" value="delete">
                         <input type="hidden" name="index" value="{$task['id']}">
                         <input type="submit" value="Удалить">
                    $form_end
               </td>
               </tr>
HTML;
    }
    echo $html;
}