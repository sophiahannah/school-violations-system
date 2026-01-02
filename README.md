# School Violation System

A comprehensive system for managing and tracking school violations, built with PHP and modern web technologies.

---

## Prerequisites

Before you begin, ensure you have the following installed on your system:

- **PHP** >= 8.1
- **Composer** (PHP dependency manager)
- **MySQL** >= 5.7 or **MariaDB** >= 10.3
- **Node.js** >= 16.x and **npm**
- **Git** for version control

---

## Getting Started

### Step 1: Fork & Clone the Repository

1. **Fork the repository** by clicking the Fork button at the top right of this page:
   
   [![Fork on GitHub](https://img.shields.io/badge/Fork%20me%20on-GitHub-orange?logo=github)](https://github.com/Xenrui/school-violations-system/fork)

2. **Clone your forked repository** to your local machine:

```bash
git clone https://github.com/Xenrui/school-violations-system.git
cd school-violations-system
```

---

### Step 2: Install Dependencies

Install both PHP and JavaScript dependencies:

```bash
composer install
npm install
npm run build
```

---

### Step 3: Configure Environment Variables

1. **Copy the example environment file:**

```bash
cp .env.example .env
```

2. **Generate application key:**

```bash
php artisan key:generate
```

3. **Configure your database connection** in the `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=school_violations_system
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

---

### Step 4: Setup the Database

1. **Create the database** in MySQL:

```sql
school_violations_system
```

2. **Run migrations** to create the necessary tables:

```bash
php artisan migrate
```

3. **Seed the database** with sample data:

```bash
php artisan db:seed
```

---

### Step 6: Start the Development Server

Launch the application using Laravel's built-in development server:

```bash
php artisan serve
```

---

## Default Credentials

After seeding the database, you can log in with these default credentials:

- Password: `secret`

---

## Features

- Student violation tracking and management
- Multiple violation categories and severity levels
- Teacher and administrator roles with different permissions
- Violation history and reporting
- Email notifications for serious violations
- Student and parent portal access
- Export violation reports to PDF/Excel

---

⚠️ **IMPORTANT SECURITY NOTES:**

 - **NEVER** commit `.env` files to Git.

---

## 🤝 Contributing

1.  Fork the repository
2.  Create a feature branch (`git checkout -b feature/amazing-feature`)
3.  Commit your changes following our commit convention (see below)
4.  Push to the branch (`git push origin feature/amazing-feature`)
5.  Open a Pull Request

### Git Commit Convention

We follow the [Conventional Commits](https://www.conventionalcommits.org/) specification for clear and structured commit messages.

#### Commit Message Format

```
<type>(<scope>): <subject>

<body>

<footer>
```

#### Types

- **feat**: A new feature
    - `feat(auth): add user login functionality`
    - `feat(cart): implement add to cart feature`
- **fix**: A bug fix
    - `fix(checkout): resolve payment processing error`
    - `fix(products): correct price display formatting`
- **docs**: Documentation only changes
    - `docs(readme): update installation instructions`
    - `docs(api): add endpoint documentation`
- **style**: Changes that don't affect code meaning (formatting, missing semi-colons, etc.)
    - `style(client): format code with prettier`
    - `style(components): fix indentation`
- **refactor**: Code change that neither fixes a bug nor adds a feature
    - `refactor(api): simplify product service logic`
    - `refactor(hooks): extract custom hook for cart`
- **perf**: Performance improvements
    - `perf(products): optimize product list rendering`
    - `perf(api): add database query caching`
- **test**: Adding or correcting tests
    - `test(auth): add unit tests for login`
    - `test(cart): add integration tests`
- **build**: Changes to build system or dependencies
    - `build(deps): upgrade react to v19`
    - `build(client): update vite config`
- **ci**: Changes to CI configuration files and scripts
    - `ci(github): add deployment workflow`
    - `ci(vercel): update build settings`
- **chore**: Other changes that don't modify src or test files
    - `chore(git): update .gitignore`
    - `chore(deps): update dependencies`

#### Examples

```bash
# Simple feature addition
git commit -m "feat(products): add product search functionality"

# Bug fix with details
git commit -m "fix(cart): prevent duplicate items in cart

# Documentation update
git commit -m "docs(readme): add git commit convention section"
```

#### Best Practices

1.  **Use imperative mood** in the subject line (e.g., "add" not "added" or "adds")
2.  **Don't capitalize** the first letter of the subject
3.  **No period** at the end of the subject line
4.  **Limit subject line** to 50-72 characters

---

## License

This project is licensed under the MIT License. See the `LICENSE` file for details.

---

## Acknowledgments

Built with Laravel and modern web technologies to help educational institutions maintain discipline and track student behavior effectively.
