<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Data</title>
    <style>
        .table>tbody>tr>td,
        .table>tbody>tr>th,
        .table>tfoot>tr>td,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>thead>tr>th {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>User Data</h2>
    <table class="table" border="1" style="width: 100%;">
        <thead>
            <tr>
                <th style="vertical-align : middle;text-align:center;">No</th>
                <th style="vertical-align : middle;text-align:center;">Name</th>
                <th style="vertical-align : middle;text-align:center;">Email</th>
                <th style="vertical-align : middle;text-align:center;">Level</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            @foreach($user as $u)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->level }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>