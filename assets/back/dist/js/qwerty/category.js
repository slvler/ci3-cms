"use strict";

/*
 * @namespace   : Category
 * @name        : Hs-qwerty
 * @requires    : jQuery, global.js
 * @description : Category CRUD
 */

var indexCartItem = 0;



var Category = {

  categoryAdd: function (url,lang,base) {
    var formUrl = '#categoryAddForm-' + lang;
    var key = '#key[en]';
    var categoryAddData = $(formUrl).serialize();

    if (url != "") {
      $.ajax({
        url: url,
        type: 'POST',
        data: categoryAddData,
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
  },
  categoryEdit: function (url,lang,base){
    var formUrl = '#categoryAddForm-' + lang;
    var key = '#key[en]';
    var categoryAddData = $(formUrl).serialize();

    if (url != "") {
      $.ajax({
        url: url,
        type: 'POST',
        data: categoryAddData,
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

  },
  categoryDelete:function (url,id,base){


    if (url != "") {
      $.ajax({
        url: url,
        type: 'POST',
        //data: subcategoryEditData,
        data: { id: id},
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
  },
  categoryActive: function (url,id,select,base){

    if (url != "") {
      $.ajax({
        url: url,
        type: 'POST',
        data: {id:id, select:select },
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

  },
  categoryImageHead:function (url,id,select,base){

    if (url != "") {
      $.ajax({
        url: url,
        type: 'POST',
        data: {id:id, select:select },
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

  },
  categoryImageDelete:function (url,id,base){

    if (url != "") {
      $.ajax({
        url: url,
        type: 'POST',
        data: {id:id },
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


