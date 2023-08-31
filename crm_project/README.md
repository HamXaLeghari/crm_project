# CRM Project with Blog Post Functionality - Laravel Backend

This is a Laravel backend project that implements a small CRM (Customer Relationship Management) system with the additional feature of blog post functionality. The project allows companies or communities to create their own profiles, manage contacts, and publish blog posts based on categories. The application also implements role-based access control and utilizes stateless Passport authentication for enhanced security.

## Features

- User Registration and Authentication using Laravel Passport
- Role-based Access Control (RBAC) with Middleware and Gates
- Company/Community Creation by Root User/Owner
- CRUD Operations for Users and Contacts
- Blog Post Management with Categories
- User Profiles upon Signup

## Usage

Register a new user as the root user/owner.

Create companies/communities using the root user account.

Manage users and contacts within each company/community.

Utilize the RBAC middleware and gates for role-based access control to restrict user actions.

Publish blog posts with categories.

Users can manage their profiles upon signup.

## API Endpoints

Authentication

POST /api/signup: Register a new user.

POST /api/login: Log in and receive an access token.

Authenticated Routes (Root User/Owner)

GET /api/current-user: Get information about the current user.

POST /api/user/add: Add a new user.

GET /api/logout: Log out the current user.

Role Management

GET /api/role: List all roles.

POST /api/role/name: Find a role by name.

POST /api/role/id: Find a role by ID.

POST /api/role/add: Add a new role.

PUT /api/role/update: Update a role.

DELETE /api/role/delete: Delete a role.

Access Control

GET /api/access: List all access controls.

POST /api/access/add: Add a new access control.

PUT /api/access/update: Update an access control.

DELETE /api/access/delete: Delete an access control.

Service and Community Management

GET /api/services: List all services.

POST /api/service/add: Add a new service.

POST /api/service/update/{id}: Update a service.

POST /api/service/delete/{id}: Delete a service.

GET /api/communities: List all communities.

POST /api/community/add: Add a new community.

POST /api/community/update/{id}: Update a community.

POST /api/community/delete/{id}: Delete a community.

Blog Post Management

GET /api/blogs: List all blog posts.

POST /api/blog/add/{id}: Add a new blog post to a community.

POST /api/blog/update/{id}: Update a blog post.

POST /api/blog/delete/{id}: Delete a blog post.

POST /api/showbycategory/{id}: Show blog posts by category.

Category Management

GET /api/categories: List all categories.

POST /api/category/add: Add a new category.

POST /api/category/update/{id}: Update a category.

POST /api/category/delete/{id}: Delete a category.