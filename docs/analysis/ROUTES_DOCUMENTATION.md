# Routes Documentation

The application utilizes role-based access control (RBAC) and license-enforcement middleware.

| Method | URI | Name | Middleware | Purpose |
| :--- | :--- | :--- | :--- | :--- |
| GET | `/login` | `login` | `web`, `guest` | User authentication entry point. |
| GET | `/setup` | `setup` | `web` | Initial system and user configuration. |
| GET | `/dashboard` | `dashboard` | `auth`, `verified`, `license` | System overview and key metrics. |
| GET | `/pos` | `pos` | `auth`, `license` | Interactive Point of Sale interface. |
| GET | `/products` | `products` | `auth`, `role:owner,system,seller` | Inventory management CRUD. |
| GET | `/sales` | `sales` | `auth`, `role:owner,system,seller` | Historical sales records. |
| GET | `/purchases` | `purchases` | `auth`, `role:owner,system,seller` | Supplier purchase management. |
| GET | `/users` | `users` | `auth`, `role:system,owner` | Admin-only user management. |
| GET | `/audit-logs` | `audit-logs` | `auth`, `role:system,owner` | System traceability and action logs. |
| GET | `/reports/profit`| `reports.profit`| `auth`, `role:owner,system` | Financial performance analytics. |
| POST | `/verify-questions`| `password.questions.verify`| `web` | Custom password recovery verification. |
