# AMS - Test Credentials
# These are dummy credentials for local development/testing only.
# DO NOT use these in production.

## Clinic Operator (Admin)
- **URL**: http://localhost:8080/
- **Username**: `admin`
- **Password**: `admin`
- **Role**: Full access — manage patients, dentists, clinics, appointments, services, reports.

## Patients
| Username     | Password | Email             | Patient ID |
|--------------|----------|-------------------|------------|
| johndoe      | ssssss   | john@doe.com      | 1          |
| janedoe      | ssssss   | jane@doe.com      | 2          |
| sitanepali   | ssssss   | sita@nepali.com   | 3          |

## Dentists
| Username  | Password | Email              | Dentist ID |
|-----------|----------|--------------------|------------|
| dr_sarah  | ssssss   | sarah@dentist.com  | 1          |
| dr_ram    | ssssss   | ram@dentist.com    | 2          |

## Database
- **Host**: localhost
- **Port**: 3307
- **Database**: ams
- **User**: root
- **Password**: *(empty)*

## How to seed the database
```bash
docker compose exec -T db mysql -u root ams < seeder.sql
```
