<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 2/11/2015
 * Time: 7:28 PM
 */


$I = new FunctionalTester($scenario);

//when
$I->wantTo('Probar el registro de prestamos');
$I->amOnPage('prestamos/getViewNewPrestamo');
$I->see('Formulario de Registro','h3');
$I->fillField('dniProveedor','qw');
$I->dontSeeElement('#dniProveedor', ['value' => 'qw']);
$I->click(':::');
$I->see('Exito');
$I->selectOption('#selRecuso','1');
$I->fillField('#descripcion','prestamo rapido');
$I->fillField('#cantidad','a');
$I->dontSeeElement('#cantidad', ['value' => 'a']);
$I->click('#btnGuardar');

