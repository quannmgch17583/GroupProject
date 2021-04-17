

CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','manager','coordinator','student','guest') NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

INSERT INTO account VALUES("1","admin","202cb962ac59075b964b07152d234b70","admin","Minh Quan","");
INSERT INTO account VALUES("2","nguyenminhquan","202cb962ac59075b964b07152d234b70","student","Nguyen Minh Quan","");
INSERT INTO account VALUES("3","hoangpin","202cb962ac59075b964b07152d234b70","coordinator","Dinh Xuan Hoang","IT");
INSERT INTO account VALUES("4","student","202cb962ac59075b964b07152d234b70","student","IT Student","IT");
INSERT INTO account VALUES("5","student2","202cb962ac59075b964b07152d234b70","student","Business Student","Business");
INSERT INTO account VALUES("17","student3","202cb962ac59075b964b07152d234b70","student","Designer Student","Designer");
INSERT INTO account VALUES("18","manager","202cb962ac59075b964b07152d234b70","manager","Manager","");
INSERT INTO account VALUES("20","designerfaculty","202cb962ac59075b964b07152d234b70","coordinator","Designer Faculty","Designer");
INSERT INTO account VALUES("22","guest","202cb962ac59075b964b07152d234b70","guest","Guest","Designer");
INSERT INTO account VALUES("23","minhquan123","202cb962ac59075b964b07152d234b70","student","Minh Quan Designer","Designer");
INSERT INTO account VALUES("24","businessfaculty","202cb962ac59075b964b07152d234b70","coordinator","Business Faculty","Business");
INSERT INTO account VALUES("25","guestIT","202cb962ac59075b964b07152d234b70","guest","Guest IT","IT");
INSERT INTO account VALUES("26","testguest","202cb962ac59075b964b07152d234b70","guest","testguest","Business");



CREATE TABLE `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `department` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

INSERT INTO chat VALUES("1","IT Student","IT Student Test","IT");
INSERT INTO chat VALUES("2","Business Student","Business Student Test","Business");
INSERT INTO chat VALUES("3","Designer Student","Designer Student Test","Designer");
INSERT INTO chat VALUES("4","Designer Faculty","Designer Faculty","Designer");
INSERT INTO chat VALUES("5","Dinh Xuan Hoang","IT Faculty","IT");
INSERT INTO chat VALUES("6","Business Faculty","Business Faculty","Business");
INSERT INTO chat VALUES("7","IT Student","Hello, Im Quan","IT");
INSERT INTO chat VALUES("8","IT Student","Test Test Test","IT");
INSERT INTO chat VALUES("9","Dinh Xuan Hoang","Ok","IT");



CREATE TABLE `contribution` (
  `cID` int(11) NOT NULL AUTO_INCREMENT,
  `cName` text NOT NULL,
  `cDes` text NOT NULL,
  `cStartDate` date NOT NULL,
  `cEndDate` date NOT NULL,
  PRIMARY KEY (`cID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO contribution VALUES("1","Contribution 1","Test 1","2021-03-21","2021-03-23");
INSERT INTO contribution VALUES("2","Contribution 2","Test 2","2021-03-24","2021-03-27");



CREATE TABLE `department` (
  `dID` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(255) NOT NULL,
  PRIMARY KEY (`dID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO department VALUES("1","IT");
INSERT INTO department VALUES("2","Business");
INSERT INTO department VALUES("3","Designer");



CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentName` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL DEFAULT 'has a new submission',
  `status` int(11) NOT NULL DEFAULT 0,
  `cr_date` datetime NOT NULL,
  `department` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

INSERT INTO notification VALUES("31","IT Student","has a new submission","1","2021-03-25 18:50:18","IT");
INSERT INTO notification VALUES("32","Business Student","has a new submission","1","2021-03-25 18:50:29","Business");
INSERT INTO notification VALUES("33","Designer Student","has a new submission","1","2021-03-25 18:50:36","Designer");
INSERT INTO notification VALUES("34","IT Student","has a new submission","1","2021-03-25 22:46:26","IT");
INSERT INTO notification VALUES("35","IT Student","has a new submission","1","2021-03-27 15:18:01","IT");
INSERT INTO notification VALUES("36","IT Student","has a new submission","1","2021-03-27 16:50:53","IT");
INSERT INTO notification VALUES("37","IT Student","has a new submission","1","2021-03-29 14:42:58","IT");
INSERT INTO notification VALUES("38","IT Student","has a new submission","1","2021-04-03 15:47:12","IT");
INSERT INTO notification VALUES("39","IT Student","has a new submission","1","2021-04-03 15:57:03","IT");
INSERT INTO notification VALUES("40","IT Student","has a new submission","0","2021-04-14 06:29:41","IT");



CREATE TABLE `role` (
  `rID` int(11) NOT NULL AUTO_INCREMENT,
  `role` enum('admin','manager','coordinator','student','guest') NOT NULL,
  PRIMARY KEY (`rID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO role VALUES("1","admin");
INSERT INTO role VALUES("2","manager");
INSERT INTO role VALUES("3","coordinator");
INSERT INTO role VALUES("4","student");
INSERT INTO role VALUES("5","guest");



CREATE TABLE `submission` (
  `sID` int(255) NOT NULL AUTO_INCREMENT,
  `sName` varchar(255) NOT NULL,
  `cID` int(255) NOT NULL,
  `sUpload` varchar(255) NOT NULL,
  `studentID` int(255) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `cr_date` datetime NOT NULL DEFAULT current_timestamp(),
  `Comment` text NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`sID`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

INSERT INTO submission VALUES("25","IT submission","1","dbbackup.PNG","4","IT","2021-03-25 17:21:47","Test","Accepted");
INSERT INTO submission VALUES("27","Designer Submission","1","dbbackup.PNG","17","Designer","2021-03-25 17:20:48","","Accepted");
INSERT INTO submission VALUES("29","Làm Sao Để Cắn Người","1","kien3khoang.jpg","19","Designer","2021-03-25 17:20:48","Test Comment 3","Accepted");
INSERT INTO submission VALUES("31","Test Date","1","dbbackup.PNG","4","IT","2021-03-25 17:22:17","Hình ảnh chỉ mang tính chất minh họa nhưng Pin thích","Accepted");
INSERT INTO submission VALUES("34","Test Submission B","1","2.PNG","5","Business","2021-03-30 16:14:25","","Accepted");
INSERT INTO submission VALUES("35","Test Submission","1","dbbackup.PNG","4","IT","2021-03-31 17:09:43","","");
INSERT INTO submission VALUES("39","My Image","1","21.PNG","4","IT","2021-04-14 06:29:34","","");
INSERT INTO submission VALUES("40","Test Submission 3","1","1.png","4","IT","2021-04-18 00:58:46","","");

