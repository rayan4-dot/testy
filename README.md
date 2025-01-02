## DevBlog

This is a simple blogging platform built using PHP and MySQL. It includes features such as user authentication, article creation, editing, and deletion, as well as tagging and categorization.

### Features

- User Authentication: Users can create an account, log in, and log out.

- Article Creation: Users can create new articles with a title, content, and category.

- Article Editing: Users can edit their own articles, including changing the title, content, and category.

- Article Deletion: Users can delete their own articles.

- Tagging and Categorization: Users can add tags to their articles and categorize them into different categories.

### Database Structure

The database structure is designed to support the features of the application. It includes the following tables:

- users: Stores user information, including username, email, password, bio, profile picture, and more.

- articles: Stores article information, including title, content, category, tags, and more.

- categories: Stores category information, including name and id.

- tags: Stores tag information, including name and id.

- article_tags: Stores the relationship between articles and tags, including article_id and tag_id.

### Relationships

The database structure is designed to support the relationships between the tables. It includes the following relationships:

- Users and Articles:

1. One-to-Many relationship: One user (author) can write multiple articles.

2. Foreign Key: author_id in the articles table references id in the users table.

- Categories and Articles:

1. One-to-Many relationship: One category can have multiple articles.

2. Foreign Key: category_id in the articles table references id in the categories table.

- Articles and Tags:

1. Many-to-Many relationship: One article can have multiple tags, and one tag can be associated with multiple articles.

2. Join Table: article_tags with foreign keys article_id and tag_id references articles and tags tables respectively.