SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS inzeraty (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nazov VARCHAR(100) NOT NULL,
    popis TEXT NOT NULL,
    cena DECIMAL(10,2) NOT NULL,
    mesto VARCHAR(60) NOT NULL,
    stav VARCHAR(20) NOT NULL DEFAULT 'aktivny',
    datum DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO inzeraty (nazov, popis, cena, mesto, stav, datum) VALUES
('Horský bicykel', 'Málo používaný, 26 palcov.', 150.00, 'Žilina', 'aktivny', NOW()),
('Herný notebook', 'Dobrý stav, nová batéria.', 450.00, 'Martin', 'aktivny', NOW()),
('Kreslo', 'Kožené, drobné škrabance.', 45.00, 'Bratislava', 'predany', NOW());