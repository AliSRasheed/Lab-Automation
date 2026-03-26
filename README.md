# 🧪 Lab Automation System

A full-stack laboratory workflow automation platform designed to streamline operations, manage records, and automate task workflows across multiple user roles.

---

## 🚀 Overview

This project simulates a real-world operational system with a modular, multi-portal architecture:

- Admin Portal
- Employee Portal
- Customer Website

It focuses on role-based authentication, profile management, access control, and structured workflow automation across multiple user types.

---

## ✨ Key Features

- 🔐 Role-Based Authentication System (Admin, Employee, Customer)
- 👤 User Profile Management for each role
- 🛡️ Access Control & Session Handling across multiple portals
- 🧾 CRUD Operations with MySQL
- ⚙️ Workflow & Task Management System
- 📂 File Upload & Document Handling
- 🧩 Modular Architecture with Shared Components
- 📦 Composer-based dependency management
- 🔄 Multi-portal system with separation of concerns

---
## 🔐 Authentication & User Roles

The system implements a multi-role authentication mechanism with separate access layers:

- **Admin** → Full system control, user and workflow management
- **Employee** → Task handling and internal operations
- **Customer** → Service interaction and request tracking

Each role has a dedicated interface and profile system, ensuring proper separation of concerns and secure access control.
---

## 🏗️ Architecture

- **admin-portal/** → Administrative control panel
- **employee-portal/** → Internal staff operations
- **customer-website/** → Public-facing interface
- **database/** → SQL schema and seed data
- **scripts/** → Utility scripts and migrations
- **shared/** (optional) → Shared logic/components

---

## 🛠️ Tech Stack

- PHP (Core Backend)
- MySQL (Database)
- JavaScript (Frontend interactions)
- Composer (Dependency management)

---

## 📂 Project Structure
admin-portal/
employee-portal/
customer-website/
database/
scripts/
composer.json
composer.lock
.gitignore
README.md
LICENSE

---

## ⚙️ Setup Instructions

1. Clone the repository
2. Import the database from `/database`
3. Configure `.env` (database credentials)
4. Run the project using a local server (e.g., XAMPP)
5. Access portals via browser

---

## 🔑 Demo Access

To explore the system, you can register new accounts through the customer interface.

Pre-configured roles include:

- Admin
- Employee
- Customer

Each role has access to its respective portal with different permissions and capabilities.
Credentials are configurable via the database. Default demo data can be found in `/database`.

> Passwords are stored using hashing mechanisms and are not exposed in plaintext.

---

## 🎯 Purpose

This project was built to demonstrate:

- Full-stack application architecture
- Role-based authentication systems
- Modular backend design
- Database-driven workflow automation
- Real-world multi-user system design

---

## 📌 Notes

- Developed as a portfolio project
- Focused on scalability and separation of concerns
- Designed to reflect production-like structure