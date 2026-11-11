<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Inzerat[] $inzeraty */
/** @var \App\Models\Kategoria[] $kategorie */
?>
<div class="toolbar">
    <h2>Moje inzeráty</h2>
    <a href="<?= $link->url('inzerat.pridat') ?>" class="add-btn">+ Pridať inzerát</a>
</div>

<p class="count">Počet inzerátov: <?= count($inzeraty) ?></p>

<div class="my-list">
    <?php foreach ($inzeraty as $inzerat) {
        $kategoria = $inzerat->getOneRelated(\App\Models\Kategoria::class); ?>
        <article class="my-item">
            <div class="my-img">obrázok inzerátu</div>
            <div class="my-info">
                <h3><a href="<?= $link->url('inzerat.upravit', ['id' => $inzerat->id]) ?>"><?= e($inzerat->nazov) ?></a></h3>
                <p class="popis"><?= e($inzerat->popis) ?></p>
                <p class="price"><?=  e($inzerat->cena) ?> €</p>
                <p class="meta">
                    <?=  e($inzerat->mesto) ?> &bull;
                    Pridané: <?=  e(date('d.m.Y', strtotime($inzerat->datum))) ?> &bull;
                    Stav: <?= $inzerat->stav === 'ukonceny' ? 'ukončený' : 'aktívny' ?>
                    Kategória: <?= e($kategoria?->nazov ?? 'bez kategórie') ?> &bull;
                </p>
            </div>
            <div class="my-actions">
                <form method="post" action="<?= $link->url('inzerat.vymazat') ?>"
                    onsubmit="return confirm('Naozaj chcete vymazať tento inzerát?');">
                    <input type="hidden" name="id" value="<?= e($inzerat->id) ?>">
                    <button type="submit" class="btn btn-danger">Vymazať</button>
                </form>
            </div>
        </article>
    <?php } ?>
</div>