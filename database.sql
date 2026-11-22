CREATE DATABASE IF NOT EXISTS foodbridge CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE foodbridge;

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(120) NOT NULL,
 email VARCHAR(160) NOT NULL UNIQUE,
 password VARCHAR(255) NOT NULL,
 role ENUM('admin','donor','recipient') NOT NULL DEFAULT 'recipient',
 phone VARCHAR(30),
 address TEXT,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE food_donations (
 id INT AUTO_INCREMENT PRIMARY KEY,
 donor_id INT NOT NULL,
 food_name VARCHAR(150) NOT NULL,
 description TEXT NOT NULL,
 quantity INT NOT NULL,
 category VARCHAR(80) NOT NULL,
 expiry_date DATE NOT NULL,
 pickup_location TEXT NOT NULL,
 photo VARCHAR(255),
 status ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY (donor_id) REFERENCES users(id)
) ENGINE=InnoDB;

CREATE TABLE food_requests (
 id INT AUTO_INCREMENT PRIMARY KEY,
 donation_id INT NOT NULL,
 recipient_id INT NOT NULL,
 quantity INT NOT NULL,
 status ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY (donation_id) REFERENCES food_donations(id),
 FOREIGN KEY (recipient_id) REFERENCES users(id)
) ENGINE=InnoDB;

CREATE TABLE distributions (
 id INT AUTO_INCREMENT PRIMARY KEY,
 request_id INT NOT NULL UNIQUE,
 status ENUM('pending','in_progress','completed') NOT NULL DEFAULT 'pending',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 FOREIGN KEY (request_id) REFERENCES food_requests(id)
) ENGINE=InnoDB;

CREATE TABLE donation_history (
 id INT AUTO_INCREMENT PRIMARY KEY,
 donation_id INT NOT NULL,
 action VARCHAR(80) NOT NULL,
 notes TEXT,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY (donation_id) REFERENCES food_donations(id)
) ENGINE=InnoDB;

CREATE TABLE donation_verifications (
 id INT AUTO_INCREMENT PRIMARY KEY,
 donation_id INT NOT NULL UNIQUE,
 admin_id INT NOT NULL,
 status ENUM('approved','rejected') NOT NULL,
 notes TEXT,
 verified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY (donation_id) REFERENCES food_donations(id),
 FOREIGN KEY (admin_id) REFERENCES users(id)
) ENGINE=InnoDB;

CREATE TABLE food_categories (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(80) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO food_categories(name) VALUES
('Makanan siap saji'),('Bahan makanan'),('Roti dan kue'),('Buah dan sayur'),('Lainnya');

-- Password default admin adalah: password
-- Hash di bawah dibuat dengan password_hash('password', PASSWORD_DEFAULT).
INSERT INTO users(name,email,password,role) VALUES
('Administrator','admin@foodbridge.test','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.','admin');
