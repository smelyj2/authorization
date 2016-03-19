You can see it on YouTube :
https://www.youtube.com/watch?v=FR4DnZBq2Og&feature=youtu.be



Or see my example authentication on your computer:

    1) Copy the all contents from this folder to your lokalhost  Apache server.
    2) Create a database on the similarity of my:

        create database testtable;
	
	CREATE TABLE datas (
	    user_id int(20) unsigned auto_increment,
	    user_login varchar(30),
	    user_password varchar(30),
	    user_hash varchar(32),
	    PRIMARY KEY(user_id)
	)

	CREATE TABLE images (
	    image_id int(11) auto_increment,
	    image_content varchar(64),
	    image_owner int(20) unsigned unique,
	    PRIMARY KEY (image_id),
	    FOREIGN KEY (image_owner) REFERENCES datas (user_id) 
	)




So, thats all.
	
	
	