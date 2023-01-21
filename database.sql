-- Create the 'skipso' database
CREATE DATABASE skipso;

-- Use the 'skipso' database
USE skipso;

CREATE TABLE company (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    description TEXT
);

-- Create the 'user' table
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE address (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    street VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    zip_code VARCHAR(255) NOT NULL,
    country VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE user_company (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    company_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (company_id) REFERENCES company(id)
);
ALTER TABLE user_company ADD UNIQUE (user_id, company_id);


/* SQL to retrieve users and companies */
SELECT u.*, c.* 
FROM user u 
LEFT JOIN user_company uc ON u.id = uc.user_id 
LEFT JOIN company c ON uc.company_id = c.id;

/* Given a company, return all users */

SELECT u.*
FROM user u
INNER JOIN user_company uc ON u.id = uc.user_id
INNER JOIN company c ON c.id = uc.company_id
WHERE c.id = {id desejado}