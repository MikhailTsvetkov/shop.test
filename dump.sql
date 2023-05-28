SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'Товар 1', 'Lorem 1 ipsum dolor sit amet, consectetur adipisicing elit. A blanditiis culpa dolore esse illum laborum minima non nulla, perferendis porro tempora voluptates. Accusantium commodi ea eaque ex, necessitatibus ut voluptate.', 100, '/assets/img/1790073_v01_b.webp', '2023-05-27 11:13:28', '2023-05-27 20:57:08');
INSERT INTO `products` VALUES (2, 'Товар 2', 'Lorem 2 ipsum dolor sit amet, consectetur adipisicing elit. A blanditiis culpa dolore esse illum laborum minima non nulla, perferendis porro tempora voluptates. Accusantium commodi ea eaque ex, necessitatibus ut voluptate.', 1000, '/assets/img/1926552_v01_b.webp', '2023-05-27 11:13:28', '2023-05-27 20:57:08');
INSERT INTO `products` VALUES (3, 'Товар 3', 'Lorem 3 ipsum dolor sit amet, consectetur adipisicing elit. A blanditiis culpa dolore esse illum laborum minima non nulla, perferendis porro tempora voluptates. Accusantium commodi ea eaque ex, necessitatibus ut voluptate.', 150, '/assets/img/1926556_v01_b.webp', '2023-05-27 11:13:28', '2023-05-27 20:57:08');

-- ----------------------------
-- Table structure for testimonials
-- ----------------------------
DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE `testimonials`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of testimonials
-- ----------------------------
INSERT INTO `testimonials` VALUES (1, 1, 'Алексей Иванов', 'user1@mail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. A alias, dignissimos distinctio est fuga non officiis omnis praesentium repellat saepe! Dignissimos dolorum eum in ipsa labore libero necessitatibus nobis, voluptatibus.', '2023-05-27 20:34:18', '2023-05-27 20:34:18');
INSERT INTO `testimonials` VALUES (2, 1, 'Сергей Петров', 'user2@mail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. A alias, dignissimos distinctio est fuga non officiis omnis praesentium repellat saepe! Dignissimos dolorum eum in ipsa labore libero necessitatibus nobis, voluptatibus.', '2023-05-27 20:34:18', '2023-05-27 20:34:18');

SET FOREIGN_KEY_CHECKS = 1;
