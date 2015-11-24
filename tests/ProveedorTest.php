<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 12/10/2015
 * Time: 7:03 PM
 */

use trogue\Entities\Anexo;
class ProveedorTest extends TestCase {


    /**
     * A basic functional test example.
     *
     * @return void
     */

    public function testBasicExample()
    {
        $anexo = new Anexo();

        $response = $this->call('GET', 'helper/getAnexoByRuta/', ['id'=>1]);


    }


    public function testVista()
    {
        $this->call('GET', 'Control_Calidad/RegInsidencia');

        $this->assertViewHas('Control/viewAllProveedores');
    }

}
