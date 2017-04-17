CREATE DATABASE cleanlineslawncare;
USE cleanlineslawncare;

CREATE TABLE users( 
    user_id int(5) NOT NULL AUTO_INCREMENT, 
    user_email nvarchar(255) NOT NULL, 
    user_password_hash nvarchar(255) NOT NULL, 
    PRIMARY KEY(user_id)
);

CREATE TABLE gallery_pictures(
    gallery_picture_id int(5) NOT NULL AUTO_INCREMENT,
    gallery_picture_location nvarchar(5000) NOT NULL,
    PRIMARY KEY(gallery_picture_id)
);

CREATE TABLE reviews(
    review_id int(5) NOT NULL AUTO_INCREMENT,
    review_rating int(1) NOT NULL,
    review_name nvarchar(255) NOT NULL,
    review_content nvarchar(5000) NOT NULL,
    review_date DATETIME NOT NULL,
    PRIMARY KEY(review_id)
);
