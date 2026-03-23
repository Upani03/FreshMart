-- ============================================================
-- FreshMart Database – database.sql
-- Import via phpMyAdmin or: mysql -u root -p < database.sql
-- ============================================================

CREATE DATABASE IF NOT EXISTS freshmart_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE freshmart_db;

-- -------------------------
-- Table: users
-- -------------------------
CREATE TABLE IF NOT EXISTS users (
  id         INT          NOT NULL AUTO_INCREMENT,
  username   VARCHAR(60)  NOT NULL,
  email      VARCHAR(120) NOT NULL UNIQUE,
  password   VARCHAR(255) NOT NULL,
  created_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample user (password: Demo@1234)
INSERT INTO users (username, email, password) VALUES
  ('demo_user', 'demo@freshmart.lk',
   '$2y$12$YkQw3g4R5H1oXvLsNm2V7eQpOuJZ0bK8dA9fCtWgEyMnRlP6siXqC');

-- -------------------------
-- Table: messages (contact form)
-- -------------------------
CREATE TABLE IF NOT EXISTS messages (
  id         INT          NOT NULL AUTO_INCREMENT,
  name       VARCHAR(100) NOT NULL,
  email      VARCHAR(120) NOT NULL,
  phone      VARCHAR(30)  DEFAULT NULL,
  subject    VARCHAR(200) DEFAULT NULL,
  message    TEXT         NOT NULL,
  created_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -------------------------
-- Table: orders
-- -------------------------
CREATE TABLE IF NOT EXISTS orders (
  id               INT           NOT NULL AUTO_INCREMENT,
  user_id          INT           NOT NULL,
  order_ref        VARCHAR(30)   NOT NULL,
  order_date       DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  subtotal         DECIMAL(10,2) NOT NULL DEFAULT 0,
  delivery_fee     DECIMAL(10,2) NOT NULL DEFAULT 0,
  total_amount     DECIMAL(10,2) NOT NULL DEFAULT 0,
  delivery_name    VARCHAR(100)  DEFAULT NULL,
  delivery_phone   VARCHAR(30)   DEFAULT NULL,
  delivery_address VARCHAR(255)  DEFAULT NULL,
  delivery_city    VARCHAR(60)   DEFAULT NULL,
  postal_code      VARCHAR(20)   DEFAULT NULL,
  delivery_note    TEXT          DEFAULT NULL,
  delivery_type    VARCHAR(20)   DEFAULT 'standard',
  delivery_slot    VARCHAR(100)  DEFAULT NULL,
  payment_method   VARCHAR(30)   DEFAULT 'cod',
  payment_label    VARCHAR(80)   DEFAULT 'Cash on Delivery',
  status           VARCHAR(30)   NOT NULL DEFAULT 'Confirmed',
  PRIMARY KEY (id),
  KEY fk_order_user (user_id),
  CONSTRAINT fk_order_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -------------------------
-- Table: order_items
-- -------------------------
CREATE TABLE IF NOT EXISTS order_items (
  id            INT           NOT NULL AUTO_INCREMENT,
  order_id      INT           NOT NULL,
  product_name  VARCHAR(150)  NOT NULL,
  product_price DECIMAL(10,2) NOT NULL,
  quantity      INT           NOT NULL DEFAULT 1,
  emoji         VARCHAR(10)   DEFAULT '🛒',
  PRIMARY KEY (id),
  KEY fk_item_order (order_id),
  CONSTRAINT fk_item_order FOREIGN KEY (order_id) REFERENCES orders (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
