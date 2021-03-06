CREATE TABLE sale_products (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sale_id INT(6) UNSIGNED NOT NULL,
    product_id INT(6) UNSIGNED NOT NULL,
    quantity SMALLINT NOT NULL,
    unit_price DECIMAL(18, 2) NOT NULL,
    total DECIMAL(18, 2) NOT NULL,
    FOREIGN KEY (sale_id) REFERENCES sales(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
)