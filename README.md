# Base API

## Conventions
### Migrations and Models
- Models must use `App\Models\` namespace
- Name tables in singular (i.e. `user` instead of `users`)
- Tables must use `char(32)` as `id`. This project use `uuid`.
- All models with `id` must use `Alsofronie\Uuid\Uuid32ModelTrait` trait.