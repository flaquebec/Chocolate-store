CREATE TABLE product_images (
    product_id INT(6) UNSIGNED NOT NULL,
    image VARCHAR(125) NOT NULL,
    position INT UNSIGNED NOT NULL DEFAULT 0,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
)