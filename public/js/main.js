/**
 * Created by Evhanz on 5/12/2015.
 */
//funciones helper

function convertDateToString(fecha){

    var año = fecha.getFullYear();
    var mes = fecha.getMonth()+1;
    var dia = fecha.getDate();

    var format_fecha = ""+año+"-"+mes+"-"+dia;

    return format_fecha;

}

//funciones helper

function convertStringToDate(fecha){

    var t = fecha.split("-");

    var format_fecha  = new Date( t[0],t[1]-1,t[2]);

    return format_fecha;

}