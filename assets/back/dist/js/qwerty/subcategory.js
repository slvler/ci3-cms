"use strict";

/*
 * @namespace   : Subcategory
 * @name        : Hs-qwerty
 * @requires    : jQuery, global.js
 * @description : Subcategory CRUD
 */


var Subcategory = {

  subcategoryAdd: function (url,lang,base) {
    var formUrl = '#subcategoryAddForm-' + lang;
    var key = '#key[en]';
    var subcategoryAddData = $(formUrl).serialize();

    if (url != "") {
      $.ajax({
        url: url,
        type: 'POST',
        data: subcategoryAddData,
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
  subcategoryEdit: function (url,lang,base){

    var formUrl = '#subcategoryEditForm-' + lang;
    var key = '#key[en]';
    var subcategoryEditData = $(formUrl).serialize();


    if (url != "") {
      $.ajax({
        url: url,
        type: 'POST',
        data: subcategoryEditData,
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
  subcategoryDelete:function (url,id,base){


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
  subcategoryActive: function (url,id,select,base){

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
  subcategoryImageHead:function (url,id,select,base){

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
  subcategoryImageDelete:function (url,id,base){

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


