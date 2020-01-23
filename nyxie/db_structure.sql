CREATE TABLE users
(
    ID        int NOT NULL AUTO_INCREMENT,
    LastName  varchar(255) CHARACTER SET 'utf8',
    Password  varchar(255) CHARACTER SET 'utf8',
    FirstName varchar(255) CHARACTER SET 'utf8',
    Email     varchar(255) CHARACTER SET 'utf8',
    Premium   boolean,
    Blocked   boolean,
    PRIMARY KEY (ID)
);

CREATE TABLE categories
(
    ID       int                               NOT NULL AUTO_INCREMENT,
    Category varchar(255) CHARACTER SET 'utf8' NOT NULL,
    PRIMARY KEY (ID),
    UNIQUE (Category)
);

CREATE TABLE articles
(
    ID         int NOT NULL AUTO_INCREMENT,
    Title      varchar(255) CHARACTER SET 'utf8',
    Content    varchar(65534) CHARACTER SET 'utf8',
    Date       timestamp DEFAULT CURRENT_TIMESTAMP,
    UserID     int,
    CategoryID int,
    PRIMARY KEY (ID)
);

CREATE TABLE articles_categories
(
    ID         int NOT NULL AUTO_INCREMENT,
    UserID     int,
    CategoryID int,
    PRIMARY KEY (ID)
);

CREATE TABLE comments
(
    ID        int NOT NULL AUTO_INCREMENT,
    Content   varchar(500) CHARACTER SET 'utf8',
    Date      timestamp DEFAULT CURRENT_TIMESTAMP,
    UserID    int,
    ArticleID int,
    PRIMARY KEY (ID)
);


CREATE TABLE tags
(
    ID        int                               NOT NULL AUTO_INCREMENT,
    Tag       varchar(255) CHARACTER SET 'utf8' NOT NULL,
    ArticleID int,
    PRIMARY KEY (ID)
);

CREATE TABLE sessions
(
    ID      int NOT NULL AUTO_INCREMENT,
    UserID  int,
    Value   varchar(255) CHARACTER SET 'utf8',
    IP      varchar(255) CHARACTER SET 'utf8',
    Browser varchar(255) CHARACTER SET 'utf8',
    Date    timestamp DEFAULT CURRENT_TIMESTAMP,
    Expired boolean   DEFAULT 0,
    PRIMARY KEY (ID)
);

# Sample data
INSERT INTO `users` (`ID`, `LastName`, `Password`, `FirstName`, `Email`, `Premium`,`Blocked`)
VALUES (1, 'Admin', '8C6976E5B5410415BDE908BD4DEE15DFB167A9C873FC4BB8A81F6F2AB448A918', 'Admin', 'admin', 1,0);

INSERT INTO `articles` (`ID`, `Title`, `Content`, `Date`, `UserID`, `CategoryID`)
VALUES (1, 'Second article',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vitae neque non nisl congue tincidunt non in nunc. Donec fringilla viverra ipsum ut commodo. In et convallis turpis. Maecenas eget metus cursus, dignissim ex id, feugiat nunc. Donec suscipit posuere ultrices. Pellentesque eget nibh a justo aliquet dapibus. Fusce pharetra tincidunt ultrices. Morbi pretium erat eleifend nulla efficitur aliquam. Sed consectetur dapibus aliquet. Integer laoreet sodales lacus. In vel arcu sit amet quam bibendum finibus eget quis turpis. Etiam urna sapien, ultricies eu blandit eget, cursus nec nunc.<br>Suspendisse eu diam congue, aliquam magna eu, gravida sem. Vivamus mattis diam eu gravida dictum. Nam nec nulla ut orci pellentesque rutrum eget id tellus. Morbi vel dapibus ipsum. Suspendisse potenti. Nulla gravida dolor id diam rhoncus aliquam. Suspendisse suscipit a odio quis dapibus. Curabitur porttitor risus nibh, et eleifend mauris tempus volutpat. Pellentesque aliquet, felis non convallis interdum, nibh velit vestibulum arcu, vitae pulvinar massa nunc vel orci. Nulla eu magna a nibh tincidunt dictum. Maecenas convallis enim et velit ornare, quis convallis risus consequat.<br>Donec lacinia nulla ac eros vehicula venenatis id vel augue. Nullam ullamcorper maximus felis, sed convallis sem commodo cursus. Donec vulputate massa eros, non finibus lectus eleifend a. Duis venenatis iaculis dapibus. Quisque mattis nunc massa, sit amet rhoncus ex convallis a. Pellentesque blandit malesuada magna, eget facilisis tellus finibus at. Suspendisse vitae libero ut ligula commodo tristique. Proin sit amet libero in velit porta ornare vel vel metus. Pellentesque tristique nunc id tellus fringilla, eget volutpat magna consequat. Curabitur et euismod elit. Etiam congue libero id eros egestas, vel bibendum urna venenatis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
        '2019-12-07 18:49:12', 1, 1),
       (2, 'First article',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vitae neque non nisl congue tincidunt non in nunc. Donec fringilla viverra ipsum ut commodo. In et convallis turpis. Maecenas eget metus cursus, dignissim ex id, feugiat nunc. Donec suscipit posuere ultrices. Pellentesque eget nibh a justo aliquet dapibus. Fusce pharetra tincidunt ultrices. Morbi pretium erat eleifend nulla efficitur aliquam. Sed consectetur dapibus aliquet. Integer laoreet sodales lacus. In vel arcu sit amet quam bibendum finibus eget quis turpis. Etiam urna sapien, ultricies eu blandit eget, cursus nec nunc.<br>Suspendisse eu diam congue, aliquam magna eu, gravida sem. Vivamus mattis diam eu gravida dictum. Nam nec nulla ut orci pellentesque rutrum eget id tellus. Morbi vel dapibus ipsum. Suspendisse potenti. Nulla gravida dolor id diam rhoncus aliquam. Suspendisse suscipit a odio quis dapibus. Curabitur porttitor risus nibh, et eleifend mauris tempus volutpat. Pellentesque aliquet, felis non convallis interdum, nibh velit vestibulum arcu, vitae pulvinar massa nunc vel orci. Nulla eu magna a nibh tincidunt dictum. Maecenas convallis enim et velit ornare, quis convallis risus consequat.<br>Donec lacinia nulla ac eros vehicula venenatis id vel augue. Nullam ullamcorper maximus felis, sed convallis sem commodo cursus. Donec vulputate massa eros, non finibus lectus eleifend a. Duis venenatis iaculis dapibus. Quisque mattis nunc massa, sit amet rhoncus ex convallis a. Pellentesque blandit malesuada magna, eget facilisis tellus finibus at. Suspendisse vitae libero ut ligula commodo tristique. Proin sit amet libero in velit porta ornare vel vel metus. Pellentesque tristique nunc id tellus fringilla, eget volutpat magna consequat. Curabitur et euismod elit. Etiam congue libero id eros egestas, vel bibendum urna venenatis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
        '2019-12-07 18:49:12', 1, 1),
       (3, 'Third article',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vitae neque non nisl congue tincidunt non in nunc. Donec fringilla viverra ipsum ut commodo. In et convallis turpis. Maecenas eget metus cursus, dignissim ex id, feugiat nunc. Donec suscipit posuere ultrices. Pellentesque eget nibh a justo aliquet dapibus. Fusce pharetra tincidunt ultrices. Morbi pretium erat eleifend nulla efficitur aliquam. Sed consectetur dapibus aliquet. Integer laoreet sodales lacus. In vel arcu sit amet quam bibendum finibus eget quis turpis. Etiam urna sapien, ultricies eu blandit eget, cursus nec nunc.<br>Suspendisse eu diam congue, aliquam magna eu, gravida sem. Vivamus mattis diam eu gravida dictum. Nam nec nulla ut orci pellentesque rutrum eget id tellus. Morbi vel dapibus ipsum. Suspendisse potenti. Nulla gravida dolor id diam rhoncus aliquam. Suspendisse suscipit a odio quis dapibus. Curabitur porttitor risus nibh, et eleifend mauris tempus volutpat. Pellentesque aliquet, felis non convallis interdum, nibh velit vestibulum arcu, vitae pulvinar massa nunc vel orci. Nulla eu magna a nibh tincidunt dictum. Maecenas convallis enim et velit ornare, quis convallis risus consequat.<br>Donec lacinia nulla ac eros vehicula venenatis id vel augue. Nullam ullamcorper maximus felis, sed convallis sem commodo cursus. Donec vulputate massa eros, non finibus lectus eleifend a. Duis venenatis iaculis dapibus. Quisque mattis nunc massa, sit amet rhoncus ex convallis a. Pellentesque blandit malesuada magna, eget facilisis tellus finibus at. Suspendisse vitae libero ut ligula commodo tristique. Proin sit amet libero in velit porta ornare vel vel metus. Pellentesque tristique nunc id tellus fringilla, eget volutpat magna consequat. Curabitur et euismod elit. Etiam congue libero id eros egestas, vel bibendum urna venenatis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
        '2019-12-07 18:49:12', 1, 1);