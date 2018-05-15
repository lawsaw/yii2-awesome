<?php
use lawsaw\widgets\Svg;
?>


<div class="buttonAwesome <?= $size ? 'buttonAwesome--'.$size : '' ?> <?= $theme ? 'buttonAwesome--'.$theme : '' ?> <?= $className ? $className : '' ?>">



    <<?= $href ? 'a href="'.$href.'"' : 'div' ?>
    class="buttonAwesome-content <?= $classContent ? $classContent : '' ?>"

    <?= isset($modal) ? isset($modal['id']) ? 'data-awesome-modal="'.$modal['id'].'"' : '' : '' ?>
    <?= isset($modal) ? isset($modal['mode']) ? 'data-awesome-modal-mode="'.$modal['mode'].'"' : '' : '' ?>
    <?= isset($modal) ? isset($modal['anim']) ? isset($modal['anim']['in']) ? 'data-awesome-modal-anim-in="'.$modal['anim']['in'].'"' : '' : '' : '' ?>
    <?= isset($modal) ? isset($modal['anim']) ? isset($modal['anim']['out']) ? 'data-awesome-modal-anim-out="'.$modal['anim']['out'].'"' : '' : '' : '' ?>
    <?= isset($modal) ? isset($modal['workClass']) ? 'data-awesome-modal-workClass="'.$modal['workClass'].'"' : '' : '' ?>
    <?= isset($modal) ? isset($modal['winClass']) ? 'data-awesome-modal-winClass="'.$modal['winClass'].'"' : '' : '' ?>
    <?= isset($modal) ? isset($modal['layout']) ? 'data-awesome-modal-layout="'.$modal['layout'].'"' : '' : '' ?>
    <?= isset($modal) ? isset($modal['model']) ? 'data-awesome-modal-model="'.$modal['model'].'"' : '' : '' ?>

    <?= isset($onclick) ? 'onclick='.$onclick : '' ?>



    >





    <?php
    if($iconBefore) {
        ?>
        <div class="buttonAwesome-icon buttonAwesome-icon--before <?= $iconBeforeClass ? $iconBeforeClass : '' ?>">
            <?php
            switch($iconBefore['type']) {
                case 'img':
                    ?>
                    <img src="<?= $iconBefore['value'] ?>" />
                    <?php
                    break;
                case 'svg':
                    echo Svg::widget([
                        'icon' => $iconBefore['value'],
                        'className' => 'test-name',
                    ]);
                    break;
                case 'fa':
                    ?>
                    <i class="fa <?= $iconBefore['value'] ?>"></i>
                    <?php
                    break;
                case 'block':
                    ?>
                    <div class="buttonAwesome-icon-image <?= $iconBefore['value'] ?>"></div>
                    <?php
                    break;
                    ?>
                    <?php
            }
            ?>
        </div>
        <?php
    }
    ?>



    <?php
    if($label) {
        ?>
        <div class="buttonAwesome-title <?= $classTitle ? $classTitle : '' ?>">
            <div class="buttonAwesome-text <?= $classText ? $classText : '' ?>">
                <?= $label ?>
            </div>
        </div>
        <?php
    }
    ?>



    <?php
    if($iconAfter) {
        ?>
        <div class="buttonAwesome-icon buttonAwesome-icon--after <?= $iconAfterClass ? $iconAfterClass : '' ?>">
            <?php
            switch($iconAfter['type']) {
                case 'img':
                    ?>
                    <img src="<?= $iconAfter['value'] ?>" />
                    <?php
                    break;
                case 'svg':
                    echo Svg::widget([
                        'icon' => $iconAfter['value'],
                        'className' => 'test-name',
                    ]);
                    break;
                case 'fa':
                    ?>
                    <i class="fa <?= $iconAfter['value'] ?>"></i>
                    <?php
                    break;
                case 'block':
                    ?>
                    <div class="buttonAwesome-icon-image <?= $iconAfter['value'] ?>"></div>
                    <?php
                    break;
                    ?>
                    <?php
            }
            ?>
        </div>
        <?php
    }
    ?>



</<?= $href ? 'a' : 'div' ?>>



</div>
