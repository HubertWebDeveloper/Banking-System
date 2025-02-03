<?php include("includes/header.php"); ?>
<?php
    $admins = mysqli_query($con, "SELECT * FROM `assets` WHERE `usePIN`= '$userPIN' AND `asset_type`='credit' ORDER BY id DESC");
    $tranctions = mysqli_query($con, "SELECT * FROM `transactions`");
    $i=0;
?>
<div class="card-header">
    <button class="btn" style="background:#1f3864;color:white" data-bs-toggle="modal" data-bs-target="#addBudget">Add New Credit</button>
</div>
<form action="EditCode.php" method="POST" class="bg-white"style="padding:10px">
    <div class="buttons text-end">
       <button type="submit" name="editCredit" class="mb-2" id="editButton"style="border:none;background:#424949;color:white;padding:5px 7px;border-radius:4px"><i class="mdi mdi-marker"></i></button>
       <button type="submit" name="deleteCredit" class="mb-2" id="deleteButton"style="border:none;background:#DE3163;color:white;padding:5px 7px;border-radius:4px"><i class="mdi mdi-window-close"></i></button>
    </div>
        
    <div class="table-responsive">
        <table id="myTable_customer" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Transaction_Type</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($admins as $admin) : 
                    $i++;
                    $id = $admin['id'];
                ?>
                <tr>
                    <td>
                        <input type="checkbox" name="selected[]" value="<?= $admin['id'] ?>" class="row-select" onchange="toggleEditable(this)">
                    </td>
                    <td><?= $i ?> | <?= $id ?></td>
                    <td>
                        <select name="transactionType[<?= $admin['id'] ?>]" class="form-select" style="color:black;height:40px" readonly>
                            <?php foreach ($tranctions as $tranction) : ?>
                                <option value="<?= $tranction['transaction_type'] ?>" 
                                    <?= ($tranction['transaction_type'] == $admin['transcation_type']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($tranction['transaction_type']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="amount[<?= $admin['id'] ?>]" value="<?= htmlspecialchars($admin['amount']) ?>" 
                            class="form-control" style="width:100px" readonly>
                    </td>
                    <td>
                        <textarea name="desc[<?= $admin['id'] ?>]" class="form-control" readonly placeholder="Write the description here..."><?= htmlspecialchars($admin['description'] ?? '') ?></textarea>
                    </td>
                    <td><?= date("d M, Y", strtotime($admin['date'])) ?></td>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adding New Credit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid px-4 mb-4">
                    <form action="EditCode.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <input type="hidden" name="userPIN" value="<?php echo $userPIN ?>">
                            <div class="col-md-6 mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">Transaction Type</label>
                                    <select name="transactionType" class="form-select" required>
                                        <?php foreach ($tranctions as $tranction) : ?>
                                            <option value="<?= $tranction['transaction_type'] ?>"><?= $tranction['transaction_type'] ?></option>
                                            <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">Amount</label>
                                    <input type="number" name="amount" placeholder="Write Budget/Plan Name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">Description</label>
                                    <textarea name="desc" name="" class="form-control" placeholder="Write the description here..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="saveCredit" class="btn" style="background:#1f3864;color:white">Save Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleEditable(checkbox) {
    let row = checkbox.closest('tr');
    let inputs = row.querySelectorAll('input[type="text"], input[type="number"], select, textarea'); // Fixed selector

    inputs.forEach(function(input) {
        if (checkbox.checked) {
            input.removeAttribute('readonly');  // Make the input editable
        } else {
            input.setAttribute('readonly', 'readonly');  // Make the input read-only
        }
    });
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
  
    
    
    
    
      
      
      
      

          
          
        

