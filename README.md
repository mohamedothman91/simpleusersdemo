# Simple Users Demo (Login - Crud Controller - Api - UnitTest )

- clone repo 
<pre>
git clone https://github.com/mohamedothman91/simpleusersdemo.git
</pre>
- update dependencies
<pre>
    cd simpleusersdemo/
    composer update
</pre>
- edit config database (simpleusersdemo/application/config/database.php)
<pre>
    $db['default']
    $db['sqlsrv']
</pre>
- run migration file migrate users table 
<pre>
   run url : {base_url}/simpleusersdemo/public/migrate
</pre>
- Login url (first time you can login with google +)
<pre>
   run url : {base_url}/simpleusersdemo/public/auth
</pre>