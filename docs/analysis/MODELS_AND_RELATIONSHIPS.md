# Models and Relationships

- **User:** 
    - `hasMany(Sale)`: Tracks sales processed by the user.
    - `hasMany(AuditLog)`: Records user actions.
    - `hasMany(Expense)`: Tracks expenses filed by the user.
- **Product:** 
    - `belongsTo(Category)`: Categorization for reporting.
    - `hasMany(SaleItem)`: Link to historical sales.
    - `implements SoftDeletes`: Prevents accidental data loss.
- **Sale:** 
    - `belongsTo(Customer)`: Identifies the buyer.
    - `hasMany(SaleItem)`: Contains line-item details.
    - `belongsTo(User, 'created_by')`: Identifies the clerk.
- **Purchase:**
    - `belongsTo(Supplier)`: Identifies the source of stock.
    - `hasMany(PurchaseItem)`: Tracks specific items restocked.
