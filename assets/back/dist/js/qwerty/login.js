"use strict";

/*
 * @namespace   : Login
 * @name        : Hs-qwerty
 * @requires    : jQuery, global.js
 * @description : Login CRUD
 */


var Login = {

  accept:function (url){

    var loginAddData = $("#loginForm").serialize();

    if (url != "") {
      $.ajax({
        url: url,
        type: 'POST',
        data: loginAddData,
        //data: { title: title, lang: lang},
        success: function (result) {

          var data = JSON.parse(result);
          if(data.active == "yes"){
            alert("success");
            setTimeout(function(){// wait for 5 secs(2)
              window.location.href = data.url;
            }, 1000);
          }else {
            alert("hata");
          }
        }
      });
    } else {
      $('#modalExtraProductInfo .modal-body').html("Sipariş miktarı girilmeden ekstra ürün eklenemez!");
      $(modalExtra).modal("show");
    }


  },


};
