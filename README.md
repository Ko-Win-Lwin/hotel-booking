# Hotel Booking System

## Overview
A hotel booking system built using Vue.js for the frontend and Laravel for the backend. Users can view available rooms, make bookings, and view booking statistics. Admins can manage rooms, bookings, and view statistical data.

## AI Tools Used
- **Tool 1**: ChatGPT.

## Features
- Users can view available rooms/slots.
- Users can book a room/slot by selecting a date and time.
- Admins can manage rooms, bookings, and view statistics.
  
## Setup Instructions

1. Clone the repository.

```bash
git clone https://github.com/your-username/hotel-booking-system.git
```

# Laravel Setup Instructions

Follow these steps to set up the Laravel project.

## 1. Navigate to the Backend Folder

```bash
cd hotel-booking/backend/booking
```

## 2. Install Composer Dependencies

```bash
composer install
```

## 3. Create a `.env` File and Configure the Database

```bash
cp .env.example .env
```

Open the `.env` file in your preferred text editor and update the database configuration:

```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
```

## 4. Run Migrations

```bash
php artisan migrate
```

This will create the necessary database tables.

## 5. Start the Laravel Server

```bash
php artisan serve
```

The application will be accessible at `http://localhost:8000` by default.

## Additional Commands

- **Clear Cache:**
  ```bash
  php artisan cache:clear
  ```



  
# Frontend Setup (Vue.js)

Follow these steps to set up the Vue.js frontend.

## 1. Navigate to the Frontend Folder

```bash
cd hotel-booking/frontend/booking
```

## 2. Install Dependencies

```bash
npm install
```

## 3. Start the Vue Development Server

```bash
npm run dev
```


# Limitations or Incomplete Features

## Incomplete Feature 1: Authentication Implementation

Currently, the authentication feature is not fully implemented. Ideally, the backend should respond with a token upon successful authentication, and the frontend should store this token for secure communication and session management.

However, due to limited experience with frontend-backend integration, I encountered errors and difficulties in implementing this feature. As a temporary solution, I am using the `user_id` to handle authentication and authorization processes.

### Planned Improvements:
- Implement token-based authentication to enhance security.
- Properly store and manage tokens on the frontend.
- Refactor the authentication flow for seamless integration.

This will be addressed and fixed in future updates.





   



