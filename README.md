## API Book Store

This project is an API for managing books and stores. It allows users to perform CRUD operations on books and stores, as well as associating books with stores.

### Technologies Used

- ![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white): Laravel is used as the PHP framework for building the API.
- ![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white): MySQL is used as the relational database management system for storing data.

### Other Concepts and Libraries

- **Domain-Driven Design (DDD)**: The project follows the principles of DDD to organize the codebase into meaningful domains and layers.
- **PHPUnit**: PHPUnit is used for unit testing the application's codebase.
- **Insomnia**: Insomnia can be used for testing the API endpoints during development.

### Features

- **Book Management**: CRUD operations for managing books.
- **Store Management**: CRUD operations for managing stores.
- **Associating Books with Stores**: Ability to associate books with stores.
- **Authentication and Authorization**: Authentication and authorization mechanisms to protect certain endpoints or actions.

### API Endpoints

#### Books
- **GET /api/books**: Get all books.
- **POST /api/books**: Create a new book.
- **PUT /api/books/{id}**: Update a book.
- **DELETE /api/books/{id}**: Delete a book.
- **POST /api/books/{book_id}/stores/{store_id}**: Shows all stores that carry the book.

#### Stores
- **GET /api/stores**: Get all stores.
- **POST /api/stores**: Create a new store.
- **PUT /api/stores/{id}**: Update a store.
- **DELETE /api/stores/{id}**: Delete a store.
- **GET /api/stores/{id}/books**: Shows all the books in that store.
- **DELETE /api/stores/remove/{store_id}/{book_id}**: Dissociate a book from a store.

#### User
- **GET /api/login**: Authenticate user credentials.
- **POST /api/logout**: Logout user.

### JSON

### JSON

#### Books
- **POST e PUT**:
```json
{
    "name": "Name's book",
    "isbn": "isbn code",
    "value": 0,
    "stores": [] // Insert stores ids here
}
```

#### Stores
- ** POST AND PUT **:
```json
{
    "name": "Store's name",
    "address": "Address",
    "active": true,
    "books": [] // <- Insert book ids here
}
```

### Testing

To run the tests, use the following command (only login and logout have tests):

```bash
php artisan test
```

### Comments

It was very interesting to develop this API and to be honest I hadn't used DDD yet, I just knew the concepts. But by researching and reading I managed to make good use of it. Knowing the SOLID and Clean code principles helped me develop. I hope you like the API.

#### Developed with coffee by Jonatas Bueno
