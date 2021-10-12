"use strict";

/*
 * @namespace   : Modal Section
 * @name        : Hs-qwerty
 * @requires    : jQuery, global.js
 * @description : Model Shema
 */

var indexCartItem = 0;

var modalSection = {

  modalCategoryError: function (status,text) {

   var modal =  '<div class="modal" id="myModal">\n' +
    '    <div class="modal-dialog">\n' +
    '        <div class="modal-content">\n' +
    '\n' +
    '            <!-- Modal Header -->\n' +
    '            <div class="modal-header">\n' +
    '                <h4 class="modal-title">'+ status +'</h4>\n' +
    '                <button type="button" class="close" data-dismiss="modal">&times;</button>\n' +
    '            </div>\n' +
    '\n' +
    '            <!-- Modal body -->\n' +
    '            <div class="modal-body">\n' +
    '                '+ text +'\n' +
    '            </div>\n' +
    '\n' +
    '            <!-- Modal footer -->\n' +
    '            <div class="modal-footer">\n' +
    '                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>\n' +
    '            </div>\n' +
    '\n' +
    '        </div>\n' +
    '    </div>\n' +
    '</div>';

    $(modal).modal('show');
  },
  modalCategoryAccept: function (status,text){

    var modal =  '<div class="modal" id="myModal">\n' +
      '    <div class="modal-dialog">\n' +
      '        <div class="modal-content">\n' +
      '\n' +
      '            <!-- Modal Header -->\n' +
      '            <div class="modal-header">\n' +
      '                <h4 class="modal-title">'+ status +'</h4>\n' +
      '                <button type="button" class="close" data-dismiss="modal">&times;</button>\n' +
      '            </div>\n' +
      '\n' +
      '            <!-- Modal body -->\n' +
      '            <div class="modal-body">\n' +
      '                '+ text +'\n' +
      '            </div>\n' +
      '\n' +
      '            <!-- Modal footer -->\n' +
      '            <div class="modal-footer">\n' +
      '                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>\n' +
      '            </div>\n' +
      '\n' +
      '        </div>\n' +
      '    </div>\n' +
      '</div>';

    $(modal).modal('show');


  },
  modalLanguageForm: function (url,base){


    var modal =  '<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">\n' +
      '  <div class="modal-dialog modal-lg">\n' +
      '    <div class="modal-content">\n' +
      '       <form id="settingsAddForm"  method="post">\n' +
      '         <div class="card-body">\n' +
      '          <div class="form-group">\n' +
      '            <label for="exampleInputEmail1">Language</label>\n' +
      '            <input type="text" name="language" class="form-control" placeholder="Language">   ' +
      '           </div>\n' +
      '            <div class="form-group">\n' +
      '           <label for="exampleInputEmail1">Lang Key</label>\n' +
      '           <input type="text" name="langkey" class="form-control" id="exampleInputEmail1" placeholder="Keywords">\n' +
      '            </div>\n' +
      '            <div class="form-group">\n' +
      '             <div class="form-group">\n' +
      '             <label>Select</label>\n' +
      '              <select name="select" class="form-control">\n' +
      '             <option value="1">Active</option>\n' +
      '            <option value="0">Passive</option>\n' +
      '              </select>\n' +
      '                </div>\n' +
      '                </div>\n' +
      '               </div>\n' +
      '            <div class="card-footer">\n' +
      '          <button style="float: right;" onclick=\"(Settings.settingsAdd(\'' + url  + '\', \'' + base + '\'))"\   type="button" class="btn btn-primary">Submit</button>\n' +
      '      </div>\n' +
      '     </form>\n'+
      '    </div>\n' +
      '  </div>\n' +
      '</div>';

    $(modal).modal('show');
  },
  modalLanguageEditForm:function (url,base,id,lang,lang_key){



    var modal =  '<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">\n' +
      '  <div class="modal-dialog modal-lg">\n' +
      '    <div class="modal-content">\n' +
      '       <form id="settingsEditForm-'+id+'" method="post">\n' +
      '         <div class="card-body">\n' +
      '          <div class="form-group">\n' +
      '            <label for="exampleInputEmail1">Language</label>\n' +
      '            <input type="text" name="language" id="lang" class="form-control" value="' + lang + '">' +
      '           </div>\n' +
      '            <div class="form-group">\n' +
      '           <label for="exampleInputEmail1">Lang Key</label>\n' +
      '           <input type="text" name="langkey" class="form-control" id="exampleInputEmail1" value="'+ lang_key +'">\n' +
      '            </div>\n' +
      '              <input name="id" type="hidden" value="'+ id +'">\n' +
      '               </div>\n' +
      '            <div class="card-footer">\n' +
      '          <button style="float: right;" onclick=\"(Settings.settingsEdit(\'' + url  + '\', \'' + base + '\',\'' + id + '\'))"\   type="button" class="btn btn-primary">Submit</button>\n' +
      '      </div>\n' +
      '     </form>\n'+
      '    </div>\n' +
      '  </div>\n' +
      '</div>';

    $(modal).modal('show');
  },
  modalSettingsGallery:function (url,base,id){

    var modal =  '<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">\n' +
      '  <div class="modal-dialog modal-lg">\n' +
      '    <div class="modal-content">\n' +
      '       <form id="settingsGalleryForm" enctype="multipart/form-data"  method="post">\n' +
      '         <div class="card-body">\n' +
      '          <div class="form-group">\n' +
      '            <label for="exampleInputEmail1">Name</label>\n' +
      '            <input type="text" id="galleryName" name="language" class="form-control" placeholder="Gallery Name">   ' +
      '           </div>\n' +
      '          <div class="form-group">\n' +
      '            <label for="exampleInputEmail1">Gallery</label>\n' +
      '            <input type="file" name="file" id="galleryFile" class="form-control" placeholder="Gallery Name">   ' +
      '           </div>\n' +
      '            <div class="form-group">\n' +
      '             <div class="form-group">\n' +
      '             <label>Gallery</label>\n' +
      '              <select name="select" id="gallerySelect" class="form-control">\n' +
      '              <option value="0">Logo</option>\n' +
      '             <option value="1">Banner</option>\n' +
      '             <option value="2">Fav Icon</option>\n' +
      '              </select>\n' +
      '                </div>\n' +
      '                </div>\n' +
      '              <input name="id" id="galleryId" type="hidden" value="'+ id +'">\n' +
      '               </div>\n' +
      '            <div class="card-footer">\n' +
      '          <button style="float: right;" onclick=\"(Settings.settingsGalleryAdd(\'' + url  + '\', \'' + base + '\'))"\   type="button" class="btn btn-primary">Gallery Add</button>\n' +
      '      </div>\n' +
      '     </form>\n'+
      '    </div>\n' +
      '  </div>\n' +
      '</div>';

    $(modal).modal('show');
  }
};


