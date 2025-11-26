CRM_Ticket_Module
====================================

Project Structure:
- /database/   -> SQL schema and DB connection config
- /backend/    -> PHP Logic scripts (Login, Register, CRUD Actions)
- /frontend/   -> HTML Views (Pages you actually visit in browser)

Installation:
1. Move `php_crm_v2` contents to your server (xampp/htdocs/CRM_Ticket_Module) or (wamp64/www/CRM_Ticket_Module).
2. Create database name crm_ticket_db in MySQL.
3. Import `database/schema.sql` to MySQL.
4. Configure `database/db.php` with your credentials.
5. Open `localhost/frontend/login.php` in browser.
