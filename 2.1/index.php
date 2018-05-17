<?php
$data = file_get_contents('book.json');
$contacts = json_decode($data, true);
/*echo '<pre>';
print_r ($contacts);
echo '</pre>';
foreach ($contacts as $contact) { 
    echo '<pre>';
    print_r ($contact);
    echo '</pre>';
    echo $contact['firstName'];
    echo $contact['lastName'];
    echo $contact['address'];
    echo $contact['phoneNumber'];
} */
?>

<html lang=ru>
<head>
    <meta charset="UTF-8">
    <style>
        table {
            width: 100%;
            table-layout: fixed;
        }
        
        .tbl-header {
            background-color: rgba(255, 255, 255, 0.3);
        }
        
        .tbl-content {
            height: 300px;
            overflow-x: auto;
            margin-top: 0px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        th {
            padding: 20px 15px;
            text-align: left;
            font-weight: 500;
            font-size: 12px;
            color: #fff;
            text-transform: uppercase;
        }
        
        td {
            padding: 15px;
            text-align: left;
            vertical-align: middle;
            font-weight: 300;
            font-size: 12px;
            color: #fff;
            border-bottom: solid 1px rgba(255, 255, 255, 0.1);
        }
        
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
        body {
            background: -webkit-linear-gradient(left, #25c481, #25b7c4);
            background: linear-gradient(to right, #25c481, #25b7c4);
            font-family: 'Roboto', sans-serif;
        }
        
        section {
            margin: 50px;
        }
    </style>
</head>

<body>
    <section>
        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <td style="color: black"><strong>Имя</strong></td>
                        <td style="color: black"><strong>Фамилия</strong></td>
                        <td style="color: black"><strong>Адрес</strong></td>
                        <td style="color: black"><strong>Телефон</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contacts as $contact) { ?>
                        <tr>
                            <td>
                                <?php echo $contact['firstName']; ?>
                            </td>
                            <td>
                                <?php echo $contact['lastName']; ?>
                            </td>
                            <td>
                                <?php echo $contact['address']; ?>
                            </td>
                            <td>
                                <?php echo $contact['phoneNumber']; ?>
                            </td>
                        </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>