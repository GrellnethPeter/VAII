<?php

/** @var \Framework\Support\LinkGenerator $link */
?>
<div class="toolbar">
    <h2>Moje inzeráty</h2>
    <a href="#" class="add-btn">+ Pridať inzerát</a>
</div>

<p class="count">Počet vašich inzerátov: 3</p>

<div class="my-list">
    <article class="my-item">
        <div class="my-img">obrázok inzerátu</div>
        <div class="my-info">
            <h3><a href="<?= $link->url('inzerat.index') ?>">Názov inzerátu</a></h3>
            <p class="price">100 €</p>
            <p class="meta">Žilina &bull; Pridané: 14. 10. 2026 &bull; Stav: aktívny</p>
        </div>
        <div class="my-actions">
            <a href="#" class="btn">Upraviť</a>
            <a href="#" class="btn btn-danger">Zmazať</a>
        </div>
    </article>

    <article class="my-item">
        <div class="my-img">obrázok inzerátu</div>
        <div class="my-info">
            <h3><a href="<?= $link->url('inzerat.index') ?>">Názov inzerátu</a></h3>
            <p class="price">45 €</p>
            <p class="meta">Martin &bull; Pridané: 10. 10. 2026 &bull; Stav: aktívny</p>
        </div>
        <div class="my-actions">
            <a href="#" class="btn">Upraviť</a>
            <a href="#" class="btn btn-danger">Zmazať</a>
        </div>
    </article>

    <article class="my-item">
        <div class="my-img">obrázok inzerátu</div>
        <div class="my-info">
            <h3><a href="<?= $link->url('inzerat.index') ?>">Názov inzerátu</a></h3>
            <p class="price">300 €</p>
            <p class="meta">Bratislava &bull; Pridané: 2. 10. 2026 &bull; Stav: predaný</p>
        </div>
        <div class="my-actions">
            <a href="#" class="btn">Upraviť</a>
            <a href="#" class="btn btn-danger">Zmazať</a>
        </div>
    </article>
</div>