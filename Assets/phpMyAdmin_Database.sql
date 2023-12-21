CREATE TABLE `users`(
  `id` INT PRIMARY KEY,
  `login` VARCHAR(255),
  `password` VARCHAR(255),
  `privileges` ENUM('student', 'teacher', 'admin')
);
CREATE TABLE `students`(
  `user_id` INT PRIMARY KEY,
  `first_name` VARCHAR(255),
  `last_name` VARCHAR(255),
  `class_id` INT
);
CREATE TABLE `teachers`(
  `user_id` INT PRIMARY KEY,
  `first_name` VARCHAR(255),
  `last_name` VARCHAR(255),
  `subject_id` INT
);
CREATE TABLE `classes`(
  `id` INT PRIMARY KEY,
  `name_class` VARCHAR(255),
  `subject_id` INT
);
CREATE TABLE `subjects`(
  `id` INT PRIMARY KEY,
  `name_subject` VARCHAR(255)
);
CREATE TABLE `quizzes`(
  `id` INT PRIMARY KEY,
  `subject_id` INT,
  `question` VARCHAR(255),
  `answer_a` VARCHAR(255),
  `answer_b` VARCHAR(255),
  `answer_c` VARCHAR(255),
  `answer_d` VARCHAR(255),
  `answer_correct` VARCHAR(255)
);
CREATE TABLE `lessons`(
  `id` INT PRIMARY KEY,
  `subject_id` INT,
  `tittle` VARCHAR(255),
  `file_full_name` VARCHAR(255)
);
CREATE TABLE `tasks`(
  `id` INT PRIMARY KEY,
  `subject_id` INT,
  `tittle` VARCHAR(255),
  `description` VARCHAR(255)
);
CREATE TABLE `grades`(
  `id` INT PRIMARY KEY,
  `students_id` INT,
  `category` ENUM('task', 'quiz'),
  `value` INT,
  `reference_to_id` INT
);
CREATE TABLE `avatars`(
  `id` INT PRIMARY KEY,
  `image_src` VARCHAR(255)
);
CREATE TABLE `theme`(`id` INT PRIMARY KEY, `selected` INT);
ALTER TABLE `students`
ADD FOREIGN KEY(`user_id`) REFERENCES `users`(`id`);
ALTER TABLE `teachers`
ADD FOREIGN KEY(`user_id`) REFERENCES `users`(`id`);
ALTER TABLE `students`
ADD FOREIGN KEY(`class_id`) REFERENCES `classes`(`id`);
ALTER TABLE `lessons`
ADD FOREIGN KEY(`subject_id`) REFERENCES `subjects`(`id`);
ALTER TABLE `tasks`
ADD FOREIGN KEY(`subject_id`) REFERENCES `subjects`(`id`);
ALTER TABLE `quizzes`
ADD FOREIGN KEY(`subject_id`) REFERENCES `subjects`(`id`);
ALTER TABLE `grades`
ADD FOREIGN KEY(`students_id`) REFERENCES `students`(`user_id`);
ALTER TABLE `users`
ADD FOREIGN KEY(`id`) REFERENCES `avatars`(`id`);
ALTER TABLE `users`
ADD FOREIGN KEY(`id`) REFERENCES `theme`(`id`);