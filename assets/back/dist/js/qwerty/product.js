"use strict";

/*
 * @namespace   : Product
 * @name        : Hs-qwerty
 * @requires    : jQuery, global.js
 * @description : Product CRUD
 */


var Product = {



  productcategoryselect:function (url){
    var categoryId = $("#category").val();

    $(".ProductDate").remove();

    if (url != "") {
      $.ajax({
        url: url,
        type: 'POST',
        data: {id:categoryId},
        //data: { title: title, lang: lang},
        success: function (result) {

          var data = JSON.parse(result);


          $.each(data , function(index, val) {
            $('#subcategory').append('<option id="ProductDate" class="ProductDate" value="'+ index + '">'+ val + '</option>');
          });




        }
      });
    } else {
      $('#modalExtraProductInfo .modal-body').html("Sipariş miktarı girilmeden ekstra ürün eklenemez!");
      $(modalExtra).modal("show");
    }
  },
  productAdd:function (url,lang,base){

    var formUrl = '#productAddForm-' + lang;
    var productAddData = $(formUrl).serialize();


    if (url != "") {
      $.ajax({
        url: url,
        type: 'POST',
        data: productAddData,
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
  productEdit:function (url,lang,base){

    var formUrl = '#productEditForm-' + lang;
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
  productActive: function (url,id,select,base){

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



};

