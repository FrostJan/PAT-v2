# PAT Schedule Management (v2)

Rebuild of the legacy PHP/MariaDB PAT Schedule Management system on Laravel 12, PostgreSQL, Docker and a React + shadcn/ui frontend.

## Stack

- **Backend** — Laravel 12 (PHP 8.3), Eloquent, Pest. Based on the [official Laravel React starter kit](https://github.com/laravel/react-starter-kit).
- **Frontend** — Inertia v2 + React 19 + TypeScript, Tailwind 4, shadcn/ui, FullCalendar React, Recharts, TanStack Table, React Hook Form + Zod.
- **Database** — PostgreSQL 16.
- **Auth / RBAC** — Laravel session auth + `spatie/laravel-permission` with three roles (`admin`, `department_office`, `student`).
- **File storage** — S3-compatible (MinIO locally) via `league/flysystem-aws-s3-v3`. Signed URLs only.
- **Dev env** — Laravel Sail (Postgres, Redis, MinIO, Mailpit).
- **Prod** — `docker/Dockerfile` + `docker/nginx.conf` + `compose.prod.yml`.

## Quick start

```bash
cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate:fresh --seed
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

Open http://localhost. Seeded accounts (password is `password`):

| Role | Email |
| --- | --- |
| Admin | admin@pat-v2.local |
| Department Office | department@pat-v2.local |
| Student | student@pat-v2.local |

## Feature map

| Route | Role | What it does |
| --- | --- | --- |
| `/dashboard` | all | Role-scoped calendar (FullCalendar React). |
| `/requests/create` | student, department | Submit facility request with attachment. |
| `/requests` | student (own), admin/department (all) | Request status table. |
| `/requests/{id}` | owner + staff | Request detail with signed attachment URL. |
| `/approvals` | department, admin | Approve / decline pending requests. |
| `/document-history` | department, admin | Archive of approved requests. |
| `/summary` | department, admin | Approved/declined/monthly charts (Recharts). |
| `/activity-purposes` | admin | CRUD the activity dictionary. |
| `/log` | admin | Audit log. |

## Testing

```bash
./vendor/bin/pest                 # 37 passing
./vendor/bin/pint --test          # PHP formatting
npm run build                     # TypeScript/React compile
```

## Notes

- Approval is single-step today (`pending → approved | declined`). The paper form mentions multi-signature (Dept Head → AV Head → Exec Director) — see `scripts/plans/system-reminder-you-re-running-in-temporal-cerf.md` for how to extend.
- Legacy PHP source is removed; the original schema dump is preserved in the `1459b7f` commit if ever needed.
