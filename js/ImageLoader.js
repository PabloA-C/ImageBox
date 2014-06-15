

var dataStore = (function() {
    var xml;

    $.ajax({
        url: 'data.xml',
        dataType: 'xml',
        success: loadData,
        error: displayError
    });

    return {getXml: function()
        {
            if (xml)
                return xml;
            // else show some error that it isn't loaded yet;
        }};
})();


loadData(dataStore);

function loadData(xml) {

    var cont = 0;
    $(xml).find('channel item').each(function() {

        var equivalence = $(this).find('description').text();
        var currencies = $(this).find('title').text();

        var currencyID = currencies.substring(0, 3);
        var currencyValue = equivalence.substring(9, 16);
        var currentRate = Number(currencyValue);

        if (cont < 31) {
            $('.rate1 ul').append(
                    $('<li /> <button  class="buttonCustom" OnClick="change(\'' + currencyID + '\',\'' + currencyValue + '\');">' + currencyID + " " + currencyValue + '</button>', {
                    })


                    );
        }

        if (cont > 30 && cont < 62) {
            $('.rate2 ul').append(
                    $('<li /> <button  class="buttonCustom" OnClick="change(\'' + currencyID + '\',\'' + currencyValue + '\');">' + currencyID + " " + currencyValue + '</button>', {
                    })


                    );
        }

        if (cont > 61) {
            $('.rate3 ul').append(
                    $('<li /> <button  class="buttonCustom" OnClick="change(\'' + currencyID + '\',\'' + currencyValue + '\');">' + currencyID + " " + currencyValue + '</button>', {
                    })


                    );
        }

        cont++;
    });
}

function displayError() {
    alert('Error');
}

function change(id, value) {

    $('.currency').html('<div id="currency"> <h2>1 <strong> ' + id + ' </strong> is worth:</h2>');
    var newRate = Number(value);
    rate = newRate;
    updateValues();

//Lo deje buscando la manera de actualizar los valores de las listas con los nuevos rates, la idea ultima 
//fue creat un nuevo documento xml, pero no se como se podrá recargar de nuevo.

}

function save() {
    alert('Save as PDF');
}

function updateValues() {



 

}
