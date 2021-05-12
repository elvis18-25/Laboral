eventChangeUbigeoSelect({
    selects: {
      'idCboCountry': '#cbo-country',
      'idCboState': '#cbo-state',
      'idCboCity': '#cbo-city',
      'idCboProvince': '#cbo-province',
      'idCboDistrict': '#cbo-district'
    },
    containers: {
      'idContainerCity': '.container-city',
      'idContainerProvince': '.container-province',
      'idContainerDistrict': '.container-bussiness-district'
    },
    urlsBaseAjax: {
      'getStatesByCountry': 'http://mipagina.com/get_states_of_country',
      'getCitiesByState': 'http://mipagina.com/get_cities_of_state',
      'getProvincesByState': 'http://mipagina.com/get_provinces_of_state',
      'getDistrictsByProvince': 'http://mipagina.com/get_districts_of_province'
    }
  });