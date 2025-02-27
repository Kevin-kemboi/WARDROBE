# Wardrobe Management System

A web-based wardrobe management system built with **Vue 3** for the frontend and **Laravel 11** for the backend.

## Features
- Add clothing items with category and image uploads
- View and manage wardrobe items
- Organized storage with proper validation and timestamps

## Requirements
Ensure you have the following installed on your system:
- **PHP** (>= 8.1)
- **Composer**
- **Node.js** (>= 16)
- **NPM or Yarn**
- **MySQL** (or any preferred database)

## Backend (Laravel) Setup
1. Clone the repository:
   ```sh
   git clone https://github.com/ElvisKemoi/Uzapoint-Assessment.git
   cd Uzapoint-Assessment/backend-wardrobe-management
   ```
2. Install dependencies:
   ```sh
   composer install
   ```
3. Copy the `.env.example` file and update database configurations:
   ```sh
   cp .env.example .env
   ```
   Set up the database connection in `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=wardrobe_db
   DB_USERNAME=root
   DB_PASSWORD=yourpassword
   ```
4. Generate an application key:
   ```sh
   php artisan key:generate
   ```
5. Run migrations:
   ```sh
   php artisan migrate
   ```
6. Serve the application:
   ```sh
   php artisan serve
   ```

## Frontend (Vue 3) Setup
1. Navigate to the frontend folder:
   ```sh
   cd ../frontend-wardrobe-management
   ```
2. Install dependencies:
   ```sh
   npm install
   ```
3. Start the development server:
   ```sh
   npm run dev
   ```

## API Endpoints
### Add Clothing Item (POST `/api/clothing-items`)
#### Request Body
```json
{
  "name": "T-Shirt",
  "category": "top",
  "image": "(file)"
}
```
#### Response
```json
{
  "message": "Clothing item added successfully!",
  "data": {
    "id": 1,
    "name": "T-Shirt",
    "category": "top",
    "image": "clothing_images/filename.jpg",
    "created_at": "2025-02-24T12:00:00Z",
    "updated_at": "2025-02-24T12:00:00Z"
  }
}
```

## Directory Structure
```
Uzapoint-Assessment/
│-- backend-wardrobe-management/    # Laravel Backend
│-- frontend-wardrobe-management/   # Vue 3 Frontend
│-- README.md   # Documentation
```

## Contribution
Feel free to submit pull requests to improve the system.

## License
This project is open-source and available under the MIT License.

"# WARDROBE" 
