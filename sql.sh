docker exec b0ab6e380c3a /usr/bin/mysqldump  -B myDb --routines -u root --password=test > backup.sql
#cat backup.sql | docker exec -i 7c47705e4023 /usr/bin/mysql -u root --password=test myDb