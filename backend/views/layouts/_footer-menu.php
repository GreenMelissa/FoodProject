<?php

use yii\helpers\Url;

?>

<footer>
    <div class="container py-5">
        <div class="row">
            <div class="col-12 col-md">
                <a class="navbar-brand" href="<?= Url::home() ?>"><h3><?= h(Yii::$app->name) ?></h3></a>
                <small class="d-block mb-3 text-muted">© 2018</small>
            </div>
        </div>
    </div>
</footer>