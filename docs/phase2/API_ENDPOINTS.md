# API Endpoints

## Public (`/api/public`)
- GET projects, projects/{slug}
- GET services, skills, testimonials, metrics, settings
- POST contact
- POST analytics/event

## Admin auth
- POST api/admin/login
- POST api/admin/logout (auth)
- GET api/admin/me (auth)

## Admin (auth, admin role)
- GET api/admin/dashboard
- apiResource projects; POST projects/{id}/publish|unpublish|feature
- apiResource testimonials; POST testimonials/{id}/approve|reject|publish|unpublish|feature
- apiResource metrics; POST metrics/{id}/toggle-enabled|toggle-verified
- apiResource services; POST services/{id}/toggle-enabled
- apiResource skills; POST skills/{id}/toggle-enabled
- GET/PATCH/DELETE messages
- apiResource settings
- GET api/admin/analytics