-- Tabla de Usuarios
CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(15) NOT NULL,
    password VARCHAR(255) NOT NULL, -- Almacenada de forma hasheada
    role ENUM('user', 'operator', 'admin') NOT NULL DEFAULT 'user',
    timezone VARCHAR(50) DEFAULT 'UTC',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO Users (name, email, phone, password, role, timezone, created_at, updated_at) VALUES
('Admin User', 'admin@example.com', '1234567890', '$2y$10$QwUQm3lQOrwOSa1/7jB96u9F6X9C8gyTevMkF69xfHbMJeuPHUF5u', 'admin', 'America/Bogota', NOW(), NOW()),
('Operator One', 'operator1@example.com', '2345678901', '$2y$10$QwUQm3lQOrwOSa1/7jB96u9F6X9C8gyTevMkF69xfHbMJeuPHUF5u', 'operator', 'America/Bogota', NOW(), NOW()),
('Operator Two', 'operator2@example.com', '3456789012', '$2y$10$QwUQm3lQOrwOSa1/7jB96u9F6X9C8gyTevMkF69xfHbMJeuPHUF5u', 'operator', 'America/Bogota', NOW(), NOW()),
('Test User', 'user1@example.com', '4567890123', '$2y$10$QwUQm3lQOrwOSa1/7jB96u9F6X9C8gyTevMkF69xfHbMJeuPHUF5u', 'user', 'America/Bogota', NOW(), NOW()),
('Test User Two', 'user2@example.com', '5678901234', '$2y$10$QwUQm3lQOrwOSa1/7jB96u9F6X9C8gyTevMkF69xfHbMJeuPHUF5u', 'user', 'America/Bogota', NOW(), NOW());
