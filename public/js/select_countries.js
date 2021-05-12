/**
 * Soporte para cargar estados, ciudades o provincias y distritos
 * Carga el combobox de estado/departamento si cambio el combobox pais
 * Carga el combobox de ciudades o provincias si cambio el combobox estado
 * Carga el combobox de distritos si cambio el combobox provincias
 * @param {object} options
 */
function eventChangeUbigeoSelect(options) {

  var $cboCountry = (options.selects.idCboCountry === undefined) ? null : $(options.selects.idCboCountry);
  var $cboState = (options.selects.idCboState === undefined) ? null : $(options.selects.idCboState);
  var $cboCity = (options.selects.idCboCity === undefined) ? null : $(options.selects.idCboCity);
  var $cboProvince = (options.selects.idCboProvince === undefined) ? null : $(options.selects.idCboProvince);
  var $cboDistrict = (options.selects.idCboDistrict === undefined) ? null : $(options.selects.idCboDistrict);
  var $containerCity = (options.containers.idContainerCity === undefined) ? null : $(options.containers.idContainerCity);
  var $containerProvince = (options.containers.idContainerProvince === undefined) ? null : $(options.containers.idContainerProvince);
  var $containerDistrict = (options.containers.idContainerDistrict === undefined) ? null : $(options.containers.idContainerDistrict);

  var urlsBaseAjax = {
    getCountries: (options.urlsBaseAjax.getCountries === undefined) ? '' : options.urlsBaseAjax.getCountries,
    getStatesByCountry: (options.urlsBaseAjax.getStatesByCountry === undefined) ? '' : options.urlsBaseAjax.getStatesByCountry,
    getCitiesByState: (options.urlsBaseAjax.getCitiesByState === undefined) ? '' : options.urlsBaseAjax.getCitiesByState,
    getProvincesByState: (options.urlsBaseAjax.getProvincesByState === undefined) ? '' : options.urlsBaseAjax.getProvincesByState,
    getDistrictsByProvince: (options.urlsBaseAjax.getDistrictsByProvince === undefined) ? '' : options.urlsBaseAjax.getDistrictsByProvince
  };

  var requestAjax = function (url, callbackSuccess, callbackFailed) {
    $.ajax({
      type: 'GET',
      url: url,
      dataType: 'JSON',
      success: function (results) {
        callbackSuccess(results);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        callbackFailed();
      }
    });
  };

  // ** Cargar estados/departamentos por país **
  if ($cboCountry) {
    $cboCountry.on('change', function () {
      var countryID = $(this).val();
      // Limpiar combobox de estados, ciudades o provincias, distritos
      emptyCombobox($cboState);
      emptyCombobox($cboCity);
      emptyCombobox($cboProvince);
      emptyCombobox($cboDistrict);
      // Mostrar Ciudad, Ocultar Provincia, y distrito
      $containerCity.show();
      $containerProvince.hide();
      $containerDistrict.hide();
      // Listar Departamento
      requestAjax(urlsBaseAjax.getStatesByCountry + '/' + countryID, function (results) {
        if (results.header.code == 1) {
          var lstStates = results.response.data;
          fillCombobox($cboState, lstStates, 'location_id', 'location_name');
        } else {
          fillCombobox($cboState, []);
        }
      });
    });
  }

  // ** Cargar ciudades o provincias(Perú) por estado **
  if ($cboState) {
    $cboState.on('change', function () {
      var stateID = $(this).val();
      var countryID = $cboCountry.val();

      // Limpiar combobox de estados, ciudades o provincias, distritos
      emptyCombobox($cboCity);
      emptyCombobox($cboProvince);
      emptyCombobox($cboDistrict);
      // Ocultar distrito
      $containerDistrict.hide();

      // Cargar Provincias si el país es Perú *
      if (countryID == 168) {
        $containerProvince.show();
        $containerCity.hide();
        // Listar provincias
        requestAjax(urlsBaseAjax.getProvincesByState + '/' + stateID, function (results) {
          if (results.header.code == 1) {
            var lstProvinces = results.response.data;
            fillCombobox($cboProvince, lstProvinces, 'location_id', 'location_name');
          } else {
            fillCombobox($cboProvince, []);
          }
        });

      } else { // Cargar Ciudades *
        $containerCity.show();
        $containerProvince.hide();
        // Listar estados
        requestAjax(urlsBaseAjax.getCitiesByState + '/' + stateID, function (results) {
          if (results.header.code == 1) {
            var lstCities = results.response.data;
            fillCombobox($cboCity, lstCities, 'location_id', 'location_name');
          } else {
            fillCombobox($cboCity, []);
          }
        });
      }

    });
  }

  // ** Cargar distritos por provincia **
  if ($cboProvince) {
    $cboProvince.on('change', function () {
      var provinceID = $(this).val();
      // Mostrar contenedor de distritos
      $containerDistrict.show();
      // Limpiar combobox de estados, ciudades o provincias, distritos
      emptyCombobox($cboDistrict);
      // Listar distritos
      requestAjax(urlsBaseAjax.getDistrictsByProvince + '/' + provinceID, function (results) {
        if (results.header.code == 1) {
          var lstDistricts = results.response.data;
          fillCombobox($cboDistrict, lstDistricts, 'location_id', 'location_name');
        } else {
          fillCombobox($cboDistrict, []);
        }
      });
    });
  }
}

/**
 * Llenar un combobox
 * @param {JQuery Object} $cbo
 * @param {array} data
 * @param {text} columnNameValue
 * @param {text} columnNameLabel
 * @param {mixed} valueSelected
 */
function fillCombobox($cbo, data, columnNameValue, columnNameLabel, valueSelected) {
  $cbo.empty();
  if (data.length > 0) {
    $cbo.append('<option value=""> Seleccione </option>');
    // Añadir datos
    for (var x in data) {
      var $option = $('<option/>');
      $option.attr('value', data[x][columnNameValue]);
      $option.text(data[x][columnNameLabel]);
      // Seleccionar valor (Opcional)
      if (valueSelected) {
        if (data[x][columnNameValue] == valueSelected) {
          $option.attr('selected', 'selected');
        }
      }

      $cbo.append($option);
    }
  } else {
    $cbo.append('<option value=""> No hay elementos en la lista </option>');
  }
}

/**
 * Limpiar combobox
 * @param {JQuery Object} $cbo
 * @param {text} text
 */
function emptyCombobox($cbo, text) {
  text = (text === undefined) ? '----' : text;
  $cbo.empty();
  $cbo.append('<option value="">' + text + '</option>');
}