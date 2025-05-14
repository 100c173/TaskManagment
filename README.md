# 🎯 Project: Task Management API

## 📝 Project Description
A Laravel-based API system for task management with Sanctum authentication, model relationships, and simple role-based authorization. Users can create and manage tasks based on their assigned roles.

---

## ✅ Goals

- Use Laravel Sanctum for API authentication.
- Design a relational database linking users, tasks, and statuses.
- Validate input using Form Requests.
- Implement simple role-based authorization (via middleware or controller checks).
- Restrict status management (CRUD) to admin roles only.
- Return clear and structured JSON responses.
- Add filtering, pagination, comments, and priority management to tasks.

---

## 🛠️ Database Structure

### Main Tables:
- `users`: Stores user data with role definitions.
- `tasks`: Stores tasks assigned to users.
- `statuses`: Stores task statuses (pending, in_progress, completed).
- `comments`: Stores user comments on tasks.

### Relationships:
- Each **task** belongs to:
  - One status (`status_id`)
  - One assigned user (`user_id`)
  - One creator (usually admin or moderator) (`created_by`)
- Each **comment** belongs to:
  - A task (`task_id`)
  - A user (`user_id`)

---

## 🔐 Authentication

- Laravel Sanctum is used for token-based API authentication.
- Available endpoints:
  - `POST /api/register`
  - `POST /api/login`
  - `POST /api/logout`

---

## 🔒 Role-Based Permissions

| Role            | Permissions                                                                 |
|-----------------|-------------------------------------------------------------------------------|
| `super_admin`   | 👑 Full access to all actions (manage users, tasks, statuses).               |
| `moderator`     | 🛠️ Can update/delete only the tasks they created.                            |
| `limited_admin` | 👀 Can view all tasks and all users, no editing or deleting.                  |
| `user`          | 🙋 Can only view their **assigned** tasks and task details (read-only).       |

---

## 📦 Key Features

- **Form Requests**: For validation when creating/updating tasks, statuses, and comments.
- **Resources**: For clean, consistent JSON responses.
- **Middlewares**:
  - `auth:sanctum`: Protects all API routes.
  - `role`: Custom middleware for role-based access.
- **TaskFilter**: Class to filter tasks by status, priority, user, etc.
- **Seeders**: For populating sample data (statuses, tasks, users, comments).

---

## 🔎 Extra Features

- Task comments system.
- Filter tasks by:
  - `status_id`
  - `priority`
  - `user_id`
  - `title` (search)
- Pagination using `paginate()`.
- Sorting by latest using `latest()`.

---
## 🔎 PostMan Collection
https://api.postman.com/collections/38893521-6578ffa5-1e6e-4f62-b574-fe066ae9d488?access_key=PMAT-01JV8320HTRD04Y5SA1BS2GQXF

