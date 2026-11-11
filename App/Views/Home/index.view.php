<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Kategoria[] $kategorie */
/** @var \App\Models\Inzerat[] $inzeraty */
/** @var string|null $kategoriaId */
?>
<div class="toolbar">
    <h2>Inzeráty</h2>

    <form class="search" role="search">
        <input type="search" name="q" placeholder="Hľadať podľa kľúčového slova..." aria-label="Hľadať inzeráty">
        <button type="submit" class="search-btn">Hľadať</button>
    </form>

    <div class="sort">
        <label for="zoradenie">Zoradiť podľa:</label>
        <select id="zoradenie" name="zoradenie">
            <option>Najnovšie</option>
            <option>Najlacnejšie</option>
            <option>Najdrahšie</option>
        </select>
    </div>

    <a href="<?= $link->url('inzerat.pridat') ?>" class="add-btn">+ Pridať inzerát</a>
</div>

<div class="layout">
    <aside class="filters">
        <h3>Filtre</h3>
        <form method="get" action="<?= $link->url('home.index') ?>">
            <label for="kategoria">Kategória</label>
            <select id="kategoria" name="kategoria">
                <option value="">Všetky</option>
                <?php foreach ($kategorie as $kategoria) { ?>
                    <option value="<?= e($kategoria->id) ?>"
                        <?= (string)$kategoriaId === (string)$kategoria->id ? 'selected' : '' ?>>
                        <?= e($kategoria->nazov) ?>
                    </option>
                <?php } ?>
            </select>

            <label for="mesto">Lokalita</label>
            <select id="mesto" name="mesto">
                <option>Všetky</option>
                <option>Žilina</option>
                <option>Martin</option>
                <option>Bratislava</option>
                <option>Košice</option>
                <option>Čadca</option>
            </select>

            <label for="cena-od">Cena (€)</label>
            <div class="price-range">
                <input type="number" id="cena-od" name="cena_od" placeholder="od" min="0">
                <input type="number" id="cena-do" name="cena_do" placeholder="do" min="0" aria-label="Cena do">
            </div>

            <button type="submit" class="btn btn-primary">Použiť filtre</button>
            <a href="<?= $link->url('home.index') ?>" class="btn">Zrušiť filtre</a>
        </form>
    </aside>

    <section class="listing">
        <p class="count">Nájdených inzerátov: <?= count($inzeraty) ?></p>

        <div class="cards">
            <?php foreach ($inzeraty as $inzerat) { ?>
                <article class="card">
                    <div class="card-img">obrázok inzerátu</div>
                    <div class="card-body">
                        <h3><?= e($inzerat->nazov) ?></h3>
                        <p class="popis"><?= e($inzerat->popis) ?></p>
                        <p class="price"><?= e($inzerat->cena) ?> €</p>
                        <p class="meta"><?= e($inzerat->mesto) ?></p>
                    </div>
                </article>
            <?php } ?>
        </div>
    </section>
</div>

<nav class="pagination" aria-label="Stránkovanie">
    <ul>
        <li><a href="#">&laquo;</a></li>
        <li><a href="#" class="active" aria-current="page">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><span>...</span></li>
        <li><a href="#">8</a></li>
        <li><a href="#">&raquo;</a></li>
    </ul>
</nav>