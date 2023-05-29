<?php
    include 'components/connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <script defer src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="script.js"></script>
</head>
<body>
<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Image</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

        <?php
        $users = $conn->query("SELECT * FROM users");
        while ($rowuser = $users->fetch()) {
        $id = $rowuser['id'];
        $name= $rowuser['name'];
        $email = $rowuser['email'];
        $image = $rowuser['image'];  
        $status = $rowuser['status'];       
        ?>
            <tr>
                <td><?php echo $id;?></td>
                <td><?php echo $name;?></td>
                <td><?php echo $email;?></td>
                <td><img class="img-fluid" src="uploaded_files/<?php echo $image;?>" width="30px;" /></td>
                <td><?php echo $status;?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>




