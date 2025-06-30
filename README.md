# Kring Politieofficieren

Project for the course @Work 3  
Dirk Bouckaert  
Arteveldehogeschool 2024-25

## Get started

- You need to have Docker and [DDEV](https://ddev.com/) installed.

- Download or clone this repository.

- Copy `.env.example` and rename it to `.env`.

  - Database: for development SQLite is okay. For production use MySQL or PostgreSQL.
  - Add mail credentials.

- Then run the following commands to get started:

```bash
# Install dependencies
ddev composer install
ddev npm install
ddev npm run build

# Generate application key
ddev artisan key:generate

# Create storage symlink
ddev artisan storage:link

# Create database and run migrations
ddev artisan migrate
ddev artisan db:seed

# Start the application
ddev start
ddev launch
```

## Development server with hot reload

To start the development server with hot reload, run the following command:

```bash
ddev browsersync
```

## Notes

### Images not showing

If the images are not showing or if DDEV generates a mutagen error ('link is absolute'), you should ssh into the DDEV server, remove any storage links and generate a symbolic link manually. You can do this like so:

```bash
ddev ssh
cd public
unlink storage
ln -s ../storage/app/public storage
exit
```

### For production

- Don't forget to run `npm run build` to build the assets.
- In `.env` set `APP_DEBUG=false` .

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
