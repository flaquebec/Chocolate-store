CREATE TABLE costumers (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(125) NOT NULL,
    email VARCHAR(125) NOT NULL,
    password VARCHAR(125) NOT NULL,
    cellphone VARCHAR(125),
    address_zip_code VARCHAR(25) NOT NULL,
    address_address1 VARCHAR(125) NOT NULL,
    address_address2 VARCHAR(125),
    address_district VARCHAR(125) NOT NULL,
    address_city VARCHAR(125) NOT NULL,
    address_province VARCHAR(125) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)