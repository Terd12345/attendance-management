<?php

class view extends model {

    public function LoginDisplay($errorMessage = "") {
    echo '
    <link rel="stylesheet" href="assets/css/login.css" />
    <div class="header">
        <img src="" alt="" class="logo" />
        <h1>ATTENDANCE MANAGEMENT SYSTEM</h1>
    </div>

    <div class="login-container">
        <div class="login-box">
            <h2>Log in</h2> ';

            if (!empty($errorMessage)) {
                echo "<p style='color: red; text-align: center;'>" . htmlspecialchars($errorMessage) . "</p>";
            }

            echo '
            <form method="POST" action="index.php">
                <div class="input-group">
                    <span class="input-icon"><i class="fas fa-user"></i></span>
                    <input type="email" name="email" placeholder="Email Address" required />
                </div>

                <div class="input-group">
                    <span class="input-icon"><i class="fa fa-lock"></i></span>
                    <input type="password" name="password" placeholder="Password" required />
                </div>

                <button type="submit" class="login-btn" name="login">Log in</button>
            </form>
            <br>
            <div class="signup-link">
                or <a href="register.php">Sign Up</a>
            </div>
        </div>
    </div>
    ';
}


    public function SignupDisplay($message = "") {
        echo '
        <link rel="stylesheet" href="assets/css/signup.css" />
    
        <header>
            <!--<img src="logo.png" alt="School Logo" />-->
            <h1>ATTENDANCE MANAGEMENT SYSTEM</h1>
        </header>
    
        <div class="signup-container">
            <h2>Sign up</h2>';

            if (!empty($message)) {
                echo "<p style='color: green; text-align: center;'>" . htmlspecialchars($message) . "</p>";
            }

            
            echo '
            <form method="POST" action="register.php">

                <div class="input-group">
                    <i class="fas fa-user-tag"></i>
                    <select name="role" required>
                        <option value="" disabled selected>Select Role</option>
                        <option value="Cashier">Cashier</option>
                        <option value="Accountant">Accountant</option>
                        <option value="Data Encoder">Data Encoder</option>
                    </select>
                </div>

                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="full_name" placeholder="Full Name" required />
                </div>
    
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email Address" required />
                </div>
    
                <div class="double-group">
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required />
                    </div>
                </div>
    
                <button type="submit" name="signup">Create Account</button>
            </form>
    
            <div class="login-link">
                or <a href="index.php">Log in</a>
            </div>
        </div>
        ';
    }

}