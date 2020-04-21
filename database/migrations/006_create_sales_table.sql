CREATE TABLE sales (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    costumer_id INT(6) UNSIGNED NOT NULL,
    status BOOLEAN,
    total DECIMAL(18, 2) NOT NULL,
    address_zip_code VARCHAR(25) NOT NULL,
    address_address1 VARCHAR(125) NOT NULL,
    address_address2 VARCHAR(125),
    address_district VARCHAR(125) NOT NULL,
    address_city VARCHAR(125) NOT NULL,
    address_province VARCHAR(125) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (costumer_id) REFERENCES costumers(id) ON DELETE CASCADE
)