select first_name, last_name, title 
from user_posts, users, book_posts, books 
where user_posts.user_id = users.user_id 
and book_posts.book_id = books.book_id 
and book_posts.post_id = user_posts.post_id;