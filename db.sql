use student_management_system;

describe teachers;

CREATE TABLE teachers (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(100) NOT NULL,
       email VARCHAR(100) NOT NULL,
       phone VARCHAR(20)
);

describe students;

CREATE TABLE students (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(100) NOT NULL,
       email VARCHAR(100) NOT NULL,
       phone VARCHAR(20)
);

describe courses;

CREATE TABLE courses(
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(100) NOT NULL,
    description VARCHAR(255),
    teacher_id INT
);

describe results;

CREATE TABLE result(
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    marks INT NOT NULL,
    grade VARCHAR(5)
);

describe users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'user'
);

-- INSERT
INSERT INTO `student_management_system`.`users` (`username`, `email`, `password`, `role`) VALUES ('Admin', 'admin@example.com', '123456', 'admin');

INSERT INTO `student_management_system`.`student` (`name`, `email`, `phone`) VALUES ('Sean', 'sean@example.com', '012-3456789');

INSERT INTO `student_management_system`.`teachers` (`name`, `email`, `phone`) VALUES ('Sean ', 'sean@gmail.com', '01923456789');

INSERT INTO `student_management_system`.`courses` (`name`, `description`, `teacher_id`) VALUES ('Chinese', 'is the chinese', '1');

INSERT INTO `student_management_system`.`results` (`student_id`, `course_id`, `marks`, `grade`) VALUES ('1 ', '1', '0', 'F');

-- foreign key courses
ALTER TABLE `student_management_system`.`courses` 
ADD CONSTRAINT `fk_courses_teacher`
  FOREIGN KEY (`teacher_id`)
  REFERENCES `student_management_system`.`teachers` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

--foreign key result
ALTER TABLE `student_management_system`.`results` 
ADD CONSTRAINT `student_id`
  FOREIGN KEY (`student_id`)
  REFERENCES `student_management_system`.`student` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `course_id`
  FOREIGN KEY (`course_id`)
  REFERENCES `student_management_system`.`courses` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

