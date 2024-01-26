<?php
require_once "header.php";
require_once "services.php";

global $conn;

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $output = create_account($_POST["email"], $_POST["password"]);
    $alert = get_alert($output, "Compte créé!", "L'email est déjà utilisé!");
    var_dump($alert);
    var_dump("prout");
    if ($output == "True\n") {
        header("Location: login.php");
    } else {
        header("Location: register.php");
    }
}
?>

<form method="POST" class="flex flex-col w-[25rem] p-[2.5rem] mx-auto mt-40 bg-white rounded-3xl shadow-lg">
    <h1 class="text-3xl text-center">Création de compte</h1>
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
    <input class="btn mt-8 w-full max-w-xs" type="submit" value="Créer un compte"/>
    <?php
    if (isset($alert)) {
        echo $alert;
    }
    ?>
</form>

<?php
require_once "footer.php";
?>