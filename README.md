# FoodShare

<p align="center">
  <img src="/api/placeholder/200/200" alt="FoodShare Logo">
</p>

<p align="center">
  <strong>Nourishing Communities, Reducing Waste</strong><br>
  A comprehensive platform connecting food donors with families in need
</p>

<p align="center">
  <a href="#overview">Overview</a> •
  <a href="#key-metrics">Key Metrics</a> •
  <a href="#features">Features</a> •
  <a href="#our-mission">Our Mission</a> •
  <a href="#technology-stack">Technology Stack</a> •
  <a href="#installation">Installation</a> •
  <a href="#file-structure">File Structure</a> •
  <a href="#development-team">Development Team</a>
</p>

## 📋 Overview

FoodShare is a web-based platform designed to address food insecurity while reducing waste. Our system connects food donors with families in need, coordinates volunteer efforts, and provides transparent impact metrics to demonstrate the collective difference we're making in communities.

## 📊 Key Metrics

<p align="center">
  <strong>10,000+</strong> meals served •
  <strong>500+</strong> families helped •
  <strong>25+</strong> communities reached
</p>

- **83%** of donations go directly to food programs
- **78%** reduction in food waste in partner stores
- **93%** of families report improved food security

## ✨ Features

### Donation Management
- **Food Donation System**
  - Streamlined donation submission process
  - Most-needed items list updated in real-time
  - Flexible pickup scheduling options
  - Donation tracking and receipt generation

### Volunteer Coordination
- **Role-Based Volunteer Portal**
  - Food Sorting: Organize donations at our centers
  - Delivery Driver: Transport food to families
  - Food Distribution: Help at community pickup points
  - Community Outreach: Spread awareness locally
  - Personalized volunteer dashboard with hour tracking

### Administrative Tools
- **Comprehensive Admin Dashboard**
  - Donation monitoring and management
  - Volunteer application processing
  - Impact statistics and reporting
  - System configuration and user management

### User Experience
- **Intuitive Interfaces**
  - Mobile-responsive design for all devices
  - Streamlined navigation with clear call-to-actions
  - Accessible design following WCAG guidelines
  - Multi-channel contact options for support

## 🌟 Our Mission

Bridging together communities to reduce hunger and food waste through innovative solutions and compassionate action.

### Who We Are
A dedicated team of community advocates committed to fighting hunger, reducing food waste, and creating sustainable solutions for food security. Through our network of volunteers and donors, we work to ensure that no usable food goes to waste and no family goes hungry.

### Our Values

#### Compassion
We approach our work with empathy and understanding, recognizing the dignity of every individual we serve. Our platform maintains the privacy of recipients while celebrating the generosity of donors and volunteers.

#### Community
We believe in the power of community collaboration to create meaningful change. FoodShare brings together businesses, individuals, and organizations to address food insecurity at the local level.

#### Sustainability
We strive for environmentally responsible practices that reduce food waste while meeting nutritional needs. Every meal saved and distributed represents both hunger alleviation and environmental impact.

## 🛠️ Technology Stack

### Frontend
- **HTML5** - Semantic document structure
- **CSS3** - Custom styling with responsive design
- **JavaScript** - Interactive elements and form validation
- **Bootstrap Framework** - Responsive grid system and components

### Backend
- **PHP 8.0** - Server-side processing and business logic
- **MySQL** - Relational database for data storage
- **Apache** - Web server environment

### Development Tools
- **Git** - Version control and collaboration
- **XAMPP** - Local development environment
- **Visual Studio Code** - Code editing and development

## 📦 Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache web server
- Composer (recommended for dependencies)

### Quick Setup

1. **Clone or download the repository**
   ```bash
   git clone https://github.com/yourusername/foodshare.git
   ```

2. **Configure database connection**
   - Open `config.php` and update database credentials:
   ```php
   // Update these values with your database information
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_NAME', 'foodshare');
   ```

3. **Initialize the database**
   - Import `create_users_table.sql` to your MySQL server, or
   - Run `setup_database.php` in your browser

4. **Set up web server**
   - Configure your web server to point to the project directory
   - Ensure PHP is properly configured

5. **Access the application**
   - Open your browser and navigate to the configured URL
   - Default admin credentials: admin@foodshare.org / foodshare2025

## 📁 File Structure

```
foodshare/
├── admin_dashboard.php      # Administrator control panel (2 KB)
├── config.php               # Configuration settings (1 KB)
├── create_users_table.sql   # SQL schema for user accounts (1 KB)
├── index.html               # Main landing page (24 KB)
├── login.php                # User authentication handler (1 KB)
├── login.html               # Login interface (1 KB)
├── logout.php               # Session termination (1 KB)
├── process_donation.php     # Monetary donation handler (3 KB)
├── process_food_donation.php # Food donation processor (3 KB)
├── process_message.php      # Contact form processor (3 KB)
├── process_volunteer.php    # Volunteer application handler (4 KB)
├── script.js                # Client-side functionality (9 KB)
├── setup_database.php       # Database initialization script (4 KB)
├── signup.php               # New user registration handler (1 KB)
├── signup.html              # Registration interface (1 KB) 
└── styles.css               # Visual styling and layout (24 KB)
```

### Core Files Explained

- **index.html**: The main landing page featuring the food donation drive, mission statement, values, and impact metrics
- **process_food_donation.php**: Handles the submission of food donation offers including item details and pickup options
- **process_volunteer.php**: Manages volunteer applications for various roles within the organization
- **admin_dashboard.php**: Provides administrators with tools to monitor donations, volunteers, and system performance
- **setup_database.php**: Configures the database schema necessary for FoodShare operations

## 👨‍💻 Development Team

FoodShare was developed by a dedicated team of students from Somaiya University:

| Name | Role | Contact | Student ID |
|------|------|---------|------------|
| **Siddhant Thakur** | Backend Development & Database Architecture | [siddhant.thakur@somaiya.edu](mailto:siddhant.thakur@somaiya.edu) | 16010123332 |
| **Soham Shukla** | Frontend Development & UI/UX Design | [soham.ks@somaiya.edu](mailto:soham.ks@somaiya.edu) | 16010123334 |
| **Yuvaan Shah** | System Integration & Project Management | [yuvaan.shah@somaiya.edu](mailto:yuvaan.shah@somaiya.edu) | 16010123338 |

## 📞 Contact Information

- **Organization Address**: 123 Donation Street, Foodville, CA 90210
- **Email**: info@foodshare.org, donations@foodshare.org
- **Phone**: Main: (123) 456-7890, Donations: (123) 456-7891
- **Hours**: Monday-Friday: 9am-5pm, Saturday: 10am-2pm

## 🤝 How to Contribute

We welcome contributions to improve FoodShare! Here's how you can help:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/new-feature`)
3. Make your changes and test thoroughly
4. Commit your changes (`git commit -m 'Add new feature'`)
5. Push to your branch (`git push origin feature/new-feature`)
6. Open a Pull Request with a detailed description

## 📋 Future Enhancements

- Mobile application for donors and volunteers
- Real-time donation tracking with GPS integration
- Advanced analytics dashboard for impact measurement
- Integration with local food bank inventory systems
- Expansion of multilingual support
- Community forum for sharing resources and success stories


<p align="center">
  Made with ❤️ by the FoodShare team
</p>
