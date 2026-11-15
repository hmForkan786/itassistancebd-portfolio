# Client Trust System

## Testimonial model
Fields: client_name, client_role, company_name, client_avatar, project_id, review_text, rating (1-5 integer), review_date, verified, approved, published, featured, sort_order.

## Eligibility for public display
A testimonial is shown publicly only when `approved=true AND published=true AND verified=true`. Average rating calculated from eligible records only. Section hidden when none exist.

## Admin workflow
Create → verify authenticity → approve → publish → (optional) feature. Reject unpublishes. No auto-fake reviews; rating must be integer 1-5.

## Public integration
`Testimonials.vue` fetches `/api/public/testimonials` on mount; renders nothing when empty. No fabricated data.