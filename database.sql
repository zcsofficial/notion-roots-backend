CREATE TABLE projects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    category VARCHAR(50),
    image_url VARCHAR(255),
    link VARCHAR(255)
);

ALTER TABLE projects 
MODIFY image_url TEXT,
MODIFY link TEXT;


CREATE DATABASE notion_roots;

USE notion_roots;

CREATE TABLE images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image_name VARCHAR(255) NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE images ADD COLUMN uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
