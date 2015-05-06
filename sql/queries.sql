--the first and last name of the person who posted, with the book title
--1)
select first_name, last_name, title 
from user_posts, users, book_posts, books 
where user_posts.user_id = users.user_id 
and book_posts.book_id = books.book_id 
and book_posts.post_id = user_posts.post_id;

--selects the first, last, and the content and date for all the posts for every user
--2)
select first_name, last_name, content, date, user_name 
from user_posts, users, book_posts, posts 
where user_posts.user_id = users.user_id 
and user_posts.post_id = posts.post_id
group by first_name;

--inserts a user submitted to the database, and links the connection between the user
--and the submitted book. These queries have to occur in the order given below.

insert into books values(null, :title, :author_first, :author_last, :year_published, :pages, :isbn, :image_path);
select user_id from users where user_name = :user_name	
select book_id from books where title = :title
insert into user_books values(:user_id, :book_id)