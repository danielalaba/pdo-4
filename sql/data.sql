CREATE TABLE customers (
    customer_id INT PRIMARY KEY AUTO_INCREMENT,
    customer_name VARCHAR(100),
    email VARCHAR(100),
    phone_number VARCHAR(15),
    address VARCHAR(255)
);

CREATE TABLE reserved_pc_parts (
    reservation_id INT PRIMARY KEY AUTO_INCREMENT,
    customer_id INT,
    part_name VARCHAR(100),
    category VARCHAR(50),
    brand VARCHAR(50),
)
