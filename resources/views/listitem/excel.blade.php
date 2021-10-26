<?php
header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment; filename=List Item.xlsx");

?>
<h2>List Item</h2>
<table border="1">
    <thead>
        <tr style="background: #cccccc">
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