use storedb;
/*
insert into cat (cat) values ('Adventure');
insert into cat (cat) values ('Crime');
insert into cat (cat) values ('Thriller');
insert into cat (cat) values ('Drama');
insert into cat (cat) values ('Comedy');
insert into cat (cat) values ('Horror');
insert into cat (cat) values ('Fiction');
insert into cat (cat) values ('Sci-Fi');
insert into cat (cat) values ('Mystery');
insert into cat (cat) values ('Suspense');
insert into cat (cat) values ('Non-Fiction');
insert into cat (cat) values ('Romance');
insert into cat (cat) values ('Fantasy');
insert into cat (cat) values ('Textbook');
insert into cat (cat) values ('Tutorial');
insert into cat (cat) values ('Science');
insert into cat (cat) values ('Autobiography');
insert into cat (cat) values ('Self Help');
*/

select * from storedb.book;
select * from storedb.cat;
select * from storedb.author;

select * from storedb.format

select bookIsbn_author from storedb.author where authorName='Iain M Banks';


truncate table storedb.book;
truncate table storedb.author;
truncate table storedb.format;


use storedb;
SELECT COUNT(bookId) AS nCount FROM storedb.book

select * from storedb.book;
SELECT COUNT(catId) AS count from storedb.book GROUP BY catId;
SELECT COUNT(bookTitle) FROM storedb.book where catId=16 HAVING count(bookTitle) >= 9;

SELECT COUNT(authorName) AS count FROM storedb.author GROUP BY authorName;

use storedb;
SELECT COUNT(bookIsbn_author) AS count FROM author WHERE authorName like '%Stephen%';

alter table storedb.book
add fk_rating foreign key(bookIsbn) references rating.bookIsbn_rating;








