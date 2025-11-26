# 📌 CRM Ticket Module (PHP + MySQL)

A simple CRM-style Ticket Management System built with **PHP, MySQL, HTML, CSS, Bootstrap**, and **basic access control rules**.
---
## 📁 Project Structure
CRM_Ticket_Module/
│
├── database/
│   ├── db.php              → Database connection file
│   └── schema.sql          → SQL file for creating tables
│
├── backend/
│   ├── auth_login.php      
│   ├── auth_logout.php
│   ├── auth_register.php
│   ├── ticket_create.php
│   ├── ticket_update.php
│
├── frontend/
│   ├── includes/
│   │   ├── header.php
│   │   └── footer.php
│   ├── index.php           → Dashboard
│   ├── login.php
│   ├── register.php
│   ├── create_ticket.php
│   ├── view_ticket.php
│   └── users.php
│
└── readme.md



📦 Installation Guidelines:

1. Move project to server
--Copy the folder into:
--xampp/htdocs/CRM_Ticket_Module
            or
--wamp64/www/CRM_Ticket_Module

2. Create Database
--Open phpMyAdmin → create database: "crm_ticket_db"

3. Import the Schema
--Go to: phpMyAdmin → Select crm_ticket_db → Import → choose database/schema.sql → Import

4. Update Database Credentials: database/db.php
--Update these values according to your MySQL setup:
$host = "localhost";
$user = "";   // your MySQL username
$pass = "";   // your password (empty for XAMPP by default)
$db   = "crm_ticket_db";

5. Run the Project in Browser
--http://localhost/CRM_Ticket_Module/frontend/login.php


   
