use fcs_63;
CREATE TABLE `users`(
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255),
    `email` VARCHAR(255)
);

CREATE TABLE `posts`(
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255),
    `content` VARCHAR(255),
    `user_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES users(`id`) 
);

CREATE TABLE `comments`(
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `content` VARCHAR(255),
    `user_id` INT,
    `post_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES users(`id`),
    FOREIGN KEY (`post_id`) REFERENCES posts(`id`)
);

-- Filling the tables with dummy/temporary data

INSERT INTO `users` (`name`, `email`) VALUES
('Elias Kallas', 'eliask@hotmail.com'),
('Ali Shamas', 'Alloush@gmail.com'),
('Jad harb', 'JadHarb@live.com'),
('Diana attallah', 'dianaA@yahoo.com'),
('Mohammad Mahmoud', 'MHMD@Wish.com.lb'),
('Jana Haidar', 'Princessa@hotmail.com'),
('Amani Smadi', 'ASmadi@BOBFin.com.lb'),
('Jad Saikaly', 'SaykaliJad@gmail.com'),
('Celesty Karam', 'Karam_Celesty@hotmail.com');

INSERT INTO `posts` (`title`, `content`, `user_id`) VALUES
('Learning Python for Beginners', 'Step-by-step guide for absolute beginners to start coding in Python.', 1),
('JavaScript Basics for Web Development', 'Understanding variables, functions, and DOM manipulation.', 2),
('Mastering SQL Queries', 'From SELECT statements to advanced filtering.', 3),
('Getting Started with Java', 'Beginner-friendly intro to Java syntax and OOP.', 4),
('Css for Design', 'Learn how to use Css', 5),
('Top 10 Coding Bootcamps in 2025', 'A review of the most effective and affordable bootcamps.', 6),
('Improving Problem-Solving Skills in Programming', 'How to think like a programmer and solve coding challenges.', 7),
('Getting Your First Job as a Software Developer', 'Practical tips to land your first programming job.', 8),
('Learning Multiple Programming Languages', 'Why learning more than one language can boost your career.', 9);

INSERT INTO `comments` (`content`, `user_id`, `post_id`) VALUES
('This Python guide is super clear, thanks!', 2, 1),
('Can you make an advanced JavaScript tutorial next?', 3, 2),
('Very helpful SQL explanations!', 4, 3),
('I love Java! Great post.', 5, 4),
('Css with HTML are the basics', 6, 5),
('I’m considering joining a bootcamp this year.', 7, 6),
('These problem-solving tips are gold.', 8, 7),
('Landing my first job was tough, but these tips help.', 9, 8),
('I totally agree, knowing multiple languages is powerful.', 1, 9),
('Please share more Python exercises.', 3, 1),
('Bootcamps are a great shortcut to tech jobs.', 4, 6),
('SQL is underrated — thanks for sharing.', 6, 3);
