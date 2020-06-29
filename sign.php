<?php
require_once 'core/load.php';
require_once 'connect/Login.php';
if(Login::isLogginedIn()) header('Location:profile.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['first-name']) && !empty($_POST['first-name'])) {
    if (isset($_POST['last-name']) && !empty($_POST['last-name'])
        && isset($_POST['email-mobile']) && !empty($_POST['email-mobile'])
        && isset($_POST['up-password']) && !empty($_POST['up-password'])
        && isset($_POST['birth-day']) && isset($_POST['birth-month'])
        && isset($_POST['birth-year']) && isset($_POST['gen'])
        && !empty($_POST['gen'])) {
        $firstName = $loadFromUser->checkInput($_POST['first-name']);
        $lastName = $loadFromUser->checkInput($_POST['last-name']);
        $email = filter_var($loadFromUser->checkInput($_POST['email-mobile']), FILTER_SANITIZE_EMAIL);
        $password = $loadFromUser->checkInput($_POST['up-password']);
        $day = $_POST['birth-day'];
        $month = $_POST['birth-month'];
        $year = $_POST['birth-year'];
        $birthday = $loadFromUser->checkInput($year . '-' . $month . '-' . $day);
        $screenName = $firstName . '_' . $lastName;
        $gender = $_POST['gen'];
        if (DB::query('SELECT screenName FROM users WHERE screenName = :screenName', array(':screenName' => $screenName))) {
            $screenRand = rand();
            $userLink = $screenName . $screenRand;
        } else $userLink = $screenName;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $error = "Invalid email Format";
        elseif (strlen($firstName) > 20) $error = "Name must be no more than 20 characters";
        elseif (strlen($password) < 5 || strlen($password) > 60) $error = "Password is too short or long";
        else {
            if ($loadFromUser->checkEmail($email) === true) $error = "Email is already in user";
            else {
                $userId = $loadFromUser->create('users',
                    array('first_name' => $firstName, 'last_name' => $lastName, 'email' => $email,
                        'password' => password_hash($password, PASSWORD_BCRYPT),
                        'screenName' => $screenName, 'userLink' => $userLink, 'birthday' => $birthday, 'gender' => $gender));

                $loadFromUser->create('profile',
                    array('user_id'=>$userId,'birthday'=>$birthday,'firstName' => $firstName, 'lastName' => $lastName,'profilePic'=>'assets/image/defaultProfile.png','coverPic'=>'assets/image/defaultCover.png','gender'=>$gender));

                $tstrong = true;
                $token = bin2hex(openssl_random_pseudo_bytes(64, $tsrong));
                $loadFromUser->create('token', array('token' => sha1($token), 'user_id' => $userId));
                setcookie('FBID', $token, time() + 60 * 60 * 24 * 7);
                header('Location: profile.php');
            }
        }
    } else {
        $error = "All fields are required";
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['in-email-mobile']) && !empty($_POST['in-email-mobile'])){
    if(isset($_POST['in-pass']) && !empty($_POST['in-pass'])){
        $login = $_POST['in-email-mobile'];
        $password = $_POST['in-pass'];
        if(DB::query('SELECT email FROM users WHERE email = :email',array(':email'=>$login))){
            if(password_verify($password,DB::query('SELECT password FROM users WHERE email = :email',array('email'=>$login))[0]['password'])){
                $userId = DB::query('SELECT user_id FROM users WHERE email = :email',array('email'=>$login))[0]['user_id'];

                $tstrong = true;
                $token = bin2hex(openssl_random_pseudo_bytes(64, $tsrong));
                $loadFromUser->update('token',$userId,array('token' =>sha1($token)));
                setcookie('FBID', $token, time() + 60 * 60 * 24 * 7);
                header('Location: profile.php');
            }else{
                $error = "Password is not correct";
            }
        }else{
            $error = "User has not found";
        }
    }else{
        $error = "Login and Password are required";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Facebook</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
<div class="header">
    <div class="logo">Facebook</div>
    <form action="sign.php" method="post">
        <div class="sign-in-form">
            <div class="mobile-input">
                <div class="input-text">Email or Phone</div>
                <input type="text" name="in-email-mobile" id="email-mobile" class="input-text-field" placeholder="Email or Number">
            </div>
            <div class="password-input">
                <div style = "font-size: 12px;padding-bottom: 5px;">Password</div>
                <input type="password" name="in-pass" id="in-password" class="input-text-field" placeholder="Password">
                <div class="forgotten-acc">Forgotten account</div>
            </div>
            <div class="login-button">
                <input type="submit" value="Log in" class="sign-in login">
            </div>
        </div>
    </form>
</div>

<div class="main">
    <div class="left-side">
        <img src="./assets/image/facebook-signin.png" alt="Img">
    </div>
    <div class="right-side">
        <div class="error">
            <?php if ($error) {echo $error;} ?>
        </div>
        <h1 style="color:#212121;">Create an account</h1>
        <div style="color:#212121;font-size:20px;">It is free and always will be</div>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="user-sign-up">
            <div class="sign-up-form">
                <div class="sign-up-name">
                    <input type="text" name="first-name" id="first-name" class="text-field" placeholder="First Name"/>
                    <input type="text" name="last-name" id="last-name" class="text-field" placeholder="Last Name"/>
                </div>
                <div class="sign-wrap-mobile">
                    <input type="text" name="email-mobile" id="up-email" placeholder="Mobile number or email address"
                           class="text-input">
                </div>
                <div class="sign-up-password">
                    <input type="password" name="up-password" id="up-password" class="text-input"
                           placeholder="Password">
                </div>
                <div class="sign-up-birthday">
                    <div class="bday">Birthday</div>
                    <div class="form-birthday">
                        <select name="birth-day" id="days" class="select-body"></select>
                        <select name="birth-month" id="months" class="select-body"></select>
                        <select name="birth-year" id="years" class="select-body"></select>
                    </div>
                </div>
                <div class="gender-wrap">
                    <input type="radio" name="gen" id="fem" value="female" class="m0">
                    <label for="fen" class="gender">Female</label>
                    <input type="radio" name="gen" id="male" value="male" class="m0">
                    <label for="male" class="gender">Male</label>
                </div>
                <div class="term">
                    By clicking Sign Up,you agree to our terms, Data policy and Cookie policy.You may receive SMS
                    notifications from us and can opt out at any time.
                </div>
                <input type="submit" value="Sign Up" class="sign-up">
            </div>
        </form>
    </div>
</div>
<script src="assets/js/signup.js"></script>
</body>

</html>