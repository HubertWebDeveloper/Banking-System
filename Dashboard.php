<?php include("includes/header.php"); ?>

<div class="card">
  <div class="row text-center mb-3">
    <div class="col-md-4 mt-4 text-center">
      <?php

      $id = $_SESSION['LoggedInUser']['ID'];

      $selectProp = mysqli_query($con, "SELECT SUM(amount) as total_amount_prop FROM property WHERE usePIN = '$userPIN'");
      $Pro_row = mysqli_fetch_assoc($selectProp);
      $total_amount_pro = $Pro_row['total_amount_prop'] ?? 0;

      $selectAssets = mysqli_query($con, "
        SELECT 
          SUM(CASE WHEN asset_type = 'debit' THEN amount ELSE 0 END) AS total_sum_debit,
          SUM(CASE WHEN asset_type = 'credit' THEN amount ELSE 0 END) AS total_sum_credit
        FROM assets WHERE usePIN = '$userPIN'
      ");
      $row = mysqli_fetch_assoc($selectAssets);

      $selectAssetsLastThis = mysqli_query($con, "
        SELECT 
            SUM(CASE WHEN asset_type = 'debit' AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE()) THEN amount ELSE 0 END) AS total_sum_debit_this_month,
            SUM(CASE WHEN asset_type = 'credit' AND MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE()) THEN amount ELSE 0 END) AS total_sum_credit_this_month,
            SUM(CASE WHEN asset_type = 'debit' AND MONTH(date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) THEN amount ELSE 0 END) AS total_sum_debit_last_month,
            SUM(CASE WHEN asset_type = 'credit' AND MONTH(date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) THEN amount ELSE 0 END) AS total_sum_credit_last_month
        FROM assets WHERE usePIN = '$userPIN'
      ");
      $rows = mysqli_fetch_assoc($selectAssetsLastThis);


      $total_sum_debit = $row['total_sum_debit'] ?? 0;
      $total_sum_credit = $row['total_sum_credit'] ?? 0;

      $total_cash_at_hand = $total_sum_debit - $total_sum_credit;


      $total_sum_debit_this_month = $rows['total_sum_debit_this_month'] ?? 0;
      $total_sum_credit_this_month = $rows['total_sum_credit_this_month'] ?? 0;
      $total_sum_debit_last_month = $rows['total_sum_debit_last_month'] ?? 0;
      $total_sum_credit_last_month = $rows['total_sum_credit_last_month'] ?? 0;

      // Calculate total cash at hand
      $total_cash_at_hand_this_month = $total_sum_debit_this_month - $total_sum_credit_this_month;
      $total_cash_at_hand_last_month = $total_sum_debit_last_month - $total_sum_credit_last_month;




      $checkOut = mysqli_query($con,"SELECT * FROM `users` WHERE `id`='$id'");
      $rows = mysqli_fetch_assoc($checkOut);
      if (isset($rows['profile']) && strpos($rows['profile'], 'avatar/') === 0) {
        // If the profile image path starts with 'avatar/', display it as an avatar
        ?>
        <img src="<?= $rows['profile'] ?>" id="userAvatar" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;" alt="User Avatar">
        <?php
      } elseif (!empty($rows['profile'])) {
          // If the profile field contains a file path in the 'profiles' folder
          ?>
          <img src="profiles/<?= $rows['profile'] ?>" id="userAvatar" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;" alt="User Avatar">
          <?php
      } else {
          // If there's no profile image set, display a default image
          ?>
          <img src="images/userIcon.png" id="userAvatar" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;" alt="User Avatar">
          <?php
      }
      
      ?>
      

      <div class="row mt-3">
        <!-- Edit Profile Button -->
        <div class="col-md-6">
          <form id="editProfileForm" enctype="multipart/form-data">
            <label class="btn text-white" style="background:#1f3864; cursor: pointer;">
              Edit Profile
              <input type="file" name="profileImage" accept="image/*" style="display: none;" id="profileImageInput">
            </label>
          </form>
        </div>

        <!-- Use Avatar Button -->
        <div class="col-md-6">
          <button class="btn" style="background:none; border:1px solid #1f3864; color:#1f3864;" id="useAvatarButton">
            Use Avatar
          </button>
        </div>
      </div>

      <!-- Avatar Modal -->
      <div class="modal fade" id="avatarModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Select Avatar</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id="avatarGallery" class="d-flex flex-wrap"></div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    <div class="col-md-8 mt-3 text-center">
      <h4 class="fw-bold text-uppercase">User Profile</h4>
      <div class="row">
        <div class="col-md-6">
          <div class="input-group mb-3" style="border: none">
            <span class="input-group-text fw-bold" style="background:none;border:none">Your PIN</span>
            <input type="text" class="form-control"style="border:none;background:none" value="<?= $_SESSION['LoggedInUser']['pin'] ?>"readonly>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group mb-3" style="border: none">
            <span class="input-group-text fw-bold" style="background:none;border:none">Full Name</span>
            <input type="text" class="form-control"style="border:none;background:none" value="<?= $_SESSION['LoggedInUser']['firstname'] ." ". $_SESSION['LoggedInUser']['lastname'] ?>"readonly>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group mb-3" style="border: none">
            <span class="input-group-text fw-bold" style="background:none;border:none">Email</span>
            <input type="text" class="form-control"style="border:none;background:none" value="<?= $_SESSION['LoggedInUser']['email']?>"readonly>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group mb-3" style="border: none">
            <span class="input-group-text fw-bold" style="background:none;border:none">Contact/Phone</span>
            <input type="text" class="form-control"style="border:none;background:none" value="<?= $_SESSION['LoggedInUser']['contact']?>"readonly>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group mb-3" style="border: none">
            <span class="input-group-text fw-bold" style="background:none;border:none">Nationality</span>
            <input type="text" class="form-control"style="border:none;background:none" value="<?= $_SESSION['LoggedInUser']['nationality']?>"readonly>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group mb-3" style="border: none">
            <span class="input-group-text fw-bold" style="background:none;border:none">Gender</span>
            <input type="text" class="form-control"style="border:none;background:none" value="<?= $_SESSION['LoggedInUser']['gender']?>"readonly>
          </div>
        </div>
        <!-- <div class="col-md-12">
            <a href="steps.php" class="btn text-white"style="background:#1f3864">Complete Your Profile</a>
        </div> -->
        
      </div>
    </div>
  </div>
</div>
<div class="card mt-2">
  <div class="card-header">
    <p>My Products / Assets</p>
  </div>
  <div class="row">
    <div class="col-md-2 mt-3 mb-2 text-center">
      <i class="mdi mdi-account-card-details" style="background:#1f3864;color:white;padding:10px"></i>
    </div>
    <div class="col-md-3 mt-2 text-center">
      <b><?= $_SESSION['LoggedInUser']['pin']?></b>
      <p>My Account/Banking</p>
    </div>
    <div class="col-md-2 mt-2 text-center">
      <b><?= $_SESSION['LoggedInUser']['Currency']?> <?= number_format($total_cash_at_hand, 2, '.', ',')?></b>
      <p>Current Balance Cash</p>
    </div>
    <div class="col-md-3 mt-2 text-center">
      <b><?= $_SESSION['LoggedInUser']['Currency']?> <?= number_format($total_amount_pro, 2, '.', ',')?></b>
      <p>Current Balance Property</p>
    </div>
    <div class="col-md-2 text-center">
      <a class="nav-link" href="#" data-bs-toggle="dropdown" id="profileDropdown"style="color:#1f3864">
        <i class="mdi mdi-dots-vertical"style="font-size:32px"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown"style="background:#00b0f0">
          <a class="dropdown-item">My History</a>
          <a class="dropdown-item">Details</a>
          <a class="dropdown-item">Timing and Progress</a>
          <a class="dropdown-item">Set Target/ Wishes</a>
      </div>
    </div>
  </div>
</div>
<div class="card mt-2" style="background:none;border:none">
  <div class="row px-2">
    
  <div class="col-md-6 mt-3 mb-2 text-center bg-white p-3 rounded" style="border-right:1px solid grey">
    <b>This Month</b>
    <div class="row mt-3">
        <div class="col-md-3 text-center">
            <canvas class="my-chart"></canvas>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-6 text-end details">
            <i class="mdi mdi-chevron-up"></i><br>
            <i class="mdi mdi-chevron-down"></i>
            <ul style="list-style-type: none;">
                <span class="debit"><?= $total_sum_debit_this_month ?></span>
                <span class="credit"><?= $total_sum_credit_this_month ?></span>
            </ul>
        </div>
    </div>
</div>

<div class="col-md-6 mt-3 mb-2 text-center bg-white p-3 rounded" style="border-left:1px solid grey">
    <b>Last Month</b>
    <div class="row mt-3">
        <div class="col-md-3 text-center">
            <canvas class="my-chart2"></canvas>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-6 text-end details2">
            <i class="mdi mdi-chevron-up"></i><br>
            <i class="mdi mdi-chevron-down"></i>
            <ul style="list-style-type: none;">
                <span class="debit"><?= $total_sum_debit_last_month ?></span>
                <span class="credit"><?= $total_sum_credit_last_month ?></span>
            </ul>
        </div>
    </div>
</div>
  </div>
</div>


<script>
  // Fetch avatars from the 'avatar' folder (using placeholder logic here)
  const avatars = [
    'avatar/avatar1.png',
    'avatar/avatar2.png',
    'avatar/avatar3.png',
    'avatar/avatar4.png',
    'avatar/avatar5.png',
    'avatar/avatar6.png',
    'avatar/avatar7.png',
    'avatar/avatar8.jpg',
    'avatar/avatar9.jpg',
    'avatar/avatar10.jpg',
    'avatar/avatar11.jpg',
    'avatar/avatar12.jpg',
    'avatar/avatar13.jpg',
    'avatar/avatar14.jpg',
    'avatar/avatar15.jpg',
  ];

  // Populate avatar gallery
  const avatarGallery = document.getElementById('avatarGallery');
    avatars.forEach((avatar) => {
    const img = document.createElement('img');
    img.src = avatar;
    img.className = 'rounded-circle m-2';
    img.style = 'width: 75px; height: 75px; object-fit: cover; cursor: pointer;';
    img.alt = 'Avatar';
    img.onclick = () => {
      document.getElementById('userAvatar').src = avatar; // Update avatar preview
      saveImage(avatar, 'avatar'); // Save selected avatar
      // Close the modal automatically after selecting the avatar
      const avatarModal = new bootstrap.Modal(document.getElementById('avatarModal'));
      avatarModal.hide(); // This will close the modal
    };
    avatarGallery.appendChild(img);
  });

  // Show avatar modal
  document.getElementById('useAvatarButton').addEventListener('click', function () {
    const avatarModal = new bootstrap.Modal(document.getElementById('avatarModal'));
    avatarModal.show();
  });

  // Handle file upload
  document.getElementById('profileImageInput').addEventListener('change', function (event) {
    if (event.target.files && event.target.files[0]) {
      const reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById('userAvatar').src = e.target.result; // Update preview
        saveImage(event.target.files[0], 'upload'); // Save uploaded image
      };
      reader.readAsDataURL(event.target.files[0]);
    }
  });

  // Function to save image to the server
  function saveImage(image, type) {
    const formData = new FormData();
    formData.append('type', type);

    if (type === 'upload') {
      formData.append('profileImage', image); // File upload
    } else if (type === 'avatar') {
      formData.append('avatarPath', image); // Avatar path
    }

    fetch('imageUpload.php', {
      method: 'POST',
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert('Profile updated successfully!');
        } else {
          alert(data.message);
        }
      })
      .catch((error) => {
        console.error('Error:', error);
        //alert('Failed to save image.');
      });
  }
  
  document.addEventListener("DOMContentLoaded", function() {
    const chartData = {
        labels: ["Debit", "Credit"],
        data: [<?= json_encode($total_sum_debit_this_month) ?>, <?= json_encode($total_sum_credit_this_month) ?>],
    };
    const chartData2 = {
        labels: ["Debit", "Credit"],
        data: [<?= json_encode($total_sum_debit_last_month) ?>, <?= json_encode($total_sum_credit_last_month) ?>],
    };

    const myChart = document.querySelector(".my-chart");
    const myChart2 = document.querySelector(".my-chart2");
    const ul = document.querySelector(".details ul");
    const ul2 = document.querySelector(".details2 ul");
    const balanceUl = document.querySelector(".details2 .balance");
    const balanceUl1 = document.querySelector(".details .balance");

    if (myChart) {
        new Chart(myChart, {
            type: "doughnut",
            data: {
              labels: chartData.labels,
                datasets: [
                    {
                        label: "Financial Data",
                        data: chartData.data,
                        backgroundColor: ["#1f3864", "#00b0f0"]
                    },
                ],
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                    },
                },
            },
        });
    }

    if (myChart2) {
        new Chart(myChart2, {
            type: "doughnut",
            data: {
              labels: chartData2.labels,
                datasets: [
                    {
                        label: "Financial Data",
                        data: chartData2.data,
                        backgroundColor: ["#1f3864", "#00b0f0"]
                    },
                ],
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                    },
                },
            },
        });
    }

    const populateUl = (data, labels, ulElement) => {
        if (ulElement) {
            ulElement.innerHTML = "";
            labels.forEach((label, i) => {
                let li = document.createElement("li");
                let value = data[i];
                let color = value < 0 ? "red" : "black";
                li.innerHTML = `${label}: <span class='money' style='color: ${color};'><?= $_SESSION['LoggedInUser']['Currency']?> ${value}</span>`;
                ulElement.appendChild(li);
            });
        }
    };



    populateUl(chartData.data, chartData.labels, ul);
    populateUl(chartData2.data, chartData2.labels, ul2);
    showBalance(chartData.data);
    showBalance(chartData2.data);
  });
</script>
<?php include("includes/footer.php"); ?>
  
    
    
    
    
      
      
      
      

          
          
        

