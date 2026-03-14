# Aquashine CRM System

## 📋 Overview
Aquashine CRM is a comprehensive Customer Relationship Management system designed for business operations management, including job cards, customer management, payments, and reporting.

### 🏢 Business Domains
- **Service Management** - Service job cards and technician assignment
- **Trading Operations** - Trading job cards and inventory
- **Project Management** - Project-based job cards and tracking
- **AMC Management** - Annual Maintenance Contracts
- **Financial Tracking** - Payments, M-Pesa integration, collections
- **Inventory Control** - Products, items, stock movement
- **Reporting & Analytics** - Daily reports, performance metrics

## 🚀 Technology Stack

### Backend
- **PHP** (Procedural) - Core business logic
- **MySQL** - Database management
- **TCPDF/FPDF** - PDF report generation

### Frontend
- **HTML5/CSS3** - Structure and styling
- **Bootstrap 5.3** - Responsive design framework
- **jQuery 3.6** - DOM manipulation and AJAX
- **JavaScript** - Client-side interactivity

### Server Requirements
- PHP 7.4+ (with mysqli extension)
- MySQL 5.7+
- Apache/Nginx web server
- SSL certificate (recommended)


## 📁 Project Structure
aquashine-crm/
├── 📄 index.php # Main dashboard
├── 📄 login.php # User authentication
├── 📄 logout.php # Session termination
├── 📄 dashboard.php # Dashboard content
│
├── 📁 config/
│ └── 📄 constants.php # Database & system config
│
├── 📁 includes/
│ ├── 📄 login-check.php # Authentication guard
│ └── 📄 timeout.php # Session management
│
├── 📁 partials/
│ ├── 📄 navbar.php # Navigation bar
│ └── 📄 footer.php # Page footer
│
├── 📁 js/ # 38 JavaScript files
│ ├── 📄 main.js # Core functionality
│ ├── 📄 customer.js # Customer operations
│ ├── 📄 service_jc.js # Service job cards
│ └── ... (additional modules)
│
├── 📁 css/
│ ├── 📄 admin.css # Admin styles
│ ├── 📄 style.css # Main stylesheet
│ └── 📄 login.css # Login page styles
│
├── 📁 images/ # User uploads
│ ├── 📁 admin-images/ # Admin profile images
│ ├── 📁 sales/ # Sales profile images
│ └── 📁 ... (role-based folders)
│
├── 📁 tcpdf_6_2_13/ # PDF generation library
│
├── 📁 uploads/ # File uploads
│
├── 📄 *.php (300+ files) # Feature-specific pages
└── 📄 *.js (38 files) # Feature-specific scripts



## 🔐 Authentication System

### Session Management
- **Session Lifetime**: 1 hour (cookie) + 30 min (inactivity timeout)
- **Security Features**: HTTP-only cookies, SameSite=Strict
- **Auto-logout**: After 30 minutes of inactivity

### User Roles
| Role | Access Level | Redirect URL |
|------|--------------|--------------|
| Admin | Full system access | `profile-admin.php` |
| Manager | Management access | `profile-manager.php` |
| Accounts | Financial access | `profile-accounts.php` |
| Projects | Project management | `profile-projects.php` |
| Sales | Sales operations | `profile-sales.php` |

## 💼 Core Business Features

### 1. **Job Card Management**
- **Service Job Cards** - Customer service requests
- **Trading Job Cards** - Sales and trading operations
- **AMC Job Cards** - Annual maintenance contracts
- **Project Job Cards** - Project-based work
- **Admin Job Cards** - Internal administrative tasks

### 2. **Customer Management**
- Customer profiles and history
- Contact information management
- Customer project tracking
- Service call logging

### 3. **Financial Operations**
- Payment processing
- M-Pesa integration
- Collection reports (Service/Trading & Projects/Accounts)
- Payment tracking and reconciliation

### 4. **Inventory Management**
- Products and items tracking
- Stock movement monitoring
- Stock correction and adjustment
- Procurement suggestions

### 5. **Reporting & Analytics**
- **Daily Status Reports** (auto-generated 7-9 AM)
- **Collection Reports** - S&T and P&A
- **Technician Performance**
- **Activity Performance**
- **JC Costing Analysis**
- **Stock Movement Reports**

## 🛠️ Installation & Setup

### Local Development Setup

1. **Clone Repository**
```bash
git clone [repository-url]
cd aquashine-crm


Configure Environment
Edit config/constants.php:

php
// Set environment to development
$environment = 'development';

// Local database settings (already configured)
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'aquashine');
define('SITEURL', 'http://localhost/aquashine');
Import Database

bash
# Get production backup from team
mysql -u root -p aquashine < production_backup.sql
Configure Web Server

Point document root to project folder

Ensure mod_rewrite enabled for Apache

Set proper folder permissions (755 for folders, 644 for files)

Test Installation

text
http://localhost/aquashine/login.php
Default credentials: (ask team for test user)
Production Deployment
Update constants.php for production:

php
$environment = 'production';
// Production credentials are automatically used
Security Checklist:

Enable HTTPS/SSL

Update database passwords

Disable error display in php.ini

Set proper file permissions

Enable PHP error logging

Remove test/debug files

🔧 Maintenance Guide
Daily Tasks
Monitor tbl_daily_status for report generation

Check error logs for database connection issues

Verify automated reports are generated (7-9 AM)

Weekly Tasks
Review slow queries in MySQL log

Backup database

Check disk space for uploads

Monitor session table size

Monthly Tasks
Archive old job cards

Clean up temporary files

Review user access and roles

Performance optimization review

🐛 Common Issues & Solutions
Issue: Session timeout too frequent
Solution: Adjust $timeout in timeout.php

php
$timeout = 3600; // Change from 1800 to 3600 seconds
Issue: Reports not generating
Check:

Cron jobs are running (if configured)

generate_daily_report.php exists and is executable

Database connection in constants.php is valid

tbl_daily_status table exists

Issue: Images not uploading
Check:

Folder permissions (775 for upload directories)

PHP upload limits in php.ini

Disk space availability

Issue: PDF generation fails
Check:

TCPDF library permissions

Memory limits in php.ini

Font directories are writable

🔒 Security Best Practices
Implemented
✅ Session security (httponly, samesite)

✅ Prepared statements for queries

✅ Input validation and sanitization

✅ XSS prevention with htmlspecialchars

✅ Secure file upload validation

Recommended Additions
Implement CSRF tokens for forms

Add rate limiting for login attempts

Enable HTTPS-only cookies

Implement 2-factor authentication

Regular security audits

📊 Database Schema Overview
Core Tables
sql
tbl_admin           -- User management
tbl_customers       -- Customer information
tbl_jobcard_*       -- Various job card types
tbl_products        -- Product catalog
tbl_items           -- Inventory items  
tbl_payments        -- Payment records
tbl_technicians     -- Service technicians
tbl_daily_status    -- Automated reports
tbl_stock_movement  -- Inventory tracking


👥 Team Guidelines
For Developers
Always use prepared statements for database queries

Test locally first before deploying

Update documentation when changing features

Follow naming conventions (hyphenated for pages, underscores for includes)

Check both session variables ('user' and 'username') for compatibility

For Support Team
Document common issues in internal wiki

Test report generation daily at 8 AM

Monitor user feedback for improvement areas

Keep user manuals updated with new features

🚦 Version History
Version 2.0 (Current)
✅ Consolidated session management

✅ Security enhancements (prepared statements)

✅ Bootstrap 5.3 upgrade

✅ jQuery 3.6 standardization

✅ Environment-based configuration

✅ Improved error handling

Version 1.0 (Legacy)
Initial release

Basic CRM functionality

Procedural PHP architecture

📞 Support & Contact
Technical Support: [IT Team Email]
Business Hours: Monday-Friday, 8:00 AM - 5:00 PM EAT
Emergency: [On-call Developer]

📝 License
Proprietary - Aquashine Limited. All rights reserved.