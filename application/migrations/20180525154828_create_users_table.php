<?php  if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// You can find dbforge usage examples here: http://ellislab.com/codeigniter/user-guide/database/forge.html


class Migration_Create_users_table extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }
    
    public function up()
    {
        $fields = array(
            'id' => array(
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>true,
                'auto_increment' => true
            ),
            'first_name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
            ),
            'last_name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
            ),
            'email' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
            ),
            'password' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
            ),
            'company' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
            ),
            'title' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
            ),
            'address' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
            ),
            'city' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
            ),
            'phone' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '30',
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('users', true);
    }
    
    public function down()
    {
        $this->dbforge->drop_table('users', true);
    }
}
/* End of file '20180525154828_create_users_table' */
/* Location: .//var/www/html/codeigniter/application/migrations/20180525154828_create_users_table.php */
