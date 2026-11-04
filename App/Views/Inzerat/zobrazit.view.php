<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Inzerat[] $inzeraty */
?>
<div class="toolbar">
    <h2>Moje inzeráty</h2>
    <a href="<?= $link->url('inzerat.pridat') ?>" class="add-btn">+ Pridať inzerát</a>
</div>

<p class="count">Počet inzerátov: <?= count($inzeraty) ?></p>

<div class="moje-inzeraty">
    <?php foreach ($inzeraty as $inzerat) {?>
        <article class="my-item">
            <div class="my-img">obrázok inzerátu</div>
            <div class="my-info">
                <h3><?=  e($inzerat->nazov) ?></h3>
                <p class="cena"><?=  e($inzerat->cena) ?> €</p>
                <p class="meta">
                    <?=  e($inzerat->mesto) ?> &bull;
                    Pridané: <?=  e(date('d.m.Y', strtotime($inzerat->datum))) ?> &bull;
                    Stav: <?=  e($inzerat->stav) ?>
                </p>
            </div>
            <div class="my-actions">
                <a href="<?= $link->url('inzerat.upravit', ['id' => $inzerat->id]) ?>" class="btn">Upraviť</a>
                <form method="post" action="<?= $link->url('inzerat.vymazat') ?>"
                        onsubmit="return confirm('Naozaj chcete vymazať tento inzerát?');">
                        <input type="hidden" name="id" value="<?=  e($inzerat->id) ?>">
                        <button type="submit" class="btn btn-danger">Vymazať</button>
                </form>
            </div>
        </article>
    <?php } ?>
</div>