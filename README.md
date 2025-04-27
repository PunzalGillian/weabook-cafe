# 📚 Weabook Cafe  

Welcome to **Weabook Cafe** — your ultimate virtual manga café where you can browse, borrow, and read your favorite manga! 📖✨  

A full-stack web application built with **PHP**, **MySQL**, and **Hack** for robust backend performance, styled with modern **CSS** for that authentic manga café vibe.  

🔗 **Live Demo**: Not available (local setup required)  

![PHP](https://img.shields.io/badge/Backend-PHP-purple)  
![MySQL](https://img.shields.io/badge/Database-MySQL-blue)  
![Hack](https://img.shields.io/badge/Performance-Hack-lightgrey)  
![CSS](https://img.shields.io/badge/Style-CSS-orange)  

## ✨ Premium Features  

- **📚 Digital Manga Library**  
  - 500+ manga titles with covers, synopses and genre tags  
  - Advanced search with filters (genre, author, status)  

- **🔐 Secure User System**  
  - Password-hashed accounts with borrowing history  
  - Admin dashboard for inventory management  

- **⏳ Smart Borrowing System**  
  - Real-time availability tracking  
  - Automatic due date reminders  

- **📱 Fully Responsive**  
  - Perfect reading experience on any device  

## 🛠️ Tech Stack Deep Dive  

### Backend  
- **PHP 8.1** with MVC architecture  
- **MySQL 8.0** for relational data storage:  
  - Optimized tables for users, manga, transactions  
  - Complex joins for fast queries  

### Frontend  
- **Vanilla CSS** with Flexbox/Grid  
- **Responsive breakpoints** for all devices  

### Performance  
- **Hack** for type-safe critical paths  
- **MySQL indexing** for search optimization  

## 🚀 How to Run  

1. **Install Requirements**:  
   - PHP 7.4+  
   - Hack (optional for performance)  
   - Apache/Nginx  

2. **Clone & Set Up**:  
   ```bash
   git clone https://github.com/your-username/weabook-cafe.git  
   cd weabook-cafe  
   ```  

3. **Configure Server**:  
   - Point your web server to the project root.  

4. **Launch!**  
   - Open `localhost:your-port` in your browser.
   

## 🎮 User Flow Walkthrough  

1. **Guest View**  
   - Browse manga catalog (no login required)  
   - See real-time availability status  

2. **Member Experience**  
   ```sql
   -- Sample borrow transaction
   INSERT INTO borrow_records 
   VALUES (user_id, manga_id, CURRENT_DATE(), DATE_ADD(CURRENT_DATE(), INTERVAL 7 DAY));
   ```
   - 1-click borrowing with due date tracking  
   - Personal reading history  

3. **Admin Privileges**  
   - Add/edit manga entries  
   - Manage user accounts  
   - Generate circulation reports  


## 📸 UI Gallery  
*(Hover for interactive previews)*  

[![Catalog View](https://github.com/user-attachments/assets/4fb53065-f7f3-4307-863c-23621c5156dd)](preview)  
*Dynamic manga grid with availability badges*

[![User Dashboard](https://github.com/user-attachments/assets/4ca37e46-aca7-49a2-a5e3-769b0b34e24b)](preview)  
*Personalized borrowing history*

[![Admin Panel](https://github.com/user-attachments/assets/88092f61-0528-474d-86e8-f40889b806e6)](preview)  
*Inventory management interface*


[![GitHub Stars](https://img.shields.io/github/stars/your-username/weabook-cafe?style=social)](https://github.com/your-username/weabook-cafe)
**Enjoy your stay at Weabook Cafe!** 🍵📚  

> *Originally developed for a school project back in 2021*  



