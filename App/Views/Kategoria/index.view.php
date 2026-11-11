<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Kategoria[] $kategorie */
?>
<div class="toolbar">
    <h2>Kategórie</h2>
    <a href="<?= $link->url('kategoria.pridat') ?>" class="add-btn">+ Pridať kategóriu</a>
</div>

<p class="count">Počet kategórií: <?= count($kategorie) ?></p>

<div class="my-list">
    <?php foreach ($kategorie as $kategoria) { ?>
        <article class="kat-item">
            <div>
                <h3><?= e($kategoria->nazov) ?></h3>
                <p class="meta">Počet inzerátov: <?= count($kategoria->getAllRelated(\App\Models\Inzerat::class)) ?></p>
            </div>
            <div class="my-actions">
                <a href="<?= $link->url('kategoria.upravit', ['id' => $kategoria->id]) ?>" class="btn">Upraviť</a>
                <form method="post" action="<?= $link->url('kategoria.vymazat') ?>"
                      onsubmit="return confirm('Naozaj chcete vymazať túto kategóriu? Inzeráty zostanú bez kategórie.');">
                    <input type="hidden" name="id" value="<?= e($kategoria->id) ?>">
                    <button type="submit" class="btn btn-danger">Vymazať</button>
                </form>
            </div>
        </article>
    <?php } ?>
</div>