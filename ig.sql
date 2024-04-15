drop table Accountowns;
DROP TABLE Hashtag;
DROP TABLE Comments;
DROP TABLE Posts;
DROP TABLE Users;
DROP TABLE NotificationsSend;
DROP TABLE StoriesShare;
DROP TABLE Reel;
DROP TABLE FeedPost;
DROP TABLE MakeComments;
DROP TABLE Contain;
DROP TABLE HashtagHasPost;



CREATE TABLE HashtagHasPost(hashID INTEGER, postID INTEGER);
CREATE TABLE Hashtag (
			hashID int PRIMARY KEY,
			hashName VARCHAR(10));

CREATE TABLE Users(
			userID INTEGER,
			gender VARCHAR(3),
			generation VARCHAR(10),
			fullName VARCHAR(30),
			age INTEGER,
			birthdate DATE,
			PRIMARY KEY (userID) 
		  );


CREATE TABLE Accountowns(
			userName VARCHAR(10),
			displayName VARCHAR(10),
			numFollowing INTEGER,
			numFollowers INTEGER,
			numPosts INTEGER,
			userID INTEGER,
			PRIMARY KEY (userName, userID),
			FOREIGN KEY (userID) REFERENCES Users(userID) ON DELETE CASCADE
		  );

CREATE TABLE Posts(
			PostID INTEGER,
			location VARCHAR(20),
			postDate DATE,
			userID INTEGER,
			PRIMARY KEY (PostID),
			FOREIGN KEY (userID) REFERENCES Users(userID) ON DELETE CASCADE
		  );
 
CREATE TABLE Reel(
    text VARCHAR(15),
    length INTEGER,
    postID INTEGER,
    location VARCHAR(20),
    postDate date,
    PRIMARY KEY (postID));

CREATE TABLE FeedPost(
    text VARCHAR(15), 
    numImage INTEGER,
    postID INTEGER,
    location VARCHAR(20),
    postDate date,
    PRIMARY KEY(postID));

CREATE TABLE NotificationsSend(
    PostLink VARCHAR(20),
    text VARCHAR(20),
    time TIMESTAMP,
    storyID INTEGER,
    PRIMARY KEY (storyID));

CREATE TABLE Comments(
			commentText VARCHAR(20),
			commentID INTEGER,
			commentDate DATE,
			userID INTEGER,
			postID INTEGER,
			PRIMARY KEY (commentID),
			FOREIGN KEY (userID) REFERENCES Users(userID)  ON DELETE CASCADE,
			FOREIGN KEY (postID) REFERENCES Posts(PostID)  ON DELETE CASCADE
		  );

CREATE TABLE MakeComments(
    text CHAR(20),
    commentID INTEGER,
    commentDate DATE,
    userName VARCHAR(20) NOT NULL,
    userID INTEGER NOT NULL
);

CREATE TABLE StoriesShare(
    storyID INTEGER, 
    duration DATE, 
    URL VARCHAR(20),
    userName VARCHAR(20),
    userID INTEGER);

CREATE TABLE LikesDoubletapHas(
    likeID INTEGER, 
    numLikes INTEGER, 
    like_date DATE, 
    postID INTEGER NOT NULL,
    userID INTEGER, 
    commentID INTEGER,
    PRIMARY KEY (likeID),
    FOREIGN KEY (postID) REFERENCES Posts(postID) ON DELETE CASCADE,
    FOREIGN KEY (userID) REFERENCES Users(userID) ON DELETE CASCADE,
    FOREIGN KEY (commentID) REFERENCES Comments(commentID) ON DELETE CASCADE
);

CREATE TABLE Contain(commentID INTEGER, postID INTEGER);

INSERT 
		INTO Users(userID, gender, generation, fullName, age, birthdate) 
		VALUES (1111, 'F', 'Boomer',  'Emily Davis', 35, TO_DATE('1988-02-19', 'YYYY-MM-DD'));
INSERT 
		INTO Users(userID, gender, generation, fullName, age, birthdate) 
		VALUES (4444, 'M', 'Boomer',  'Siri', 22, TO_DATE('2002-06-19', 'YYYY-MM-DD'));
INSERT 
		INTO Users(userID, gender, generation, fullName, age, birthdate) 
		VALUES (5555, 'M', 'Alpha',  'Jessie', 17, TO_DATE('2006-02-19', 'YYYY-MM-DD'));

INSERT 
		INTO Users(userID, gender, generation, fullName, age, birthdate) 
		VALUES (6666, 'M', 'Millenial',  'Travis Scott', 35, TO_DATE('1995-02-19', 'YYYY-MM-DD'));
INSERT 
		INTO Users(userID, gender, generation, fullName, age, birthdate) 
		VALUES (7777, 'M', 'Alpha',  'Small Child', 35, TO_DATE('2012-02-19', 'YYYY-MM-DD'));

INSERT 
		INTO Users(userID, gender, generation, fullName, age, birthdate) 
		VALUES (2222, 'F', 'Z',  'Zoey Ma', 19, TO_DATE('2004-04-19', 'YYYY-MM-DD'));

INSERT 
		INTO Users(userID, gender, generation, fullName, age, birthdate) 
		VALUES (3333, 'M', 'Z',  'Siri', 18, TO_DATE('2005-07-05', 'YYYY-MM-DD'));

INSERT 
		  INTO Posts(PostID, location, postDate, userID) 
		  VALUES (2002, 'Vancouver', TO_DATE('2024-04-04', 'YYYY-MM-DD'),  2222);

INSERT 
		  INTO Posts(PostID, location, postDate, userID) 
		  VALUES (2003, 'Vancouver', TO_DATE('2024-04-04', 'YYYY-MM-DD'),  3333);

INSERT 
		  INTO Posts(PostID, location, postDate, userID) 
		  VALUES (2004, 'Toronto', TO_DATE('2024-04-04', 'YYYY-MM-DD'),  2222);

INSERT 
          INTO NotificationsSend(PostLink, text, time, storyID)
          VALUES ('https:postlink1', 'text1', TO_DATE('2023-12-01 00:00:01', 'YYYY-MM-DD HH24:MI:SS'), 1234);


INSERT 
          INTO NotificationsSend(PostLink, text, time, storyID)
          VALUES ('https:postlink2', 'text2', TO_DATE('2023-09-01 12:00:01', 'YYYY-MM-DD HH24:MI:SS'), 2235);

INSERT 
          INTO NotificationsSend(PostLink, text, time, storyID)
          VALUES ('https:postlink2', 'text2', TO_DATE('2024-12-01 00:00:01', 'YYYY-MM-DD HH24:MI:SS'), 5534);
        

INSERT 
            INTO StoriesShare(storyID, duration, URL, userName, userID)
            VALUES (1234, TO_DATE('2024-04-04', 'YYYY-MM-DD'), 'http::1', 'Emily Davis',1111);

INSERT 
            INTO StoriesShare(storyID, duration, URL, userName, userID)
            VALUES (2235, TO_DATE('2024-07-04', 'YYYY-MM-DD'), 'http::2', 'Emily Davis',1111);

INSERT 
            INTO StoriesShare(storyID, duration, URL, userName, userID)
            VALUES (5534, TO_DATE('2024-04-01', 'YYYY-MM-DD'), 'http::3', 'Emily Davis',1111);


INSERT 
            INTO Reel(text, length, postID, location, postDate)
            VALUES ('text1', 20, 11111, 'toronto', TO_DATE('2024-04-01', 'YYYY-MM-DD'));


INSERT 
            INTO Reel(text, length, postID, location, postDate)
            VALUES ('text1', 78, 22222, 'toronto', TO_DATE('2023-05-01', 'YYYY-MM-DD'));

INSERT 
            INTO Reel(text, length, postID, location, postDate)
            VALUES ('text1', 90, 44444, 'toronto', TO_DATE('2024-09-01', 'YYYY-MM-DD'));


INSERT 
            INTO FeedPost(text, numImage, postID, location, postDate)
            VALUES ('text1', 3, 782, 'Victoria', TO_DATE('2016-09-01', 'YYYY-MM-DD'));

INSERT 
            INTO FeedPost(text, numImage, postID, location, postDate)
            VALUES ('text1', 7, 3267, 'Mexico', TO_DATE('2019-09-01', 'YYYY-MM-DD'));
  

INSERT 
            INTO FeedPost(text, numImage, postID, location, postDate)
            VALUES ('text1', 9, 2783, 'Pender Island', TO_DATE('2020-09-01', 'YYYY-MM-DD'));

INSERT INTO Hashtag(hashID, hashName) VALUES (1, 'travel');
INSERT INTO Hashtag(hashID, hashName) VALUES (2, 'food');
INSERT INTO Hashtag(hashID, hashName) VALUES (3, 'nature');

-- Insert data into Accountowns table
INSERT INTO Accountowns(userName, displayName, numFollowing, numFollowers, numPosts, userID) VALUES ('user1', 'User One', 100, 200, 50, 1111);
INSERT INTO Accountowns(userName, displayName, numFollowing, numFollowers, numPosts, userID) VALUES ('user2', 'User Two', 150, 300, 70, 2222);
INSERT INTO Accountowns(userName, displayName, numFollowing, numFollowers, numPosts, userID) VALUES ('user3', 'User Three', 200, 400, 90, 3333);

-- Insert data into Contain table
INSERT INTO Contain(commentID, postID) VALUES (101, 2002);
INSERT INTO Contain(commentID, postID) VALUES (102, 2003);
INSERT INTO Contain(commentID, postID) VALUES (103, 2004);

-- Insert data into HashtagHasPost table
INSERT INTO HashtagHasPost(hashID, postID) VALUES (1, 2002);
INSERT INTO HashtagHasPost(hashID, postID) VALUES (2, 2003);
INSERT INTO HashtagHasPost(hashID, postID) VALUES (3, 2004);

-- Insert data into MakeComments table
INSERT INTO MakeComments(text, commentID, commentDate, userName, userID) VALUES ('Great post!', 101, TO_DATE('2024-04-04', 'YYYY-MM-DD'), 'user1', 1111);
INSERT INTO MakeComments(text, commentID, commentDate, userName, userID) VALUES ('Nice!', 102, TO_DATE('2024-04-05', 'YYYY-MM-DD'), 'user2', 2222);
INSERT INTO MakeComments(text, commentID, commentDate, userName, userID) VALUES ('Beautiful!', 103, TO_DATE('2024-04-06', 'YYYY-MM-DD'), 'user3', 3333);
INSERT 
		  INTO Posts(PostID, location, postDate, userID) 
		  VALUES (2005, 'Calgary', TO_DATE('2024-04-04', 'YYYY-MM-DD'),  4444);
INSERT 
		  INTO Posts(PostID, location, postDate, userID) 
		  VALUES (2006, 'Calgary', TO_DATE('2024-08-04', 'YYYY-MM-DD'),  4444);
-- Insert data into Comments table
INSERT INTO Comments(commentText, commentID, commentDate, userID, postID) VALUES ('Great photo!', 101, TO_DATE('2024-04-04', 'YYYY-MM-DD'), 2222, 2002);
INSERT INTO Comments(commentText, commentID, commentDate, userID, postID) VALUES ('Amazing!', 102, TO_DATE('2024-04-05', 'YYYY-MM-DD'), 3333, 2003);
INSERT INTO Comments(commentText, commentID, commentDate, userID, postID) VALUES ('Love it!', 103, TO_DATE('2024-04-06', 'YYYY-MM-DD'), 1111, 2004);

-- Insert data into LikesDoubletapHas table
INSERT INTO LikesDoubletapHas(likeID, numLikes, like_date, postID, userID, commentID) VALUES (11, 10, TO_DATE('2024-04-04', 'YYYY-MM-DD'), 2002, 1111, 101);
INSERT INTO LikesDoubletapHas(likeID, numLikes, like_date, postID, userID, commentID) VALUES (22, 15, TO_DATE('2024-04-05', 'YYYY-MM-DD'), 2003, 2222, 102);
INSERT INTO LikesDoubletapHas(likeID, numLikes, like_date, postID, userID, commentID) VALUES (33, 20, TO_DATE('2024-04-06', 'YYYY-MM-DD'), 2004, 3333, 103);
