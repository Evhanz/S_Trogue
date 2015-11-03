<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 2/11/2015
 * Time: 7:28 PM
 */

$I = new AcceptanceTester($scenario);

//when
$I->amOnPage('public/prestamos/getViewNewPrestamo');
$I->see('Formulario de Registro');
//And
$I->click('regAcopio1');
//Then
$I->see('Registrar Acopio','h2');
