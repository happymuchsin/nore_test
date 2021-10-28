<?php
header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment; filename=User Data.xlsx");

?>
<h2>User Data</h2>
<table border="1">
    <thead>
        <tr style="background: #cccccc">
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