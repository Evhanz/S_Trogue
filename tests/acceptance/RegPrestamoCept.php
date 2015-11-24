<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 2/11/2015
 * Time: 7:28 PM
 */


$I = new AcceptanceTester($scenario);

//when
$I->wantTo('Probar el registro de prestamos');
$I->amOnPage('prestamos/getViewNewPrestamo');
$I->see('Formulario de Registro','h3');
$I->fillField('dniProveedor[dni]','47085011');
