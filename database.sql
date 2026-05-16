CREATE TABLE IF NOT EXISTS `decks` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `is_public` TINYINT(1) DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `cards` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `deck_id` INT NOT NULL,
  `front_side` TEXT NOT NULL,
  `back_side` TEXT NOT NULL,
  FOREIGN KEY (`deck_id`) REFERENCES `decks`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `decks` (`id`, `title`, `description`) VALUES
(1, 'Từ vựng IT Tiếng Anh', 'Các thuật ngữ mã nguồn mở thông dụng');

INSERT INTO `cards` (`deck_id`, `front_side`, `back_side`) VALUES
(1, 'Repository', 'Kho chứa mã nguồn'),
(1, 'Fork', 'Sao chép dự án nguồn mở của người khác về kho cá nhân'),
(1, 'Open Source', 'Mã nguồn mở');