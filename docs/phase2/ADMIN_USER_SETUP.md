# Admin User Setup

1. Set in `.env` (local only, never commit):
   - `ADMIN_EMAIL=...`
   - `ADMIN_NAME="..."`
   - `ADMIN_PASSWORD=...` (strong password)
2. Run `php artisan db:seed --class=AdminUserSeeder`.
3. Sign in at `/admin/login`.
4. No public registration exists; admin users provisioned only via this seeder.
5. To reset password, update `ADMIN_PASSWORD` and re-run seeder? Seeder skips existing email. Instead, update the user record directly or delete and re-seed. Never commit credentials.