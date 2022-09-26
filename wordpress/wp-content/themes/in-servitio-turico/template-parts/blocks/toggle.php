<details class="ist-toggle-details mt-4 text-start"<?= (get_field("default_setting")) ? " open" : "" ?>>
    <summary class="ist-toggle-summary ist-akrobat text-xl flex justify-between leading-none">
        <span class="ist-toggle-title"><?= get_field("title") ?></span>
        <div class="ist-toggle-icon text-center"><i data-feather="chevron-down"></i></div>
    </summary>
    <div class="ist-toggle-content mt-4">
        <?= get_field("content") ?>
    </div>
</details>