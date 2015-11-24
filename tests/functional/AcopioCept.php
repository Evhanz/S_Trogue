<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('testear el ingreso de Acopio');
$I->amOnPage('Control_Calidad/Acopio/all');
$I->see('Módulo de Control y calidad');
$I->click('regAcopio1');
$I->see('Registrar Acopio','h2');

/*
$I->fillField('fecha','2015/02/01');
$I->fillField('Cantidad','20');*/

$I->submitForm('#formRegModal',['hdId'=>'1','fecha'=>'2015/12/5','Cantidad'=>20]);
$I->see('Error');
