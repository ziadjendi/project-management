
# Project Management Application

This is a Laravel-based API application designed to manage users, projects, and timesheets. Users can be assigned to multiple projects, and timesheets can be logged for each project a user is involved in.

## Table of Contents

- [Installation](#installation)
- [Running the Application](#running-the-application)
  - [Database Configuration](#database-configuration)
  - [Running with Docker](#running-with-docker)
- [API Endpoints](#api-endpoints)
  - [Authentication](#authentication)
  - [Users](#users)
  - [Projects](#projects)
  - [Timesheets](#timesheets)
- [Usage Guide](#usage-guide)
  - [Generate Users](#generate-users)
  - [Create Projects](#create-projects)
  - [Assign Users to Projects](#assign-users-to-projects)
  - [Log Timesheets](#log-timesheets)
  - [Filter Examples](#filter-examples)
- [Postman Collection](#postman-collection)
- [License](#license)

## Installation

### Step 1: Clone the Repository

```bash
git clone https://github.com/ziadjendi/project-management.git
cd project-management
```

### Step 2: Install Dependencies

```bash
composer install
```

### Step 3: Create and Configure the `.env` File

```bash
cp .env.example .env
```

Update the `.env` file with your database credentials and other necessary configurations.

### Step 4: Generate Application Key

```bash
php artisan key:generate
```

### Step 5: Install Laravel Sanctum for API Authentication

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

## Running the Application

### Database Configuration

This application uses **MySQL** as the database. The database connection details are configured in the `.env` file:

- **DB_CONNECTION**: `mysql`
- **DB_HOST**: `mysql_db`
- **DB_PORT**: `3306`
- **DB_DATABASE**: `my_database`
- **DB_USERNAME**: `my_user`
- **DB_PASSWORD**: `my_password`

Ensure you have MySQL installed and running, then migrate the database:

```bash
php artisan migrate
```

### Running with Docker

You can use Docker to easily set up and run the application along with the MySQL database.

#### Step 1: Build and Run the Docker Containers

```bash
docker compose up --build
```

This command builds the Docker images, sets up the MySQL database, and starts the application.

#### Step 2: Access the Application

The application should now be running and accessible on `http://localhost:8000`.

#### Step 3: Stop the Application

To stop the application, run:

```bash
docker compose down
```

## API Endpoints

### Authentication

- **Register:** `POST /api/register`
- **Login:** `POST /api/login`
- **Logout:** `POST /api/logout`

### Users

- **Create User:** `POST /api/users`
- **List Users:** `GET /api/user`
- **Show User:** `GET /api/user/{id}`
- **Update User:** `POST /api/user/update`
- **Delete User:** `POST /api/user/delete`

### Projects

- **Create Project:** `POST /api/project`
- **List Projects:** `GET /api/project`
- **Show Project:** `GET /api/project/{id}`
- **Update Project:** `POST /api/project/update`
- **Delete Project:** `POST /api/project/delete`
- **Assign Users to Project:** `POST /api/project/{project}/assign-users`
- **Get Users Assigned to Project:** `GET /api/project/{project}/users`

### Timesheets

- **Create Timesheet:** `POST /api/timesheet`
- **List Timesheets:** `GET /api/timesheet`
- **Show Timesheet:** `GET /api/timesheet/{id}`
- **Update Timesheet:** `POST /api/timesheet/update`
- **Delete Timesheet:** `POST /api/timesheet/delete`

## Usage Guide

### Generate Users

1. **Register a New User:**

   ```bash
   curl -X POST http://localhost:8000/api/register -H "Content-Type: application/json" -d '{
       "first_name": "John",
       "last_name": "Doe",
       "date_of_birth": "1990-01-01",
       "gender": "male",
       "email": "john.doe@example.com",
       "password": "password",
       "password_confirmation": "password"
   }'
   ```

2. **Login the User:**

   ```bash
   curl -X POST http://localhost:8000/api/login -H "Content-Type: application/json" -d '{
       "email": "john.doe@example.com",
       "password": "password"
   }'
   ```

   Save the `token` from the response to use in authenticated requests.

### Create Projects

1. **Create a New Project:**

   ```bash
   curl -X POST http://localhost:8000/api/project -H "Authorization: Bearer your_token" -H "Content-Type: application/json" -d '{
       "name": "Project A",
       "department": "Engineering",
       "start_date": "2024-09-01",
       "end_date": "2024-12-31",
       "status": "planned"
   }'
   ```

### Assign Users to Projects

1. **Assign Users to a Project:**

   ```bash
   curl -X POST http://localhost:8000/api/project/1/assign-users -H "Authorization: Bearer your_token" -H "Content-Type: application/json" -d '{
       "user_ids": [1, 2, 3]
   }'
   ```

### Log Timesheets

1. **Create a Timesheet Entry:**

   ```bash
   curl -X POST http://localhost:8000/api/timesheet -H "Authorization: Bearer your_token" -H "Content-Type: application/json" -d '{
       "task_name": "Design the homepage",
       "date": "2024-09-01",
       "hours": 4,
       "user_id": 1,
       "project_id": 2
   }'
   ```

### Filter Examples

1. **Filter Users by First Name and Gender:**

   ```bash
   curl -X GET "http://localhost:8000/api/user?first_name=John&gender=male" -H "Authorization: Bearer your_token"
   ```

2. **Filter Projects by Department and Status:**

   ```bash
   curl -X GET "http://localhost:8000/api/project?department=Engineering&status=planned" -H "Authorization: Bearer your_token"
   ```

3. **Filter Timesheets by Date and User ID:**

   ```bash
   curl -X GET "http://localhost:8000/api/timesheet?date=2024-09-01&user_id=1" -H "Authorization: Bearer your_token"
   ```

## Postman Collection

A Postman collection with all API endpoints is included in this repository. This collection provides a convenient way to test and interact with the API.

### Importing the Postman Collection

1. **Download the Postman Collection:**
   
   The Postman collection file is located in the `postman` directory within this repository. The file is named `ProjectManagement.postman_collection.json`.

2. **Import the Collection into Postman:**

   - Open Postman.
   - Click on the `Import` button located in the top-left corner of the Postman interface.
   - Select the `Upload Files` tab.
   - Choose the `ProjectManagement.postman_collection.json` file from the `postman` directory.
   - Click `Import`.

3. **Using the Collection:**

   Once imported, the collection will appear in your Postman sidebar. You can expand the collection to see all the available API requests. These requests are pre-configured with the necessary endpoints, headers, and sample payloads. You can modify the payloads and headers as needed to test different scenarios.

### Running the Requests

1. **Ensure the Application is Running:**

   Make sure the application is running on `http://localhost:8000`.

2. **Set Up Environment Variables:**

   You may need to set up environment variables in Postman for things like the base URL and API tokens. You can do this by creating a new environment in Postman and defining variables such as `HOSTNAME` and `AUTH`.

3. **Execute Requests:**

   - Select the desired request from the collection.
   - Click `Send` to execute the request.
   - The response from the server will be displayed in the Postman interface.

## License

This project is open-source and available under the [MIT License](LICENSE).
