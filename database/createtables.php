<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path . "/attendanceapp/database/database.php";
$dbo = new Database();


// Student Details
$dbo->conn->exec("CREATE TABLE IF NOT EXISTS student_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    roll_no VARCHAR(20) UNIQUE,
    name VARCHAR(50)
)");

// Course Details
$dbo->conn->exec("CREATE TABLE IF NOT EXISTS course_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(20) UNIQUE,
    title VARCHAR(50),
    credit INT
)");

// Faculty Details
$dbo->conn->exec("CREATE TABLE IF NOT EXISTS faculty_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(20) UNIQUE,
    name VARCHAR(100),
    password VARCHAR(50)
)");

// Session Details
$dbo->conn->exec("CREATE TABLE IF NOT EXISTS session_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    year INT,
    term VARCHAR(50),
    UNIQUE (year, term)
)");

// Course Registration
$dbo->conn->exec("CREATE TABLE IF NOT EXISTS course_registration (
    student_id INT,
    course_id INT,
    session_id INT,
    PRIMARY KEY (student_id, course_id, session_id),
    FOREIGN KEY (student_id) REFERENCES student_details(id),
    FOREIGN KEY (course_id) REFERENCES course_details(id),
    FOREIGN KEY (session_id) REFERENCES session_details(id)
)");

// Course Allotment
$dbo->conn->exec("CREATE TABLE IF NOT EXISTS course_allotment (
    faculty_id INT,
    course_id INT,
    session_id INT,
    PRIMARY KEY (faculty_id, course_id, session_id),
    FOREIGN KEY (faculty_id) REFERENCES faculty_details(id),
    FOREIGN KEY (course_id) REFERENCES course_details(id),
    FOREIGN KEY (session_id) REFERENCES session_details(id)
)");

// Attendance Details
$dbo->conn->exec("CREATE TABLE IF NOT EXISTS attendance_details (
    faculty_id INT,
    course_id INT,
    session_id INT,
    student_id INT,
    on_date DATE,
    status VARCHAR(10),
    PRIMARY KEY (faculty_id, course_id, session_id, student_id, on_date),
    FOREIGN KEY (faculty_id) REFERENCES faculty_details(id),
    FOREIGN KEY (course_id) REFERENCES course_details(id),
    FOREIGN KEY (session_id) REFERENCES session_details(id),
    FOREIGN KEY (student_id) REFERENCES student_details(id)
)");



// Students
$dbo->conn->exec("INSERT INTO student_details (roll_no, name) VALUES
('BCSIT01','Ayush Dhakal'),
('BCSIT02','Ajaya'),
('BCSIT03','Anjali Dhakal'),
('BCSIT04','Ayush Dhakal'),
('BCSIT05','Abishek Dhakal'),
('BCSIT06','Ayush Dhakal'),
('BCSIT07','Bibek Dhakal'),
('BCSIT08','Bikash Khanal'),
('BCSIT09','Ayush Dhakal'),
('BCSIT10','Ayush Dhakal'),
('BCSIT11','Damodar Dhakal'),
('BCSIT12','Ayush Dhakal'),
('BCSIT13','Diya Acharya'),
('BCSIT14','Ganesh Dhakal'),
('BCSIT15','Ayush Dhakal'),
('BCSIT16','Ayush Dhakal'),
('BCSIT17','Ayush Dhakal'),
('BCSIT18','Ayush Dhakal'),
('BCSIT19','Ayush Dhakal'),
('BCSIT20','Ayush Dhakal')");

// Faculty
$dbo->conn->exec("INSERT INTO faculty_details (user_name, password, name) VALUES
('ND','123','Nirajan Dhaurali'),
('AS','123','Abin Shrestha'),
('POM','123','Bikesh Aadhikari'),
('R','123','Bikesh Aadhikari'),
('D','123','Bikesh Aadhikari')");

// Sessions
$dbo->conn->exec("INSERT INTO session_details (year, term) VALUES
(2024,'FALL SEMESTER'),
(2024,'SPRING SEMESTER')");

// Courses
$dbo->conn->exec("INSERT INTO course_details (title, code, credit) VALUES
('OOAD','CO111',2),
('PHP','CO222',3),
('POM','CO333',4),
('DBMS','CO444',5),
('Math','CO555',6)");
?>