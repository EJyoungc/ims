# Authorization and Security

- **RBAC Roles:** `system` (Super Admin), `owner` (Business Admin), `seller` (Limited Access).
- **Custom Middleware (`RoleMiddleware`):** Intercepts requests and redirects unauthorized users to a dedicated `/unauthorized` view instead of throwing standard 403 errors.
- **Custom License Enforcement:** `RequireLicense` and `CheckLicense` middleware ensure the application has a valid, non-expired cryptographic signature verified against `storage/app/keys/public.pem`.
- **Audit Trails:** Manual logging of sensitive actions (item added to cart, sale processed, user updated) into the `audit_logs` table.
