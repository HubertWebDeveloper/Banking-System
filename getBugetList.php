<?php include("includes/function.php"); ?>

<?php

if(isset($_POST["emp_id"]))  
{
    $output = '';

    $query = "SELECT * FROM budget_list WHERE budget_id = '".$_POST["emp_id"]."'";  
    $result = mysqli_query($con, $query); 
    $getname = mysqli_query($con, "SELECT * FROM `budget` WHERE id='".$_POST["emp_id"]."'");
    $rows = mysqli_fetch_assoc($getname);
    $status = $rows['status'];
    $i =0; 


    $output .= '  
    <div class="modal-header">
        <h5 class="modal-title" id="viewListLabel">(' . htmlspecialchars($rows["name"]) . ') List</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="EditCode.php" method="POST" class="bg-white" style="padding:10px">
            <div class="buttons text-end">';

                if ($status != "executed" && $status != "ongoing") {
                    $output .= '
                                <button type="button" class="mb-2" id="addList" data-bs-target="#addList" data-bs-toggle="modal" 
                                        style="border:none;background:#6495ED;color:white;padding:5px 7px;border-radius:4px">
                                    <i class="mdi mdi-server-plus"></i>
                                </button>
                                <button type="submit" name="editBudgetList" id="editList" class="mb-2" 
                                        style="border:none;background:#424949;color:white;padding:5px 7px;border-radius:4px">
                                    <i class="mdi mdi-marker"></i>
                                </button>
                                <button type="submit" name="deleteBudgetList" id="deleteList" class="mb-2" 
                                        style="border:none;background:#DE3163;color:white;padding:5px 7px;border-radius:4px">
                                    <i class="mdi mdi-window-close"></i>
                                </button>';
                }

                $output .= '
            </div>
            <div class="table-responsive">
                <table id="myTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                        <th style="position: sticky; left: 0; z-index: 1; background-color: white;"></th>
                            <th style="position: sticky; left: 40px; z-index: 1; background-color: white;">ID</th>
                            <th>Budget ID</th>
                            <th>Title</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Total_amount</th>
                        </tr>
                    </thead>
                    <tbody>';  
                        while($row = mysqli_fetch_array($result))  
                        {  
                            $i++;
                            $id = $row['id'];
                            $output .= '  
                                <tr>
                                    <td style="position: sticky; left: 0; background-color: white;">
                                        <input type="checkbox" name="selected[]" value="' . $row["id"] . '" class="row-select" onchange="toggleEditable(this)">
                                    </td>
                                    <td style="position: sticky; left: 40px; background-color: white;">' . $i . ' | ' . $id . '</td>
                                    <td>' . $row["budget_id"] . '</td>
                                    <td>
                                        <input type="text" name="title[' . $row["id"] . ']" value="' . htmlspecialchars($row["title"]) . '" class="form-control" style="width:200px" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="unit[' . $row["id"] . ']" value="' . $row["unit"] . '" class="form-control" style="width:100px" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="price[' . $row["id"] . ']" value="' . $row["price"] . '" class="form-control" style="width:100px" readonly>
                                    </td>
                                    <td>' . $_SESSION["LoggedInUser"]["Currency"] . ' ' . number_format($row["total_amount"], 2, ".", ",") . '</td>
                                </tr>
                                ';  
                        }  
                        $output .= "
                    </tbody>
                </table>
            </div>
        </form>
    </div>";  
    echo $output;  
}
?>
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
</script>                           