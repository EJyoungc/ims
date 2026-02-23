# Database Structure

The system uses a relational schema (SQLite) optimized with foreign key constraints and indexes.

| Table | Primary Keys/Indexes | Key Columns |
| :--- | :--- | :--- |
| `users` | `id`, `email` (unique) | `name`, `password`, `role`, `security_question`, `security_answer` |
| `products` | `id`, `category_id`, `barcode` | `name`, `purchase_price`, `selling_price`, `quantity`, `reorder_level` |
| `categories` | `id` | `name`, `slug` |
| `suppliers` | `id` | `name`, `phone`, `email`, `blacklist` (boolean) |
| `sales` | `id`, `customer_id`, `created_by`| `sale_date`, `total_amount`, `amount_paid`, `change`, `payment_method` |
| `sale_items` | `id`, `sale_id`, `product_id` | `quantity`, `unit_price`, `total_price` |
| `purchases` | `id`, `supplier_id` | `purchase_date`, `total_amount`, `status` |
| `audit_logs` | `id`, `user_id` | `action`, `table_name`, `record_id`, `details` |
| `expenses` | `id`, `created_by` | `amount`, `expense_date`, `description`, `category` |
| `licenses` | `id`, `machine_id` | `license_key`, `expires_at`, `is_active` |
