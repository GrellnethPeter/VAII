<?php

namespace App\Models;

use Framework\Core\Model;

class Inzerat extends Model
{
    protected static ?string $tableName = 'inzeraty';
    protected static ?array $fillable = ['nazov', 'popis', 'cena', 'mesto', 'stav'];

    public ?int $id = null;
    public ?string $nazov = null;
    public ?string $popis = null;
    public ?string $cena = null;
    public ?string $mesto = null;
    public ?string $stav = null;
    public ?string $datum = null;
    public ?int $kategoriaId = null;
}