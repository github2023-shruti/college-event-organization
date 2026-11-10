# 🎓 College Event Organization System

A web-based College Event Organization System designed to simplify event management and student participation. The application provides separate interfaces for administrators and students to manage and access college events.

## 🚀 Project Overview

The College Event Organization System helps manage college events through an organized web interface. Administrators can manage events, while students can access the student dashboard and view available events.

## ✨ Features

### 👨‍💼 Admin Module
- Admin Registration
- Admin Login
- Admin Dashboard
- Add New Events
- Edit Existing Events
- Delete Events
- Manage Event Information

### 👨‍🎓 Student Module
- Student Registration
- Student Login
- Student Dashboard
- View Available Events

### 🔧 Other Features
- Separate Admin and Student Interfaces
- Backend API Integration
- Database Connectivity
- User Authentication
- Organized Frontend and Backend Structure

## 🛠️ Technologies Used

| Technology | Purpose |
|---|---|
| HTML5 | Frontend Structure |
| CSS3 | Styling and Design |
| JavaScript | Frontend Functionality |
| PHP | Backend Development |
| MySQL | Database Management |

## 📁 Project Structure

```text
college-event-organization/
│
├── backend/
│   ├── api/
│   │   ├── admin/
│   │   ├── events/
│   │   ├── student/
│   │   ├── init.php
│   │   └── logout.php
│   │
│   └── schema.sql
│
├── frontend/
│   ├── css/
│   ├── js/
│   ├── admin-dashboard.html
│   ├── admin-login.html
│   ├── admin-register.html
│   ├── student-dashboard.html
│   ├── student-login.html
│   └── student-register.html
│
└── README.md
```

## ⚙️ Installation and Setup

### 1. Clone the Repository

```bash
git clone https://github.com/github2023-shruti/college-event-organization.git
```

### 2. Set Up the Local Server

- Install XAMPP.
- Start Apache and MySQL.
- Place the project folder inside the `htdocs` directory.

### 3. Configure the Database

- Open phpMyAdmin.
- Create a database.
- Import the `backend/schema.sql` file.
- Configure your database credentials in `backend/api/init.php`.

### 4. Run the Project

Open your browser and navigate to:

```text
http://localhost/college-event-organization/frontend/admin-login.html
```

## 🎯 Project Objective

The main objective of this project is to develop a simple and user-friendly platform that helps colleges organize events efficiently and provides students with easy access to event information.

## 👩‍💻 Developed By

**Shruti Patil**

Computer Science and Engineering Graduate | 2026

GitHub: [github2023-shruti](https://github.com/github2023-shruti)

---

⭐ If you find this project useful, feel free to explore and star the repository!
