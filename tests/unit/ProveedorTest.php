<?php
use Trogue\User;
use trogue\Entities\Proveedor;
class ProveedorTest extends \Codeception\TestCase\Test
{
    /**
     * @var UnitTester
     */

    public  $tester;

    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    // tests
    public function testMe()
    {

    }
    public function testValidation()
    {

        $email = 'johndoe@example.com';
        $password = Hash::make('password');

        $user = new User();
        $user->email = $email;
        $user->password =$password;
        $user->save();
       // $pro = $this->tester->seeRecord('users', ['email' => $email, 'password' => $password]);

    }

    public function testValidate_ingresar_proveedor(){

        $proveedor = new Proveedor();
        $proveedor->name = "Jarvan";
        $proveedor->apellidoP = 'Miljhot';
        $proveedor->apellidoM = 'Kirintho';
        $proveedor->dni = 47085911;
        $proveedor->celular = 47085011;
        $proveedor->estado = true;
        $proveedor->anexo_id = 1;
        $proveedor->save();


    }
}
