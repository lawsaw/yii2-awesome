<div
        class="modalAwesome modalAwesome--<?= $modal ? $modal : '' ?>"
        data-awesome-modal="<?= $modal ? $modal : '' ?>"
        data-awesome-modal-mode="<?= $mode ? $mode : '' ?>"
        data-awesome-modal-ajax="<?= $ajax ? 'true' : 'false' ?>"
>
    <div class="modalAwesome-work <?= $workClass ? $workClass : '' ?>">
        <div class="modalAwesome-win modalAwesome-anim-in-<?= $animIn ? $animIn : '' ?> modalAwesome-anim-out-<?= $animOut ? $animOut : '' ?>">
            <?= $message != 'false' ? $message : $this->render("@frontend/views/modals/".$contentView , $contentData) ?>
        </div>
    </div>
    <div class="modalAwesome-bg awModalClose"></div>
</div>
