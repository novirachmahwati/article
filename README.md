# Article Web Service

## Introduction
Hello👋, my name is Novi Rachmahwati. This project is developed as part of the Backend Developer Technical Test for Sagala company.

## Project Description
This web service provides an API for creating and retrieving articles. It has been designed to manage high traffic loads by incorporating Redis caching. The use of Redis helps mitigate performance issues that can arise from sudden surges in request volume.


## Features
- **Create New Articles**: Allows users to add new articles with details such as author, title, and body.
- **Retrieve Articles**: Fetches a list of articles with support for optional query parameters to search by keyword and filter by author.
- **Caching with Redis**: Uses Redis to cache frequently accessed data, enhancing performance and handling spikes in traffic effectively.


## Technologies Used
- PHP (Version 8.3.9)
- Laravel Framework (Version 11.1.3)
- Redis
- Composer
- MySQL

## Installation
1. Clone the repository:
    ```sh
    git clone https://github.com/novirachmahwati/article.git
    ```
2. Navigate to the project directory:
    ```sh
    cd article
    ```
3. Install dependencies:
    ```sh
    composer install
    ```
4. Set up the environment variables:
    ```sh
    cp .env.example .env
    ```
5. Update the `.env` file with your database configuration:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

   Make sure to replace `your_database_name`, `your_database_username`, and `your_database_password` with your actual database credentials.

6. Generate Application Key:
    ```sh
    php artisan key:generate
    ```

7. Run the migrations:
    ```sh
    php artisan migrate
    ```

8. Install and Start Redis:
Follow the instructions to install Redis for your operating system:
- macOS:
    ```sh
    brew install redis
    brew services start redis
    ```
- Ubuntu/Debian:
    ```sh
    sudo apt-get update
    sudo apt-get install redis-server
    sudo systemctl enable redis-server.service
    sudo systemctl start redis-server.service
    ```
- Windows:
Download and install Redis from [Redis for Windows](https://github.com/microsoftarchive/redis/releases).

9. Configure Redis in .env File:
    ```sh
    CACHE_DRIVER=redis
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379
    ```

10. Start the Laravel Server:
    ```sh
    php artisan serve
    ```

## API Endpoints
### Create an Article
- URL: `/api/articles`
- Method: `POST`
- Description: Create a new article with the given details.
- Request Body:
```
{
  "author": "John Doe",
  "title": "Sample Article",
  "body": "This is a sample article body."
}
```
- Response:
```
{
  "id": 1,
  "author": "John Doe",
  "title": "Sample Article",
  "body": "This is a sample article body.",
  "created_at": "2024-08-05T12:34:56.000000Z",
  "updated_at": "2024-08-05T12:34:56.000000Z"
}
```
### Get Articles
- URL: `/api/articles`
- Method: `GET`
- Description: Retrieve a list of articles. Supports optional query parameters for searching and filtering.
- Query Parameters:
    - query (optional): Keyword to search in the article title and body.
    - author (optional): Filter articles by the author's name.
- Response:
```
[
  {
    "id": 1,
    "author": "John Doe",
    "title": "Sample Article",
    "body": "This is a sample article body.",
    "created_at": "2024-08-05T12:34:56.000000Z",
    "updated_at": "2024-08-05T12:34:56.000000Z"
  },
  ...
]
```

## Running Tests
To ensure the service works as expected, run the tests:
```sh
php artisan test
```
Integration tests are located in the **tests/Feature/ArticleControllerTest.php** file. These tests cover the core functionality of creating and retrieving articles.