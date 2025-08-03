# Game Shop - PHP & MySQL

A simple shopping website for games built with PHP, MySQL, Bootstrap, and some custom CSS.

---

## Features

- Browse products and categories  
- Add, update, and delete products and categories (admin only)  
- User-friendly checkout process  
- Admin panel for managing products, categories, and orders  
- User roles supported:  
  - **Guests:** Browse products only
  - **Customer:** Access to ordering and browsing 
  - **Admins:** Full CRUD access to products, categories, orders (set `role` to `1` in the database to enable admin access)  

---

## Technology Stack

- Backend: PHP (no framework)  
- Database: MySQL  
- Frontend: Bootstrap + custom CSS  

---

## Database Setup

A complete export of the project database is included in the `/database` folder as `store_db.sql`.

the data in the database is messy but you can add more data if you want to really test it.

Notes
This project is primarily for training purposes and does not use any PHP framework.

The frontend is built with Bootstrap and customized CSS.

Security measures are minimal; not intended for production use without improvements.
