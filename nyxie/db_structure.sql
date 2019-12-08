CREATE TABLE Users
(
    ID        int NOT NULL AUTO_INCREMENT,
    LastName  varchar(255) CHARACTER SET 'utf8',
    Password  varchar(255) CHARACTER SET 'utf8',
    FirstName varchar(255) CHARACTER SET 'utf8',
    Email     varchar(255) CHARACTER SET 'utf8',
    Premium   boolean,
    PRIMARY KEY (ID)
);

CREATE TABLE CATEGORIES
(
    ID       int                               NOT NULL AUTO_INCREMENT,
    Category varchar(255) CHARACTER SET 'utf8' NOT NULL,
    PRIMARY KEY (ID),
    UNIQUE (Category)
);

CREATE TABLE ARTICLES
(
    ID         int NOT NULL AUTO_INCREMENT,
    Title      varchar(255) CHARACTER SET 'utf8',
    Content    varchar(65534) CHARACTER SET 'utf8',
    Date       datetime DEFAULT CURRENT_TIMESTAMP,
    UserID     int,
    CategoryID int,

    PRIMARY KEY (ID)
);

CREATE TABLE ARTICLES_CATEGORIES
(
    ID         int NOT NULL AUTO_INCREMENT,
    UserID     int,
    CategoryID int,
    PRIMARY KEY (ID),
);

CREATE TABLE COMMENTS
(
    ID        int NOT NULL AUTO_INCREMENT,
    Content   varchar(500) CHARACTER SET 'utf8',
    Date      datetime DEFAULT CURRENT_TIMESTAMP,
    UserID    int,
    ArticleID int,
    PRIMARY KEY (ID)
);


 CREATE TABLE Tags(
  ID int NOT NULL AUTO_INCREMENT,
  Tag varchar(255) CHARACTER SET 'utf8' NOT NULL,
  ArticleID int,
  PRIMARY KEY (ID)
 );


