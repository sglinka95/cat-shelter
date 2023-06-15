## REST API for Cat shelter

## Installation
- Clone project
- Go to the folder application using cd command on your cmd or terminal
- Run ```composer install``` on your cmd or terminal
- Copy .env.example file to .env on the root folder. You can type ```copy .env.example .env``` if using command prompt Windows or ```cp .env.example .env``` if using terminal, Ubuntu
- Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
- Run ```php artisan key:generate```
- Run ```php artisan migrate```
- Run ```php artisan db:seed```
- Run ```php artisan serve```
- Go to http://localhost:8000/

## Usage
To retrieve cats, employees or departments data use:
<pre>
GET /api/cats
GET /api/employees
GET /api/departments
</pre>

To filter retrieved cats or employees data use:
<pre>
GET /api/cats?sex[eq]=male
GET /api/employees?position[eq]=volunteer
</pre>
To create cats, employees or departments data use:
<pre>
POST /api/cats
POST /api/employees
POST /api/departments
</pre>

To update cats, employees or departments data use:
<pre>
PUT /api/cats/{uuid}
PUT /api/employees/{uuid}
PUT /api/departments/{uuid}
</pre>

To delete cats, employees or departments data use:
<pre>
DELETE /api/cats/{uuid}
DELETE /api/employees/{uuid}
DELETE /api/departments/{uuid}
</pre>

## License

Open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
