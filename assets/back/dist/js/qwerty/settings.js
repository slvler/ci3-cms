"use strict";

/*
 * @namespace   : Settings
 * @name        : Hs-qwerty
 * @requires    : jQuery, global.js
 * @description : Setting CRUD
 */


var Settings = {

  settingsAdd: function (url,base){

    var settingsAddData = $("#settingsAddForm").serialize();

    if (url != "") {
      $.ajax({
        url: url,
        type: 'POST',
        data: settingsAddData,
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
  settingsEdit: function (url,base,id){

    var formUrl = '#settingsEditForm-' + id;
    var settingsEditData = $(formUrl).serialize();


    if (url != "") {
      $.ajax({
        url: url,
        type: 'POST',
        data: settingsEditData,
        //data: {lang: lang},
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

  settingGenerelAdd: function (url,base){


    var title = $("#generaltitle").val();
    var desc = $("#generalDesc").val();
    var keywords = $("#generalKeywords").val();
    var analytics = $("#generalAnalytics").val();
    var metrica = $("#generalMetrica").val();
    var select = $("#generalselect").val();

    var host = $("#smpthost").val();
    var port = $("#smptport").val();
    var mail = $("#smptmail").val();
    var pass = $("#smptpass").val();
    var id = $("#generalid").val();


    if (url != "") {
      $.ajax({
        url: url,
        type: 'POST',
        data:{title: title,desc:desc,keywords:keywords,analytics:analytics,metrica:metrica,select:select,host:host,port:port,mail:mail,pass:pass,id:id},
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

  settingsGalleryAdd:function (url,base){

    let files = new FormData();

    files.append('name',$('#galleryName').val());
    files.append('fileName', $('#galleryFile')[0].files[0]);
    files.append('select',$('#gallerySelect').val());
    files.append('id',$('#galleryId').val());

    if (url != "") {
      $.ajax({
        url: url,
        type: 'POST',
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        cache: false,
        data:files,
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
