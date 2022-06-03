CREATE DATABASE bookstore;
CREATE TABLE bookstore.admin (
	admin_id int NOT NULL,
    name varchar(255) NOT NULL,
    address varchar(255),
    phone varchar(255),
    ssn varchar(255),
    PRIMARY KEY (admin_id)
);
CREATE TABLE bookstore.member (
	mem_id int NOT NULL AUTO_INCREMENT,
    username varchar(255) NOT NULL,
    fname varchar(255) NOT NULL,
    lname varchar(255) NOT NULL,
    address varchar(255),
    phone varchar(255),
    email varchar(255),
    type varchar(255),
    password varchar(255),
    PRIMARY KEY (mem_id)
);

CREATE TABLE bookstore.author (
	author_id int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    address varchar(255),
    phone varchar(255),
    email varchar(255),
    gender varchar(255),
    PRIMARY KEY (author_id)
);

CREATE TABLE bookstore.publisher (
	publisher_id int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    address varchar(255),
    phone varchar(255),
    email varchar(255),
    PRIMARY KEY (publisher_id)
);

CREATE TABLE bookstore.books (
	book_id int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    author_id int NOT NULL,
    publisher_id int NOT NULL,
    price int,
    image varchar(255),
    code int,
    PRIMARY KEY (book_id),
	 FOREIGN KEY (author_id) REFERENCES author(author_id),
     FOREIGN KEY (publisher_id) REFERENCES publisher(publisher_id)
);

CREATE TABLE bookstore.orders (
	order_id int NOT NULL AUTO_INCREMENT,
    total_price int NOT NULL,
    qty int,
    shipping_address varchar(255),
    payment_method varchar(255),
    mem_id int NOT NULL,
    PRIMARY KEY (order_id),
     FOREIGN KEY (mem_id) REFERENCES member(mem_id)

);

CREATE TABLE bookstore.review (
	review_id int NOT NULL,
    book_id int NOT NULL,
    review varchar(555),
    mem_id int NOT NULL,
    rating int,
    PRIMARY KEY (review_id),
		FOREIGN KEY (book_id) REFERENCES books(book_id),
        FOREIGN KEY (mem_id) REFERENCES member(mem_id)
);

CREATE TABLE bookstore.shippingcost (
	cost_id int NOT NULL AUTO_INCREMENT,
    pincode varchar(50),
    cost int,
    PRIMARY KEY (cost_id)
);

CREATE TABLE bookstore.orderhistory (
	hist_id int NOT NULL AUTO_INCREMENT,
    mem_id int NOT NULL,
    code int,
    PRIMARY KEY (hist_id)
    
);

	

INSERT INTO `bookstore`.`publisher` (`publisher_id`, `name`, `address`, `phone`) VALUES ('01', 'newbook', 'pubadd', '123');
INSERT INTO `bookstore`.`publisher` (`publisher_id`, `name`, `address`, `phone`) VALUES ('02', 'penguine', 'pubadd', '123');
INSERT INTO `bookstore`.`publisher` (`publisher_id`, `name`, `address`, `phone`) VALUES ('03', 'roli', 'pubadd', '123');
INSERT INTO `bookstore`.`publisher` (`publisher_id`, `name`, `address`, `phone`) VALUES ('04', 'hnn', 'pubadd', '123');
INSERT INTO `bookstore`.`publisher` (`publisher_id`, `name`, `address`, `phone`) VALUES ('05', 'times', 'pubadd', '123');
INSERT INTO `bookstore`.`author` (`author_id`, `name`, `address`, `phone`, `email`) VALUES ('1', 'Mario Puzo', 'mario', '0000', 'mario@gmail');
INSERT INTO `bookstore`.`author` (`author_id`, `name`, `address`, `phone`, `email`) VALUES ('2', 'Leo Tolstoy', 'leo', '0000', 'leo@gmail');
INSERT INTO `bookstore`.`author` (`author_id`, `name`, `address`, `phone`, `email`) VALUES ('3', 'Gabriel García Márquez', 'gabrial', '0000', 'gab@gmail');
INSERT INTO `bookstore`.`author` (`author_id`, `name`, `address`, `phone`, `email`) VALUES ('4', 'Sylvia Plath', 'slyviya', '0000', 's@gmail');
INSERT INTO `bookstore`.`author` (`author_id`, `name`, `address`, `phone`, `email`) VALUES ('5', 'Don Brown', 'don', '0000', 'd@gmail');
INSERT INTO `bookstore`.`books` (`book_id`, `name`, `author_id`, `publisher_id`,`price`,`image`,`code`) VALUES ('1', 'the godfather', '01', '01', '10', 'book-cover/godfather.jpg','001');
INSERT INTO `bookstore`.`books` (`book_id`, `name`, `author_id`, `publisher_id`,`price`,`image`,`code`) VALUES ('2', 'War and Peace', '02', '01', '10', 'book-cover/war.jpg','002');
INSERT INTO `bookstore`.`books` (`book_id`, `name`, `author_id`, `publisher_id`,`price`,`image`,`code`) VALUES ('3', 'One Hundred Years of Solitude', '03', '01', '10', 'book-cover/hundred.jpg','002');
INSERT INTO `bookstore`.`books` (`book_id`, `name`, `author_id`, `publisher_id`,`price`,`image`,`code`) VALUES ('4', 'The Bell', '04', '01', '10', 'book-cover/bell.jpg','004');
INSERT INTO `bookstore`.`books` (`book_id`, `name`, `author_id`, `publisher_id`,`price`,`image`,`code`) VALUES ('5', 'Angels and Demons', '05', '01', '10', 'book-cover/angels.jpg','005');
