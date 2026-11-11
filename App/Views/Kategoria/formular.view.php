<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Kategoria $kategoria */
/** @var string|null $chyba */

$jeNova = $kategoria->id === null;
$akcia = $jeNova
    ? $link->url('kategoria.pridat')
    : $link->url('kategoria.upravit', ['id' => $kategoria->id]);
?>
<div class="toolbar">
    <h2><?= $jeNova ? 'Pridať kategóriu' : 'Upraviť kategóriu' ?></h2>
</div>

<form class="form-card" method="post" action="<?= $akcia ?>">
    <?php if ($chyba !== null) { ?>
        <p class="chyba"><?= e($chyba) ?></p>
    <?php } ?>

    <label for="nazov">Názov</label>
    <input type="text" id="nazov" name="nazov" maxlength="50" value="<?= e($kategoria->nazov) ?>" required>

    <button type="submit" class="btn btn-primary">Uložiť</button>
    <a href="<?= $link->url('kategoria.index') ?>" class="btn">Zrušiť</a>
</form>