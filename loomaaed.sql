CREATE TABLE 10163487_loomaaed (
    id INTEGER PRIMARY KEY auto_increment,
    nimi VARCHAR(20),
    vanus INTEGER,
    liik VARCHAR(20),
    puur INTEGER
    );
	
INSERT INTO 10163487_loomaaed VALUES 
(NULL, 'Tomas', 2, 'kass', 1),
(NULL, 'Jerry', 1, 'hiir', 2),
(NULL, 'Snoopy', 3, 'koer', 3),
(NULL, 'Klaus', 8, 'hiir', 2),
(NULL, 'Dorety', 2, 'hiir', 1);

SELECT nimi, puur FROM 10163487_loomaaed WHERE puur = 2;

SELECT max(vanus) as vanim, min(vanus) as noorim FROM 10163487_loomaaed;

SELECT puur, count(*) FROM 10163487_loomaaed GROUP BY puur;

UPDATE 10163487_loomaaed SET vanus = vanus + 1;