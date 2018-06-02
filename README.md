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