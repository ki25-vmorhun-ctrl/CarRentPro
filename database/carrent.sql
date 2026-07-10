-- ===========================================
-- CarRent Pro Database
-- Автор: ChatGPT
-- ===========================================

CREATE DATABASE IF NOT EXISTS carrentpro
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE carrentpro;

-- ==========================
-- Користувачі
-- ==========================

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(120) UNIQUE NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    language ENUM('uk','en') DEFAULT 'uk',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==========================
-- Адміністратори
-- ==========================

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- ==========================
-- Автомобілі
-- ==========================

CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,

    brand VARCHAR(50),
    model VARCHAR(50),

    year INT,

    transmission ENUM('Automatic','Manual'),

    fuel ENUM('Petrol','Diesel','Hybrid','Electric'),

    seats INT,

    color VARCHAR(30),

    engine VARCHAR(30),

    horsepower INT,

    mileage INT,

    price DECIMAL(10,2),

    image VARCHAR(255),

    description TEXT,

    status ENUM('Available','Booked') DEFAULT 'Available',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==========================
-- Бронювання
-- ==========================

CREATE TABLE bookings (

    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT,

    car_id INT,

    date_from DATE,

    date_to DATE,

    total_price DECIMAL(10,2),

    status ENUM('Pending','Confirmed','Cancelled')
    DEFAULT 'Pending',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE CASCADE,

    FOREIGN KEY (car_id)
    REFERENCES cars(id)
    ON DELETE CASCADE

);

-- ==========================
-- Обране
-- ==========================

CREATE TABLE favorites (

    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT,

    car_id INT,

    FOREIGN KEY(user_id)
    REFERENCES users(id)
    ON DELETE CASCADE,

    FOREIGN KEY(car_id)
    REFERENCES cars(id)
    ON DELETE CASCADE

);

-- ==========================
-- Відгуки
-- ==========================

CREATE TABLE reviews (

    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT,

    car_id INT,

    rating INT,

    review TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY(user_id)
    REFERENCES users(id)
    ON DELETE CASCADE,

    FOREIGN KEY(car_id)
    REFERENCES cars(id)
    ON DELETE CASCADE

);

-- ==========================
-- Початковий адміністратор
-- Логін: admin
-- Пароль потрібно буде замінити після
-- реалізації авторизації.
-- ==========================

INSERT INTO admins(username,password)
VALUES(
'admin',
'admin123'
);

-- ==========================
-- Тестові автомобілі
-- ==========================

INSERT INTO cars
(brand,model,year,transmission,fuel,seats,color,engine,horsepower,mileage,price,image,description)

VALUES

('BMW','530i',2023,'Automatic','Petrol',5,'Black','2.0 Turbo',252,12000,95,'bmw530.jpg','Luxury business sedan'),

('Mercedes','E220',2022,'Automatic','Diesel',5,'White','2.0',194,19000,100,'e220.jpg','Comfort and premium'),

('Audi','A6',2023,'Automatic','Petrol',5,'Gray','2.0 TFSI',245,9000,110,'a6.jpg','Modern executive sedan'),

('Toyota','Camry',2024,'Automatic','Hybrid',5,'Silver','2.5 Hybrid',218,5000,80,'camry.jpg','Reliable hybrid sedan'),

('Tesla','Model 3',2024,'Automatic','Electric',5,'Red','EV',283,3000,120,'tesla3.jpg','Electric future');