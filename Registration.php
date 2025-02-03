<?php include("includes/loginHeader.php"); ?>


<div class="py-5 mt-4">
    <div class="container mt-4" style="background: black;opacity: 0.7;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row rounded-4 mt-4 mb-4">
                    <form id="passwordForm" action="EditCode.php" method="POST" class="text-center">
                        <div class="row">
                            <p class="mb-3" style="font-size:32px"><b style="color:#1f3864">Blue</b> <b style="color:#00b0f0">River</b>.</p>
                            <p class="text-info">Create an Account Now!!</p>
                            <div class="col-md-6 mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="username"><i class="fa fa-envelope" style="margin-right:5px"></i> First Name</label>
                                    <input type="text" name="firstname" class="form-control" placeholder="Enter First name"required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="username"><i class="fa fa-envelope" style="margin-right:5px"></i> Second Name</label>
                                    <input type="text" name="lastname" class="form-control" placeholder="Enter Second name"required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="username"><i class="fa fa-envelope" style="margin-right:5px"></i> Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="example@gmail.com"required>
                                </div>
                                <p class="text-danger">We will use this email to communite with you. Make sure you put valid email</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="username"><i class="fa fa-envelope" style="margin-right:5px"></i> Contact/phone</label>
                                    <select name="countryCode" id="countryCode" class="form-select" required>
                                        <option value="" disabled selected>--Select Country Code--</option>
                                    </select>
                                    <input type="phone" name="phoneNumber" class="form-control" maxlength="9"  placeholder="711111111" required>
                                </div>
                                <p class="text-danger">We will use this contact to communite with you. Make active contact</p>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <div class="input-group mb-3">
                                    <input type="hidden" name="currency" value="">
                                    <label class="input-group-text" for="username"><i class="fa fa-envelope" style="margin-right:5px"></i> Nationality</label>
                                    <select name="nationality" id="nationality" class="form-select" required>
                                        <option value="" disabled selected>--Select Nationality--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="username"><i class="fa fa-envelope" style="margin-right:5px"></i> Gender</label>
                                    <select name="gender" id="gender" class="form-select" required>
                                        <option value="">--Select Gender--</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="password"><i class="fa fa-envelope" style="margin-right:5px"></i> Password</label>
                                    <input type="Password" name="password" class="form-control" id="Password" placeholder="Enter Password"required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="password"><i class="fa fa-envelope" style="margin-right:5px"></i> Confirm Password</label>
                                    <input type="Password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder="Enter Retype password"required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p id="error-message" style="color: red; display: none;">Passwords do not match!</p>
                            </div>

                            <div class="col-md-6 mb-3 mx-auto">
                                <button type="submit" name="registration" class="btn w-100" style="background: #00b0f0;color: white">Join Now</button>
                            </div>
                            <p class="text-white">Already Joined Blue River! <a href="index.php">Login</a></p>
                            <p class="mt-4 text-white"style="text-align:justify">Blue River, we help you turn your finances and properties into opportunities. 
                            Whether it’s achieving your dreams or fulfilling specific needs, 
                            we guide you to unlock the full potential of your assets, 
                            creating tailored strategies to transform what you have into what you truly desire.
                        </p>
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("passwordForm").addEventListener("submit", function (e) {
        const password = document.getElementById("Password").value;
        const confirmPassword = document.getElementById("confirmPassword").value;

        // Check if passwords match
        if (password !== confirmPassword) {
            e.preventDefault(); // Prevent form submission
            const errorMessage = document.getElementById("error-message");
            errorMessage.style.display = "block"; // Show error message
        } else {
            document.getElementById("error-message").style.display = "none"; // Hide error message
        }
    });
    // Country data: African countries and others
    const countries = [
      // African countries
      { name: "Algeria", code: "+213", currency: "DZD" },
    { name: "Angola", code: "+244", currency: "AOA" },
    { name: "Benin", code: "+229", currency: "XOF" },
    { name: "Botswana", code: "+267", currency: "BWP" },
    { name: "Burkina Faso", code: "+226", currency: "XOF" },
    { name: "Burundi", code: "+257", currency: "BIF" },
    { name: "Cabo Verde", code: "+238", currency: "CVE" },
    { name: "Cameroon", code: "+237", currency: "XAF" },
    { name: "Central African Republic", code: "+236", currency: "XAF" },
    { name: "Chad", code: "+235", currency: "XAF" },
    { name: "Comoros", code: "+269", currency: "KMF" },
    { name: "Congo (Democratic Republic)", code: "+243", currency: "CDF" },
    { name: "Congo (Republic)", code: "+242", currency: "XAF" },
    { name: "Djibouti", code: "+253", currency: "DJF" },
    { name: "Egypt", code: "+20", currency: "EGP" },
    { name: "Equatorial Guinea", code: "+240", currency: "XAF" },
    { name: "Eritrea", code: "+291", currency: "ERN" },
    { name: "Eswatini", code: "+268", currency: "SZL" },
    { name: "Ethiopia", code: "+251", currency: "ETB" },
    { name: "Gabon", code: "+241", currency: "XAF" },
    { name: "Gambia", code: "+220", currency: "GMD" },
    { name: "Ghana", code: "+233", currency: "GHS" },
    { name: "Guinea", code: "+224", currency: "GNF" },
    { name: "Guinea-Bissau", code: "+245", currency: "XOF" },
    { name: "Ivory Coast (Côte d'Ivoire)", code: "+225", currency: "XOF" },
    { name: "Kenya", code: "+254", currency: "KES" },
    { name: "Lesotho", code: "+266", currency: "LSL" },
    { name: "Liberia", code: "+231", currency: "LRD" },
    { name: "Libya", code: "+218", currency: "LYD" },
    { name: "Madagascar", code: "+261", currency: "MGA" },
    { name: "Malawi", code: "+265", currency: "MWK" },
    { name: "Mali", code: "+223", currency: "XOF" },
    { name: "Mauritania", code: "+222", currency: "MRU" },
    { name: "Mauritius", code: "+230", currency: "MUR" },
    { name: "Morocco", code: "+212", currency: "MAD" },
    { name: "Mozambique", code: "+258", currency: "MZN" },
    { name: "Namibia", code: "+264", currency: "NAD" },
    { name: "Niger", code: "+227", currency: "XOF" },
    { name: "Nigeria", code: "+234", currency: "NGN" },
    { name: "Rwanda", code: "+250", currency: "RWF" },
    { name: "Sao Tome and Principe", code: "+239", currency: "STN" },
    { name: "Senegal", code: "+221", currency: "XOF" },
    { name: "Seychelles", code: "+248", currency: "SCR" },
    { name: "Sierra Leone", code: "+232", currency: "SLL" },
    { name: "Somalia", code: "+252", currency: "SOS" },
    { name: "South Africa", code: "+27", currency: "ZAR" },
    { name: "South Sudan", code: "+211", currency: "SSP" },
    { name: "Sudan", code: "+249", currency: "SDG" },
    { name: "Tanzania", code: "+255", currency: "TZS" },
    { name: "Togo", code: "+228", currency: "XOF" },
    { name: "Tunisia", code: "+216", currency: "TND" },
    { name: "Uganda", code: "+256", currency: "UGX" },
    { name: "Zambia", code: "+260", currency: "ZMW" },
    { name: "Zimbabwe", code: "+263", currency: "ZWL" },
    { name: "United States", code: "+1", currency: "USD" },
    { name: "United Kingdom", code: "+44", currency: "GBP" },
    { name: "India", code: "+91", currency: "INR" },
    { name: "China", code: "+86", currency: "CNY" },
    { name: "Germany", code: "+49", currency: "EUR" },
    { name: "France", code: "+33", currency: "EUR" },
    { name: "Japan", code: "+81", currency: "JPY" },
    { name: "Canada", code: "+1", currency: "CAD" }
    ];

    // Populate the dropdown
    const select = document.getElementById("countryCode");
    const select2 = document.getElementById("nationality");
    const currencyInput = document.querySelector("input[name='currency']");

    countries.forEach(country => {
      const option = document.createElement("option");
      option.value = country.code; // Country code as value
      option.textContent = `${country.name} (${country.code})`; // Display name and code
      select.appendChild(option);
    });
    // countries.forEach(country => {
    //     const option = document.createElement("option");
    //     option.value = country.name; // Nationality value
    //     option.textContent = country.name; // Display the country name
    //     select2.appendChild(option);
    // });
    // // Update currency when nationality is selected
    // nationalitySelect.addEventListener("change", function() {
    // const selectedCountry = countries.find(country => country.name === this.value);
    // if (selectedCountry) {
    //     currencyInput.value = selectedCountry.currency;
    // }
    // });
    document.addEventListener("DOMContentLoaded", () => {
    const nationalitySelect = document.getElementById("nationality");
    const currencyInput = document.querySelector("input[name='currency']");

    countries.forEach(country => {
        const option = document.createElement("option");
        option.value = country.name;
        option.textContent = country.name;
        nationalitySelect.appendChild(option);
    });

    nationalitySelect.addEventListener("change", () => {
        const selectedCountry = countries.find(c => c.name === nationalitySelect.value);
        if (selectedCountry) {
            currencyInput.value = selectedCountry.currency;
        } else {
            currencyInput.value = "";
        }
    });
});
</script>
<?php include("includes/loginFooter.php"); ?>
