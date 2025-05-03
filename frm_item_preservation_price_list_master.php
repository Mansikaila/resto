    <?php
        include("classes/cls_item_preservation_price_list_master.php");
        include("include/header.php");
        include("include/theme_styles.php");
        include("include/header_close.php");

        $transactionmode = "";
        $item_name = "";
        if (isset($_REQUEST["transactionmode"])) {    
            $transactionmode = $_REQUEST["transactionmode"];
        }
        if ($transactionmode == "U") {    
            $_bll->fillModel();
            $label = "Update";
        } else {
            $label = "Add";
        }
    ?>
    <body class="hold-transition skin-blue layout-top-nav">
    <?php
        include("include/body_open.php");
    ?>
    <div class="wrapper">
    <?php
        include("include/navigation.php");
    ?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container-fluid">
          <section class="content-header">
            <h1>
              <?php echo $label; ?> Data
            </h1>
            <ol class="breadcrumb">
              <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="srh_item_preservation_price_list_master.php"><i class="fa fa-dashboard"></i> Item Preservation Price List Master</a></li>
              <li class="active"><?php echo $label; ?></li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="col-md-12" style="padding:0;">
              <div class="box box-info">
                <!-- form start -->
                <form id="masterForm" action="classes/cls_item_preservation_price_list_master.php" method="post" class="form-horizontal needs-validation" enctype="multipart/form-data" novalidate>
                  <div class="box-body">
                    <div class="form-group row gy-2">
                      <?php
                        global $database_name;
                        global $_dbh;

                        $hidden_str = "";
                        $table_name = "tbl_item_preservation_price_list_master";
                        $lbl_array = array();
                        $field_array = array();
                        $err_array = array();

                        // Fetch field data dynamically
                        $select = $_dbh->prepare("SELECT `generator_options` FROM `tbl_generator_master` WHERE `table_name` = ?");
                        $select->bindParam(1, $table_name);
                        $select->execute();
                        $row = $select->fetch(PDO::FETCH_ASSOC);
                        if ($row) {
                            $generator_options = json_decode($row["generator_options"]);
                            if ($generator_options) {
                                $fields_names = $generator_options->field_name;
                                $fields_types = $generator_options->field_type;
                                $fields_labels = $generator_options->field_label;
                                // Iterate through fields for dynamic form generation
                                if (is_array($fields_names) && !empty($fields_names)) {
                                    for ($i = 0; $i < count($fields_names); $i++) {
                                        if ($fields_names[$i] == "item_id") {
                                            // Custom dropdown for item selection
                                            echo '<label for="item_id" class="col-sm-1 col-form-label">Item</label>';
                                            echo '<div class="col-sm-6">';
                                            echo '<select class="form-control" id="item_id" name="item_id" style="max-width: 300px;">';
                                            echo '<option value="">-- Select Item --</option>';

                                            try {
                                                $stmt = $_dbh->prepare("SELECT item_id, item_name FROM tbl_item_master");
                                                $stmt->execute();
                                                $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                foreach ($items as $item) {
                                                    echo '<option value="' . htmlspecialchars($item['item_id']) . '">' . htmlspecialchars($item['item_name']) . '</option>';
                                                }
                                            } catch (PDOException $e) {
                                                error_log("Database Error: " . $e->getMessage());
                                                echo '<option value="">Error fetching items</option>';
                                            }

                                            echo '</select>';
                                            echo '</div>';
                                            echo '<div class="col-md-12 mt-3">';
                                            echo '<div id="gridContainer" class="table-responsive" style="width: 100%; display: none;"></div>';
                                            echo '</div>';
                                        }
                                    }
                                }
                            }
                        }
                      ?>
                    </div>
                  </div>
                  <div class="box-footer">
                    <?php echo $hidden_str; ?>
                    <input type="hidden" id="transactionmode" name="transactionmode" value="<?php echo ($transactionmode == "U") ? "U" : "I"; ?>">
                    <input type="hidden" id="modified_by" name="modified_by" value="<?php echo USER_ID; ?>">
                    <input type="hidden" id="modified_date" name="modified_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
                    <input type="hidden" name="masterHidden" id="masterHidden" value="save" />
                  </div>
                </form>
              </div>
            </div>
          </section>
        </div>
      </div>
      <?php
        include("include/footer.php");
      ?>
    </div>
    <?php
        include("include/footer_includes.php");
    ?>  

<script>
   document.addEventListener("DOMContentLoaded", function () {
    const gridContainer = document.getElementById("gridContainer");

    // Fetch data when item_id is changed
    document.getElementById("item_id").addEventListener("change", function () {
        const itemId = this.value;

        if (itemId !== "") {
            fetch("classes/cls_item_preservation_price_list_master.php?action=fetch_units&item_id=" + encodeURIComponent(itemId))
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        let html = `
                            <table class="table table-bordered table-striped text-center align-middle">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Packing Unit Name</th>
                                        <th>Rent Per KG (Monthly)</th>
                                        <th>Rent Per KG (Seasonal)</th>
                                    </tr>
                                </thead>
                                <tbody>
                        `;
                        data.forEach(unit => {
                            html += `
                                <tr data-id="${unit.packing_unit_id}">
                                    <td>${unit.packing_unit_name}</td>
                                    <td contenteditable="true" class="editable rent-monthly">${unit.rent_kg_per_month}</td>
                                    <td contenteditable="true" class="editable rent-seasonal">${unit.season_rent_per_kg}</td>
                                </tr>
                            `;
                        });
                        html += "</tbody></table>";
                        html += `<button id="commonSaveButton" class="btn btn-primary mt-3">Save All</button>`;
                        gridContainer.innerHTML = html;
                        gridContainer.style.display = "block";

                        // Add event listener for the common save button
                        document.getElementById("commonSaveButton").addEventListener("click", function () {
                            const rows = gridContainer.querySelectorAll("tbody tr");
                            const updates = [];

                            // Collect data for all rows
                           rows.forEach(row => {
    const packingUnitId = row.dataset.id || '';  // Use empty string for new records
    const rentKgPerMonth = row.querySelector(".rent-monthly").innerText.trim();
    const seasonRentPerKg = row.querySelector(".rent-seasonal").innerText.trim();

    updates.push({
        packing_unit_id: packingUnitId,  // Empty for new records
        rent_kg_per_month: rentKgPerMonth,
        season_rent_per_kg: seasonRentPerKg,
        item_id: itemId
    });
});


                            // Send data to the server
                            fetch("classes/cls_item_preservation_price_list_master.php?action=save_unit", {
                                method: "POST",
                                headers: { "Content-Type": "application/json" },
                                body: JSON.stringify(updates)
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        alert("All records updated successfully.");
                                    } else {
                                        alert("Some records were not updated. They might not exist in the database.");
                                    }
                                })
                                .catch(error => {
                                    console.error("Error:", error);
                                    alert("Error saving data.");
                                });
                        });
                    } else {
                        gridContainer.innerHTML = "<p>No packing units found.</p>";
                        gridContainer.style.display = "block";
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    gridContainer.innerHTML = "<p>Error loading data.</p>";
                });
        } else {
            gridContainer.style.display = "none";
            gridContainer.innerHTML = "";
        }
    });
});
</script>
    <?php
        include("include/footer_close.php");
    ?>