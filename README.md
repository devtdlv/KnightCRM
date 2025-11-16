# KnightCRM

A lightweight Laravel CRM for freelancers featuring lead tracking, client notes, tasks, reminders, and CSV export — built with Tailwind & Livewire for a smooth, modern workflow.

A solid, honorable CRM — built like a Rune Midgard knight. Perfect for freelancers who juggle clients in a mess of sticky notes and browser tabs.

## Features

- **Leads Pipeline** - Track leads through the entire sales funnel with status management
- **Client Management** - Organize client information and contact details
- **Client Notes** - Keep detailed notes about each client interaction
- **Task Tracking** - Manage tasks with priorities, due dates, and status tracking
- **Email Reminders** - Automated email reminders via Laravel scheduler
- **CSV Export** - Export leads and clients data to CSV files
- **Clean UI** - Modern, responsive interface built with Tailwind CSS
- **Livewire** - Smooth, interactive experience without page refreshes
- **Authentication** - Login, Registration, Password Reset, Email Verification
- **Homepage + Dashboard** - Public marketing homepage; secure dashboard at `/dashboard`

## Requirements

- PHP 8.1 or higher
- Composer
- Node.js and npm
- MySQL or PostgreSQL
- Laravel 10.x

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd KnightCRM
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install frontend dependencies**
   ```bash
   npm install
   ```

4. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Edit `.env` file and configure your database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=knightcrm
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

5. **Run migrations**
   ```bash
   php artisan migrate --seed
   ```

6. **Build frontend assets**
   ```bash
   npm run build
   # Or for development:
   npm run dev
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

   Visit `http://localhost:8000` in your browser.

### Seeded Demo Accounts

After `--seed`, you can log in with any of these:

- Admin: `admin@knightcrm.com` / `password`
- Freelancer Demo: `freelancer@knightcrm.com` / `password`
- Viewer Demo: `viewer@knightcrm.com` / `password`

All seeded accounts have verified emails.

## Setting Up Email Reminders

The email reminder system uses Laravel's scheduler. To enable it:

1. **Configure mail settings** in your `.env` file:
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=your_smtp_host
   MAIL_PORT=587
   MAIL_USERNAME=your_email
   MAIL_PASSWORD=your_password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=noreply@yourdomain.com
   MAIL_FROM_NAME="KnightCRM"
   ```

2. **Set up the scheduler** by adding this to your server's crontab:
   ```bash
   * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
   ```

   Or if using Laravel Sail:
   ```bash
   php artisan schedule:work
   ```

## Usage

### URLs
- Public homepage: `/`
- Login: `/login`
- Register: `/register`
- Dashboard (authenticated + verified): `/dashboard`

Authenticated users clicking the brand/home will be redirected to `/dashboard`.

### Leads Pipeline
- Create and manage leads through different stages (New → Contacted → Qualified → Proposal → Negotiation → Won/Lost)
- Track lead value and source
- Filter leads by status
- Export leads to CSV

### Clients
- Add client information (name, email, phone, company, address)
- View client details and associated notes, tasks, and leads
- Export client list to CSV

### Client Notes
- Add detailed notes about client interactions
- Edit and delete notes
- View notes chronologically

### Tasks
- Create tasks with titles, descriptions, and due dates
- Set priority levels (Low, Medium, High)
- Track task status (Pending, In Progress, Completed)
- Link tasks to clients or leads
- Visual indicators for overdue tasks

### Email Reminders
- Schedule email reminders for future dates
- Link reminders to clients or leads
- Automated sending via Laravel scheduler
- Beautiful HTML email templates

## Project Structure

```
KnightCRM/
├── app/
│   ├── Console/Commands/     # Scheduled commands
│   ├── Http/Controllers/       # Route controllers
│   ├── Livewire/             # Livewire components
│   ├── Mail/                 # Email classes
│   └── Models/               # Eloquent models
├── database/migrations/       # Database migrations
├── resources/
│   ├── css/                  # Tailwind CSS
│   ├── js/                   # JavaScript
│   └── views/                # Blade templates
└── routes/                   # Application routes
```

## Technologies

- **Laravel 10** - PHP framework
- **Livewire 2** - Full-stack framework for dynamic interfaces
- **Tailwind CSS 3** - Utility-first CSS framework
- **Vite** - Next generation frontend tooling

## Assets

- Homepage preview image (optional): place screenshots in `public/images/`, e.g.
  - `public/images/dashboard-preview.png`

## License

MIT License - feel free to use this project for your own needs.

---

Built with honor and chivalry. ⚔️
