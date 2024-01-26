<?php
require_once "header.php";

global $conn;

if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["submit-login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM USERS WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {        
        $row = mysqli_fetch_assoc($result);
        $_SESSION["user_id"] = $row["id"];

        $output = shell_exec('/Library/Frameworks/Python.framework/Versions/3.11/bin/python3 py_redis.py connect ' . $row["id"]);
        if ($output == "True\n") {
            header("Location: acceuil.php");
        } else {
            $errorAlert = '
            <div role="alert" class="alert alert-error mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Trop de connexions en 10 minutes. Veuillez patienter.</span>
            </div>';
        }
    } else {
        $errorAlert = '
            <div role="alert" class="alert alert-error mt-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>Connexion échouée</span>
            </div>
        ';
    }
}
?>

<form method="POST" class="flex flex-col w-[25rem] p-[2.5rem] mx-auto mt-40 bg-white rounded-3xl shadow-lg">
    <h1 class="text-3xl text-center">Connexion</h1>
    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Email</span>
        </div>
        <input placeholder="Type here" class="input input-bordered w-full max-w-xs" type="text" id="email" name="email" required />
    </label>
    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Mot de passe</span>
        </div>
        <input placeholder="Type here" class="input input-bordered w-full max-w-xs" type="password" id="password" name="password" required />
    </label>
    <input class="btn mt-8 w-full max-w-xs" type="submit" value="Se connecter" name="submit-login"/>
    <?php
    if (isset($errorAlert)) {
        echo $errorAlert;
    }
    ?>
</form>

<?php
require_once "footer.php";
?>