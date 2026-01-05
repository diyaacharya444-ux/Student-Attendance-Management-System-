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
('BCSIT02','Ajaya  Chanda'),
('BCSIT03','Anjali Ayer'),
('BCSIT04','Anuska Adhikari'),
('BCSIT05','Arjun Kumar Sharma'),
('BCSIT06','Avishek Karki'),
('BCSIT07','Bibek Gahire'),
('BCSIT08','Bikash Khanal'),
('BCSIT09','Binita KC'),
('BCSIT10','Birendra Bohara'),
('BCSIT11','Damodar Joshi'),
('BCSIT12','Darshan Shakya'),
('BCSIT13','Diya Acharya'),
('BCSIT14','Ganesh Kandel'),
('BCSIT15','Himal Singh Kumwar'),
('BCSIT16','Janak Chand'),
('BCSIT17','Krispa Chaudhary'),
('BCSIT18','Nishan Khanal'),
('BCSIT19','Prabal Basnet'),
('BCSIT20','Kushal Ghimire')");

// Faculty
$dbo->conn->exec("INSERT INTO faculty_details (user_name, password, name) VALUES
('ND','123','Nirajan Dhaurali'),
('AS','123','Abin Shrestha'),
('POM','123','Abimanu Bashyal'),
('R','123','Rajan Pokharel'),
('D','123','Dinesh Bhandari')");

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

// iterate over all the 20 student
$c = "insert into course_registration
(student_id, course_id, session_id)
values
(:sid,:cid,:sessid)";
$s=$dbo->conn->prepare($c);

;
for($i=1;$i<=20;$i++)
{
    for($j=0; $j<5;$j++)
    {
        $cid=rand(5,5)
    }
try{

    $s->execute([":sid"=>$i,":cid"=>$cid,":sessid"=>,1]);
}
catch(PDOException $pe){

}
//repeat for session 2
$cid=rand(6,6);
try{
     $s->execute([":sid"=>$i,":cid"=>$cid,":sessid"=>,2]);
}
catch(PDOException $pe){

}
// if any record already there in the table in the table delete them
clearTable($dbo,"course_allotment");
$c="insert into course_allotment
(faculty_id,course_id,session_id)
values
(:fid,:cid,:sessid)";
$s=$dbo->conn->prepare($c);
for($i=1;$i<=5;$i++){
    for($j=0;$j<2;$j++){
        $cid=rand(1,6);
        
    }
    try{

    $s->execute([":sid"=>$i,":cid"=>$cid,":sessid"=>,1]);
}
catch(PDOException $pe){

}
$cid=rand(1,)
}
?>