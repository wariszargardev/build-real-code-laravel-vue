# Build Real Code (Laravel + Vue demo app)

Demo code for the Build Real Code channel. Content lives in `D:\Social Media\content-pack`.

- Always use the `build-real-code` skill for any work here ("day N", "day N part M", "long video day N").
- One branch per content-pack day, named like the day folder (`day-01-laravel-eager-loading`).
- Pattern: web route → controller → service (one commented block per topic) → Blade view. `LogDatabaseQueries` + `<x-query-log>` show the query count on the page and write it to `storage/logs/demo.log`.
- Clean, self-explaining names; no repetition. Push only when Waris says so.
- Local MySQL on 127.0.0.1:3307: start with `D:\Afia Insurance\Projects\Personal\.mysql-brc\start-mysql.ps1`.
- Tests: `php vendor/bin/pest --compact <file>`. Format: `vendor/bin/pint --dirty`.
