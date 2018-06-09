<?php

use yii\helpers\Html;
use lawsaw\widgets\Button;

?>

<div class="dropdownAwesome <?= $container['className'] ? $container['className'] : '' ?>">

    <?= Button::widget([
        'className' => 'dropdownAwesome-front',
        'classText' => 'dropdownAwesome-front-value',
        'classTitle' => 'dropdownAwesome-front-title',
        'classContent' => 'dropdownAwesome-front-link',
        'theme' => $front['theme'] ? $front['theme'] : '',
        'size' => $front['size'] ? $front['size'] : '',
        'href' => '#',
        'label' => $front['current'] ? $front['current'] : '',
        'iconBeforeClass' => 'dropdownAwesome-front-icon dropdownAwesome-front-icon--before',
        'iconAfterClass' => 'dropdownAwesome-front-icon dropdownAwesome-front-icon--after',
        'iconBefore' => $front['iconBefore'] ? $front['iconBefore'] : '',
        'iconAfter' => $front['iconAfter'] ? $front['iconAfter'] : '',
    ]); ?>

    <div class="dropdownAwesome-back <?= $back['theme'] ? 'dropdownAwesome-back--'.$back['theme'] : '' ?> <?= $back['biasLeft'] ? 'dropdownAwesome-back--biasLeft' : '' ?> <?= $back['biasRight'] ? 'dropdownAwesome-back--biasRight' : '' ?>">

        <?php if($back['content']) { ?>

            <?php if(is_array($back['content'])) { ?>

                <ul class="dropdownAwesome-back-list">

                    <?php for($i=0; $i<count($back['content']); $i++) { ?>

                        <li class="dropdownAwesome-back-list-item">

                            <?= Html::a(
                                $back['content'][$i]['title'],
                                $back['content'][$i]['link'],
                                ['class' => 'dropdownAwesome-back-list-item-link']
                            ) ?>

                        </li>

                    <?php } ?>

                </ul>

            <?php } else { ?>

                <?= $back['content'] ?>

            <?php } ?>

        <?php } ?>

    </div>

</div>