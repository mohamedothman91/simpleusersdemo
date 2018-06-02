# Simple Users Demo (Login - Crud Controller - Api - UnitTest )

- Clone repo 
<pre>
git clone https://github.com/mohamedothman91/simpleusersdemo.git
</pre>
- Update dependencies
<pre>
    cd simpleusersdemo/
    composer update
</pre>
- Edit config database (simpleusersdemo/application/config/database.php)
<pre>
    $db['default']
    $db['sqlsrv']
</pre>
- Run migration file migrate users table 
<pre>
   run url : {base_url}/simpleusersdemo/public/migrate
</pre>
- Login url (first time you can login with google +)
<pre>
   run url : {base_url}/simpleusersdemo/public/auth
</pre>
- Run Unit Test
<pre>
   ./vendor/bin/codecept run --steps
</pre>
- API Users
<pre>
   Name : Get All Users - Get User By Id
   URL : {base_url}/simpleusersdemo/public/api/users
   METHOD : GET
   Parameters : format (optional for format json-xml-html) , id (optional for filter user by id)
</pre>
<pre>
   Name : Create New User
   URL : {base_url}/simpleusersdemo/public/api/users
   METHOD : POST
   Parameters : (required fields: first name, last name, email and passowrd)
                (optional fields: company, title, address, country, city and phone)
</pre>
<pre>
   Name : Edit User
   URL : {base_url}/simpleusersdemo/public/api/users
   METHOD : PUT
   Parameters : (required fields: id )
                (optional fields: first name, last name, email and passowrd , company, title, address, country, city and phone)
</pre>
<pre>
   Name : Delete User
   URL : {base_url}/simpleusersdemo/public/api/users
   METHOD : DELETE
   Parameters : (required fields: id (Get parameter) )
</pre>