<?php include("includes/header.php"); ?>
<?php
    $admins = mysqli_query($con, "SELECT * FROM `budget` WHERE `usePIN`= '$userPIN' ORDER BY id DESC");
    $i=0;
?>
<div class="card-header">
    <button class="btn" style="background:#1f3864;color:white" data-bs-toggle="modal" data-bs-target="#addBudget">Add New Budget/Plan</button>
</div>
<form action="EditCode.php" method="POST" class="bg-white"style="padding:10px">
    <div class="buttons text-end">
       <button type="button" class="mb-2" style="border:none;background:#6495ED;color:white;padding:5px 7px;border-radius:4px" data-bs-target="#addList" data-bs-toggle="modal"><i class="mdi mdi-server-plus"></i></button>
       <button type="submit" name="editBudget" class="mb-2" id="editButton"style="border:none;background:#424949;color:white;padding:5px 7px;border-radius:4px"><i class="mdi mdi-marker"></i></button>
       <button type="submit" name="deleteBudget" class="mb-2" id="deleteButton"style="border:none;background:#DE3163;color:white;padding:5px 7px;border-radius:4px"><i class="mdi mdi-window-close"></i></button>
       <button type="submit" name="executeBudget" class="mb-2" id="executeButton"style="border:none;background:#FFBF00;color:white;padding:5px 7px;border-radius:4px"><i class="mdi mdi-check-circle"></i></button>
    </div>
        
    <div class="table-responsive">
        <table id="myTable_customer" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th style="display:none">id</th>
                    <th></th>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Name</th>
                    <th>Create_at</th>
                    <th>executed_at</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($admins as $admin) : $i++; $id = $admin['id']; $status=$admin['status']; 
                    $query = mysqli_query($con, "SELECT SUM(total_amount) AS total_sum FROM budget_list WHERE budget_id = $id");
                    $row = mysqli_fetch_assoc($query);
                    $total_amount = $row['total_sum'];
                ?>
                <tr>
                    <td style="display:none"><?php echo $admin["id"] ?></td>
                    <td><input type="checkbox" name="selected[]" value="<?= $admin['id'] ?>" class="row-select" onchange="toggleEditable(this),toggleButtons(this, '<?= $status ?>')"></td>
                    <td><?= $i ?> | <?= $id ?></td>
                    <td>
                        <?php
                        if($status=="executed"){
                            echo "<label style='border-radius:4px;color:white;padding:5px 7px;background:green'>$status</label>";
                        }else{
                            echo "<label style='border-radius:4px;color:white;padding:5px 7px;background:red'>$status</label>";
                        }
                        ?>
                    </td>
                    <td><input type="text" name="name[<?= $admin['id'] ?>]" value="<?= $admin['name'] ?>" class="form-control" style="width:300px" readonly></td>
                    <td><?= $admin['create_at'] ?></td>
                    <td><?= $admin['executed_at'] ?></td>
                    <td><?= $_SESSION['LoggedInUser']['Currency'] ?> <?= number_format($total_amount, 2, '.', ',') ?></td>
                    <td>
                    <button type="button" id='<?php echo $admin["id"] ?>' class="btn btn-secondary me-2 checkBudgetList">
                        <i class="mdi mdi-eye"></i>
                    </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</form>

<!-- Modal -->
<div class="modal fade" id="addBudget" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adding New Budget/Plan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid px-4 mb-4">
                    <form action="EditCode.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">Budget/Plan Name</label>
                                    <input type="text" name="name" placeholder="Write Budget/Plan Name" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="saveBudget" class="btn" style="background:#1f3864;color:white">Save Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- adding budget list -->
<div class="modal fade" id="addList" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adding Budget List/Items</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid px-4 mb-4">
                    <form action="EditCode.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">Budget ID</label>
                                    <select name="budget_id" class="form-select">
                                        <option value="">--Select--</option>
                                        <?php foreach($admins as $admin) : $id = $admin['id']; ?>
                                        <option value="<?php echo $id ?>"><?= $admin['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">Title</label>
                                    <input type="text" name="title" placeholder="Item name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">Units/Qty</label>
                                    <input type="number" name="unit" placeholder="Qty" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">Cost per Unit</label>
                                    <input type="number" name="price" placeholder="Cost per unit" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="saveBudgetList" class="btn" style="background:#1f3864;color:white">Save Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- viewing budget list -->
<div class="modal fade" id="viewList" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content view">
            
        </div>
    </div>
</div>

<script>
function toggleEditable(checkbox) {
    let row = checkbox.closest('tr');
    let inputs = row.querySelectorAll('input[type="text"], input[type="number"]'); // Fixed selector

    inputs.forEach(function(input) {
        if (checkbox.checked) {
            input.removeAttribute('readonly');  // Make the input editable
        } else {
            input.setAttribute('readonly', 'readonly');  // Make the input read-only
        }
    });
}
function toggleButtons(checkbox, status) {
    // Get the buttons
    const editButton = document.getElementById('editButton');
    const deleteButton = document.getElementById('deleteButton');
    const executeButton = document.getElementById('executeButton');

    // Check if the checkbox is checked
    if (checkbox.checked) {
        // Check the status of the selected row
        if (status === 'executed' || status === 'ongoing') {
            // Hide all buttons except the Add List button
            editButton.style.display = 'none';
            deleteButton.style.display = 'none';
            executeButton.style.display = 'none';
        } else {
            // Show all buttons
            editButton.style.display = 'inline-block';
            deleteButton.style.display = 'inline-block';
            executeButton.style.display = 'inline-block';
        }
    } else {
        // If the checkbox is unchecked, show all buttons
        editButton.style.display = 'inline-block';
        deleteButton.style.display = 'inline-block';
        executeButton .style.display = 'inline-block';
    }
}
</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script>
// $(document).ready(function () {
//     $('button').click(function () {
//         let id_emp = $(this).attr('id'); // Using 'let' for block scope

//         $.ajax({
//             url: "getBugetList.php",
//             method: "POST",
//             data: { emp_id: id_emp },
//             success: function (result) {
//                 $(".view").html(result); // Ensure .view exists in your HTML
//                 $('#viewList').modal("show"); // Show modal after data is loaded
//             },
//             error: function () {
//                 alert("Failed to fetch data.");
//             }
//         });
//     });
// });
document.querySelectorAll(".checkBudgetList").forEach(function (button) {
    button.addEventListener("click", function () {
        let id_emp = this.getAttribute("id"); // Getting the button ID

        fetch("getBugetList.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: new URLSearchParams({ emp_id: id_emp })
        })
        .then(response => response.text())
        .then(result => {
            document.querySelector(".view").innerHTML = result; // Ensure .view exists in your HTML
            let modal = new bootstrap.Modal(document.getElementById("viewList"));
            modal.show(); // Show modal after data is loaded
        })
        .catch(() => {
            alert("Failed to fetch data.");
        });
    });
});

</script>

<?php include("includes/footer.php"); ?>
  
    
    
    
    
      
      
      
      

          
          
        

