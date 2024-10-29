# Ticket Management Portal

## Overview

This project is a Ticket Management Portal built using Laravel, designed to facilitate efficient management of support tickets. The portal allows users to create, update, and track tickets, enhancing communication between users and support teams. The application features role-based access control for different user roles, including Sales, Managers, Super Admins, and Employees.

## Features

- User Roles: Different access levels for Sales, Managers, Super Admins, and Employees.
- Ticket Creation: Users can easily create new support tickets.
- Status Tracking: Users can view and update ticket statuses (Open, In Progress, Closed).
- Notifications: Users receive alerts for new updates on tickets.
- Search and Filter: Ability to search and filter tickets based on various criteria.
- Responsive Design: User-friendly interface suitable for various devices.

## Technologies Used

- Laravel: PHP framework for building web applications.
- MySQL: Database management system for storing ticket information.
- Bootstrap: CSS framework for responsive design.
- JavaScript: For enhancing user interactivity.

## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/jamshedgopang55/portal.git
   cd ticket-management-portal  
 2. **Install dependencies:**
     ```bash
     composer install
     
3. **Set up the environment:**
    rename .env.example to .env.
   Configure your database settings in the .env file.

4. **Generate application key:**
 ```bash
 php artisan key:generate

```
5. **Run migrations:**
 ```bash
php artisan migrate 

```
5. **Start the server:**
 ```bash
php artisan serve  
```

### Notes:
- The **Key Changes Made** section lists the significant enhancements to provide context for anyone reviewing the project.
- Adjust any specific details according to your project's needs before uploading to GitHub!

**License**

This project is licensed under the MIT License - see the LICENSE file for details.