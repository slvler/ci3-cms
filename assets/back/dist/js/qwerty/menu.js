"use strict";

/*
 * @namespace   : Menu
 * @name        : Hs-qwerty
 * @requires    : jQuery, global.js
 * @description : Menu CRUD
 */


var Menu = {

  menuAdd:function (url,base){

    var menuAddData = $('#menuAddForm').serialize();

    if (url != "") {
      $.ajax({
        url: url,
        type: 'POST',
        data: menuAddData,
        //data: { title: title, lang: lang},
        success: function (result) {
          var data = JSON.parse(result);
          if(data.active == "warning"){
            modalSection.modalCategoryError(data.status,data.text);
          }else {
            modalSection.modalCategoryAccept(data.status,data.text);
            setTimeout(function(){// wait for 5 secs(2)
              window.location.href = base;
            }, 1000);
          }
        }
      });
    } else {
      $('#modalExtraProductInfo .modal-body').html("Sipariş miktarı girilmeden ekstra ürün eklenemez!");
      $(modalExtra).modal("show");
    }





  }

};
