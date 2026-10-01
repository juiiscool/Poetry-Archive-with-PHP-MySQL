CREATE DATABASE poetry_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE poetry_db;

CREATE TABLE poems (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO poems (title, author, content) VALUES
('Te chem', '-', 'Te chem, Doamne, în fiecare zi;\nMi-am întins mâinile către tine.\nÎți arăți minunile morților?\nSe ridică spiritul lor și te laudă?');
