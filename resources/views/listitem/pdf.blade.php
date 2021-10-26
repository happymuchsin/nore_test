<!DOCTYPE html>
<html lang="en">

<head>
    <title>List Item</title>
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
    <h2>List Item</h2>
    <table class="table" border="1" style="width: 100%;">
        <thead>
            <tr>
                <th style="vertical-align : middle;text-align:center;">No</th>
                <th style="vertical-align : middle;text-align:center;">Name</th>
                <th style="vertical-align : middle;text-align:center;">Price</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            @foreach($list as $l)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $l->name }}</td>
                <td>Rp {{ number_format($l->price) }}.00</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>