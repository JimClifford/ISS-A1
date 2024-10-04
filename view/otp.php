<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Input Form</title>
    
    <!-- CSS for formatting the form -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        
        .container {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-size: 14px;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #45a049;
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #399640;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>

    <!-- JavaScript for form validation -->
    <script>
        function validateOTP() {
            var otp = document.getElementById("otp").value;

            // Clear previous error message
            document.getElementById("error").innerHTML = "";

            // Ensure the OTP contains only numbers and is exactly 6 digits
            if (!/^\d{6}$/.test(otp)) {
                document.getElementById("error").innerHTML = "Please enter a valid 6-digit OTP.";
                return false;
            }
            return true; // Allow form submission
        }
    </script>
</head>
<body>
    
    <div class="container">
        <h2>Enter Your OTP</h2>
        
        <form action="../actions/otp_action.php" method="POST" onsubmit="return validateOTP();">
            <label for="otp">Enter the OTP sent to your email here:</label>
            <input type="text" id="otp" name="otp" maxlength="6" placeholder="Enter 6-digit OTP" required>

            <div class="error" id="error"></div>

            <input type="submit" value="Submit">
        </form>
    </div>


</body>
</html>
