SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS kategorie (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nazov VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS inzeraty (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nazov VARCHAR(100) NOT NULL,
    popis TEXT NOT NULL,
    cena DECIMAL(10,2) NOT NULL,
    mesto VARCHAR(60) NOT NULL,
    stav VARCHAR(20) NOT NULL DEFAULT 'aktivny',
    datum DATETIME NOT NULL,
    kategoriaId INT UNSIGNED NULL,
    CONSTRAINT fk_inzeraty_kategoria FOREIGN KEY (kategoriaId)
        REFERENCES kategorie (id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO kategorie (nazov) VALUES
('Elektronika'), ('Oblečenie'), ('Nábytok'), ('Šport'), ('Iné');

INSERT INTO inzeraty (nazov, popis, cena, mesto, stav, datum, kategoriaId) VALUES
('Horský bicykel', 'Málo používaný, 26 palcov.', 150.00, 'Žilina', 'aktivny', NOW(), 4),
('Herný notebook', 'Dobrý stav, nová batéria.', 450.00, 'Martin', 'aktivny', NOW(), 1),
('Kreslo', 'Kožené, drobné škrabance.', 45.00, 'Bratislava', 'ukonceny', NOW(), 3);