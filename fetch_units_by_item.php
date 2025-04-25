<?php
include_once(__DIR__ . "/../config/connection.php");

if (isset($_GET['item_id'])) {
    $item_id = $_GET['item_id'];

    $query = "SELECT packing_unit_id, packing_unit_name FROM tbl_packing_unit_master";
    $stmt = $_dbh->prepare($query);
    $stmt->execute(); 
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    echo '<table id="gridTable" class="table table-bordered table-striped">';
    echo '<thead>
            <tr>
                <th>Action</th>
                <th>Packing Unit Name</th>
                <th>Rent Per Month</th>
                <th>Rent Per Seasonal</th>
            </tr>
          </thead><tbody>';

    foreach ($results as $row) {
        echo '<tr>';
        echo '<td>
                <i class="fa fa-edit text-primary edit-icon" style="cursor:pointer;"></i>
                &nbsp;
                <i class="fa fa-trash text-danger delete-icon" style="cursor:pointer;"></i>
              </td>';
        echo '<td>' . htmlspecialchars($row['packing_unit_name']) . '</td>';
        echo '<td><input type="text" class="form-control" value="00.00" /></td>';
        echo '<td><input type="text" class="form-control" value="00.00" /></td>';
        echo '</tr>';
    }

    echo '</tbody></table>';
}
?>
