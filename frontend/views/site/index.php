<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
$this->registerJsFile('@web/js/index.js', ['depends' => [\frontend\assets\AppAsset::class]]);
?>
<div class="site-index">
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col">
                <img id="random-image" src="" alt="random image">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <button class="btn btn-primary" id="approve-btn">одобрить</button>
                <button class="btn btn-danger" id="reject-btn">отклонить</button>
            </div>
        </div>
    </div>
</div>
