<?php include("includes/header.php"); ?>
<?php
    $admins = mysqli_query($con, "SELECT * FROM `assets` WHERE `usePIN`= '$userPIN'");
    $i=0;
?>
<div class="bg-white"style="padding:10px">
    <div class="buttons text-end">
        <div class="text-start">
            <b style="color:red">Red Color shows credit asset</b> | <b>Black Color shows Debit asset</b>
        </div>
        <button type="button" class="mb-2" style="border:none;background:#ff0023;color:white;padding:5px 7px;border-radius:4px" data-bs-target="#generateReport" data-bs-toggle="modal"><i class="mdi mdi-file-pdf-box"></i></button>
        <a href="GenerateReports.php?AssetsuserPIN=<?php echo $userPIN ?>" target="_blank" class="mb-2" style="border:none;background:#424949;color:white;padding:5px 7px;border-radius:4px"><i class="mdi mdi-format-vertical-align-bottom"></i></a>
    </div>
    <div class="table-responsive">
        <table id="myTable_customer" class="table table-striped table-bordered">
            <thead>
                <tr>
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
                    $transactionType = strtolower(trim($admin['asset_type'])); // Ensure case consistency
                    $rowColor = ($transactionType == 'credit') ? 'style="color:red;"' : 'style="color:black;"';
                ?>
                <tr>
                    <td><?= $i ?> | <?= $id ?></td>
                    <td <?= $rowColor ?>><?= htmlspecialchars($admin['transcation_type']) ?></td>
                    <td <?= $rowColor ?>><?= $_SESSION['LoggedInUser']['Currency'] ?> <?= number_format($admin['amount'], 2, '.', ',') ?></td>
                    <td <?= $rowColor ?>><?= htmlspecialchars($admin['description']) ?></td>
                    <td <?= $rowColor ?>><?= date("d M, Y", strtotime($admin['date'])) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="generateReport" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-l">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Generate Assets Report</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid px-4 mb-4">
                    <form action="GenerateReports.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <input type="hidden" name="userPIN" value="<?php echo $userPIN ?>">
                            <div class="col-md-12 mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">Assets Type</label>
                                    <select name="assetType" class="form-select" required>
                                        <option value="all">All</option>
                                        <option value="debit">Debit</option>
                                        <option value="credit">Credit</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">From</label>
                                    <input type="date" name="startDate" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">To</label>
                                    <input type="date" name="endDate" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="FilterAssetReport" target="_blank" class="btn" style="background:#1f3864;color:white"data-bs-dismiss="modal" aria-label="Close" onclick="stopLoad()">Generate Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" 
        integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" 
        crossorigin="anonymous" 
        referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" 
        integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" 
        crossorigin="anonymous" 
        referrerpolicy="no-referrer"></script>

<script>
    function PrintMyReport() {
        var divContents = document.getElementById("myTable_customer").innerHTML;
        var a = window.open('', '_blank');

        a.document.write('<html><head><title>My Assets Report</title></head>');
        a.document.write('<body style="font-family: fangsong; background-image: url(\'images/blueriverlogo.png\');');
        a.document.write(' background-size: contain; background-position: center; background-repeat: no-repeat; margin: 0; padding: 0;">');
        a.document.write(divContents);
        a.document.write('</body></html>');
        
        a.document.close(); // Ensure the document is fully loaded before printing
        setTimeout(function () {
            a.print();
        }, 500); // Short delay to allow rendering
    }

    window.jsPDF = window.jspdf.jsPDF;

    function DownloadPdf(userPin) {
        var elementHTML = document.querySelector("#myTable_customer");
        var docPDF = new jsPDF();

        docPDF.html(elementHTML, {
            callback: function (doc) {
                doc.save(userPin + '.pdf');
            },
            x: 15,
            y: 15,
            width: 170,
            windowWidth: 650
        });
    }
</script> -->
<script>
    function stopLoad(){
        var loader = document.getElementById("divLoader");
        if (loader) {
            loader.style.display = "none";
        }
    }
</script>


<?php include("includes/footer.php"); ?>
  
    
    
    
    
      
      
      
      

          
          
        

