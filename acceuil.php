<?php
require_once "header.php";
require_once "services.php";

if (isset($_POST['sell-1'])) {
    $output = shell_exec($python . ' py_redis.py sell ' . $_SESSION["user_id"] . ' 1');
    $alert = get_alert($output, "Vente validée!", "Vous n'avez pas assez de cahiers!");
} elseif (isset($_POST['buy-1'])) {
    $output = shell_exec($python . ' py_redis.py buy ' . $_SESSION["user_id"] . ' 1');
    $alert = get_alert($output, "Achat validé!", "L'article n'est pas en stock");
} elseif (isset($_POST['sell-2'])) {
    $output = shell_exec($python . ' py_redis.py sell ' . $_SESSION["user_id"] . ' 2');
    $alert = get_alert($output, "Vente validée!", "Vous n'avez pas assez de cahiers!");
} elseif (isset($_POST['buy-2'])) {
    $output = shell_exec($python . ' py_redis.py buy ' . $_SESSION["user_id"] . ' 2');
    $alert = get_alert($output, "Achat validé!", "L'article n'est pas en stock");
} 
?>

<form method="post" class="w-[80%] max-w-[1000px] flex m-auto justify-between flex-wrap mt-20">
    <div class="card w-96 bg-base-100 shadow-xl rounded-3xl">
        <figure><img src="https://content-management-files.canva.com/cdn-cgi/image/f=auto,q=70/d1d3393c-bea0-47dc-a655-d7eb46a10670/header_Notebooks2.jpg" alt="Shoes" /></figure>
        <div class="card-body">
            <h2 class="card-title">Cahier</h2>
            <p>Oh le beau cahier</p>
            <?php if (isset($_SESSION["user_id"])): ?>
            <div class="card-actions justify-end">
                <input type="submit" name="buy-1" value="Acheter" class="btn btn-primary"/>
                <input type="submit" name="sell-1" value="Vendre" class="btn btn-primary"/>
            </div>
            <?php
            endif;
            if ((isset($alert)) && (isset($_POST['sell-1']) || isset($_POST['buy-1']))) {
                echo $alert;
            }
            ?>
        </div>
    </div>
    <div class="card w-96 bg-base-100 shadow-xl rounded-3xl">
        <figure><img src="https://la-boutique-du-stylo.com/ART/porsche/p3140/stylo-bille-p3140-torsade-porsche-1.jpg" alt="Shoes" /></figure>
        <div class="card-body">
            <h2 class="card-title">Stylo</h2>
            <p>Oh le beau stylo</p>
            <?php if (isset($_SESSION["user_id"])): ?>
            <div class="card-actions justify-end">
                <input type="submit" name="buy-2" value="Acheter" class="btn btn-primary"/>
                <input type="submit" name="sell-2" value="Vendre" class="btn btn-primary"/>
            </div>
            <?php
            endif;
            if ((isset($alert)) && (isset($_POST['sell-2']) || isset($_POST['buy-2']))) {
                echo $alert;
            }
            ?>
        </div>
    </div>
</form>

<?php
require_once "footer.php";
?>