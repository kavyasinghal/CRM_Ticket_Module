<h1>PHP CRM Ticket Module</h1>

<h2>Project Directory Structure</h2>
<pre><h3>CRM_Ticket_Module/</h3>
├── backend/
│   ├── auth_login.php
│   ├── auth_logout.php
│   ├── auth_register.php
│   ├── ticket_create.php
│   ├── ticket_update.php
├── database/
│   ├── db.php
│   ├── schema.sql
├── frontend/
│   ├── includes/
│   │   ├── footer.php
│   │   ├── header.php
│   ├── create_ticket.php
│   ├── index.php
│   ├── login.php
│   ├── register.php
│   ├── users.php
│   ├── view_ticket.php
</pre>

<pre>
•	/database/: Contains the database schema and configuration.
•	schema.sql defines the tables and initial data for the CRM ticket database.
•	db.php holds the database connection settings (hostname, username, password) for the application.
•	/backend/: Contains server-side PHP scripts and logic.
•	Includes user authentication scripts (auth_login.php, auth_logout.php, auth_register.php) for handling login, logout, and registration.
•	Includes ticket-related scripts (ticket_create.php, ticket_update.php) for creating and updating tickets in the database.
•	/frontend/: Contains the client-side PHP/HTML pages viewed in the browser.
•	Pages like create_ticket.php, index.php, login.php, register.php, users.php, and view_ticket.php make up the user interface for the CRM system.
•	The includes/ subfolder holds common components: header.php and footer.php, which are included on multiple frontend pages for consistent layout and design.
</pre>

<h2>Installation Manual</h2>
<pre>
1.	Move the project folder: Copy the CRM_Ticket_Module directory into your local web server directory. For example, use **xampp/htdocs/CRM_Ticket_Module (XAMPP)** **or wamp64/www/CRM_Ticket_Module (WAMP)**.
2.	Create the database: In your MySQL server (e.g., using phpMyAdmin or the MySQL CLI), create a new database named **crm_ticket_db**.
3.	Import the schema: Import the **database/schema.sql** file into the crm_ticket_db database to create the necessary tables and initial data.
4.	Configure database connection: Open **database/db.php** and update the MySQL credentials (hostname, username, and password) to match your local setup.
5.	Launch the application: Open your web browser and navigate to **http://localhost/frontend/login.php** to access the CRM Ticket Module login screen. From there, you can register a new user or log in to start creating and managing tickets.
With these steps completed, your CRM Ticket Module should be up and running on your local machine.
</pre>

