<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Inzerat $inzerat */
/** @var \App\Models\Kategoria[] $kategorie */
/** @var string|null $chyba */

$jeNovy = $inzerat->id === null;
$akcia = $jeNovy
    ? $link->url('inzerat.pridat')
    : $link->url('inzerat.upravit', ['id' => $inzerat->id]);
?>
<div class="toolbar">
    <h2><?= $jeNovy ? 'Pridať inzerát' : 'Upraviť inzerát' ?></h2>
</div>

<form class="form-card" method="post" action="<?= $akcia ?>">
    <?php if ($chyba !== null) { ?>
        <p class="chyba"><?= e($chyba) ?></p>
    <?php } ?>

    <label for="nazov">Názov</label>
    <input type="text" id="nazov" name="nazov" maxlength="100" value="<?= e($inzerat->nazov) ?>" required>

    <label for="popis">Popis</label>
    <textarea id="popis" name="popis" rows="5"><?= e($inzerat->popis) ?></textarea>

    <label for="cena">Cena (€)</label>
    <input type="number" id="cena" name="cena" min="0.01" max="1000000" step="0.01" value="<?= e($inzerat->cena) ?>" required>

    <label for="mesto">Mesto</label>
    <input type="text" id="mesto" name="mesto" maxlength="60" value="<?= e($inzerat->mesto) ?>" required>

    <label for="kategoriaId">Kategória</label>
    <select id="kategoriaId" name="kategoriaId" required>
        <option value="" disabled <?= $inzerat->kategoriaId === null ? 'selected' : '' ?>>— vyber kategóriu —</option>
        <?php foreach ($kategorie as $kategoria) { ?>
            <option value="<?= e($kategoria->id) ?>"
                <?= (string)$inzerat->kategoriaId === (string)$kategoria->id ? 'selected' : '' ?>>
                <?= e($kategoria->nazov) ?>
            </option>
        <?php } ?>
    </select>

    <?php if (!$jeNovy) { ?>
        <label for="stav">Stav</label>
        <select id="stav" name="stav">
            <option value="aktivny" <?= $inzerat->stav === 'aktivny' ? 'selected' : '' ?>>aktívny</option>
            <option value="ukonceny" <?= $inzerat->stav === 'ukonceny' ? 'selected' : '' ?>>ukončený</option>
        </select>
    <?php } ?>

    <button type="submit" class="btn btn-primary">Uložiť</button>
    <a href="<?= $link->url('inzerat.zobrazit') ?>" class="btn">Zrušiť</a>
</form>