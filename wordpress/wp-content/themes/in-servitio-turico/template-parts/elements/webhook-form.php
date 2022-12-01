<div class="ist-webhook-form-wrapper" data-formdata="{}">
    <?php
    use Ramsey\Uuid\Uuid;

    $formid = Uuid::uuid4()->toString();
    $config = get_template_directory(  ) . "/config/" . $args["config"] . ".json";
    $config = json_decode( file_get_contents( $config ), true );

    $i = 0;
    foreach ($config["steps"] as $id => $step) :
    unset($title);
    unset($text);
    if (isset($step["title"])) {
        $title = "echo(" . $step["title"] . ");";
    }
    if (isset($step["text"])) {
        $text = "echo(" . $step["text"] . ");";
    }
    ?>
        <div class="ist-webhookform-step" data-step-id="<?=$formid?>-<?= $id ?>"<?= ($i > 0) ? " hidden" : ""?> data-step-type="<?= $step["type"] ?>">
        <?php
        if ($step["type"] == "form") :
        ?>
            <form class="ist-webhookform-form flex flex-wrap gap-x-6 gap-y-5" action="<?= $config["wh-url"] ?>" method="<?= $config["wh-method"] ?>">
            <?php
            foreach ($step["fields"] as $name => $field) :
                ?>
                <div class="ist-input-wrapper <?= $field["type"] ?><?= (isset($field["fullwidth"])) ? " fullwidth" : "" ?>">
                    <?php
                    if ($field["type"] == "checkbox") :
                    ?>
                    <input type="checkbox" hidden name="<?= $name ?>" id="<?= $name ?>-<?=$formid?>" class="<?= $name ?>" <?= (isset($field["checked"]) && $field["checked"] == true) ? " checked" : "" ?> >
                    <label for="<?= $name ?>-<?=$formid?>" class="block leading-tight"><?= $field["label"] ?></label>
                    <?php
                    elseif ($field["type"] == "textarea") :
                    ?>
                    <label for="<?= $name ?>-<?=$formid?>" class="text-xl"><?= $field["label"] ?></label>
                    <textarea name="<?= $name ?>" class="ist-textarea-autosize" id="<?= $name ?>-<?=$formid?>"<?= (isset($field["class"])) ? " class='{$field["class"]}'" : "" ?>></textarea>
                    <?php
                    else:
                    ?>
                    <label for="<?= $name ?>-<?=$formid?>" class="text-xl"><?= $field["label"] ?></label>
                    <input type="<?= $field["type"]?>" name="<?= $name ?>" id="<?= $name ?>-<?=$formid?>"<?= (isset($field["class"])) ? " class='{$field["class"]}'" : "" ?><?= (isset($field["required"])) ? " required" : "" ?>>
                    <?php
                    endif;
                    ?>
                </div>
                <?php
            endforeach;
            ?>
            <div class="ist-input-wrapper fullwidth flex">
                <button type="submit" class="ist-button ist-button-arrow ml-auto"><?= $step["submit"] ?></button>
            </div>
            </form>
        <?php
        elseif ($step["type"] == "select") :
        ?>
        <div class="ist-webhookform-select-wrapper">
            <div class="ist-webhookform-selection flex gap-6 mt-4" data-selection-id="<?= $step["selection"]["id"]?>">
            <?php
            foreach ($step["selection"]["choices"] as $key => $choice) :
            ?>
                <a href="#" class="ist-input-wrapper ist-button ist-webhookform-choice" <?= (isset($choice["mtag"])) ? " data-mtag='{$choice["mtag"]}'" : "" ?> data-value="<?= $key ?>"><?= $choice["label"] ?></a>
                <?php
            endforeach;
            ?>
            </div>
        </div>
        <?php
        elseif ($step["type"] == "redirect") :
            if (isset($step["params"])) {
                $params = json_encode($step["params"]);
            }
        ?>
        <div class="ist-webhookform-redirect" data-url="<?= $step["url"] ?>" data-target="<?= $step["target"] ?>" data-next="<?= $step["next"] ?>"<?= (isset($params)) ? " data-url-params='{$params}'" : "" ?>><em>Redirecting...</em></div>
        <?php
        elseif ($step["type"] == "thanksInterface") :
        ?>
        <div class="flex flex-wrap gap-2 mt-2 share-buttons" data-sharetext="<?= $step["sharetext"] ?>">
            <div class="ButtonWrapper">
                <a data-type="whatsapp" href="#" class="ist-button">Auf WhatsApp teilen</a>
            </div>
            <div class="ButtonWrapper">
                <a data-type="telegram" href="#" class="ist-button">Auf Telegram teilen</a>
            </div>
            <div class="ButtonWrapper">
                <a data-type="facebook" href="#" class="ist-button" >Auf Facebook teilen</a>
            </div>
            <div class="ButtonWrapper">
                <a data-type="email" href="#" class="ist-button ist-button-neg ist-button-line">Per Mail teilen</a>
            </div>
        </div>
        <?php
        endif;
        ?>
        </div>
    <?php
    $i++;
    endforeach;
    ?>
    <div class="ist-webhookform-step" data-step-id="<?=$formid?>-<?= $id ?>"<?= ($i > 0) ? " hidden" : ""?> data-step-type="thanksInterface">
        <p class="font-bold"><?= $config["thanksInterface"]["text"]?></p>
    </div>
</div>