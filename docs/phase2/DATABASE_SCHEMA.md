# Database Schema

## Tables
- users (id, name, email, password, role, timestamps)
- projects (+purpose, limitations, soft deletes)
- project_images (FK project, cascade delete)
- project_technologies (FK project, unique project+name)
- project_metrics (FK project, cascade delete)
- testimonials (FK project nullable, nullOnDelete, soft deletes)
- portfolio_metrics (unique metric_key)
- services (soft deletes)
- skills
- contact_messages
- site_settings (unique key)
- portfolio_events (FK project nullable, nullOnDelete)

## Indexes
Projects: status+published_at, featured, sort_order. Testimonials: approved+published, featured, project. Others as per migrations.

## Collation
utf8mb4 (general_ci on existing DB). No destructive changes.