$(document).ready(function() {
  "use strict";
  let dtable = $('.card-table').DataTable({
    columnDefs: [{
      orderable: false,
      className: 'select-checkbox',
      targets: 0,
    }],
    select: {
      style: 'multi+shift', // 'single', 'multi', 'os', 'multi+shift'
      selector: 'td:first-child',
    },
    order: [
      [1, 'asc'],
    ],
  });

  dtable.on('select deselect draw', function () {
    var all = dtable.rows({ search: 'applied' }).count(); // get total count of rows
    var selectedRows = dtable.rows({ selected: true, search: 'applied' }).count();

    if (selectedRows < all) {
      $('#select_all i').attr('class', 'fe fe-square');
    } else {
      $('#select_all i').attr('class', 'fe fe-check-square');
    }
    if(selectedRows < 1){
      $('.delete_btn').html('(' + selectedRows + ') Delete').hide();
    }else{
      $('.delete_btn').html('(' + selectedRows + ') Delete').show();
    }


  });

  $('#select_all').on('click', function () {
    var all = dtable.rows({ search: 'applied' }).count();
    var selectedRows = dtable.rows({ selected: true, search: 'applied' }).count();
    if (selectedRows < all) {
      dtable.rows({ search: 'applied' }).deselect();
      dtable.rows({ search: 'applied' }).select();
    } else {
      dtable.rows({ search: 'applied' }).deselect();
    }
  });


  /*----------------------------
  * delete deals in admin panel
  * -----------------------------*/
  $('.delete_btn.deal').on('click',  function() {
    $("#deal_delete_modal").modal('show');
  });

  $(document).on('click', '.btn-yes-deal',  function() {
    var  values = [];
    $('table tr.selected').each(function () {
      values.push($(this).attr('id'));
    });
    var id = $(this).val();
    $.ajax({
      type: 'post',
      data: {
        "_token": token,
        "id": values
      },
      url: url+'/admin/deal/delete',
      success: function (data) {
        if(data == 'demo'){
          $('#deal_delete_modal').modal('hide');
          $.toast({
            heading: 'Error',
            text: 'Functionality is disabled in demo version',
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'error'
          })
        }else{
          $('#deal_delete_modal').modal('hide');
          $.toast({
            heading: 'Success',
            text: data,
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'success'
          })
          setTimeout(function () {
            location.reload(true);
          }, 1000)
        }
      }
    });

  });
  /*----------------------------
  * edit deals in admin panel
  * -----------------------------*/
  $(document).on('click', '.edit_deal',  function() {
    var id = $(this).val();
    $.ajax({
      type: 'get',
      url: url+'/admin/deals/'+id+'/edit',
      success: function (data) {
        $('#edit-modal').html(data);
        $('#edit-modal').modal('show');
      }
    });
  });



  /*----------------------------
  * delete coin in admin panel
  * -----------------------------*/
  $('.delete_btn.icon').on('click',  function() {
    $("#icon_delete_modal").modal('show');
  });

  $(document).on('click', '.btn-yes',  function() {
    var  values = [];
    $('table tr.selected').each(function () {
      values.push($(this).attr('id'));
    });
    var id = $(this).val();
    $.ajax({
      type: 'post',
      data: {
        "_token": token,
        "id": values
      },
      url: url+'/admin/coin/delete',
      success: function (data) {
        if(data == 'demo'){
          $('#icon_delete_modal').modal('hide');
          $.toast({
            heading: 'Error',
            text: 'Functionality is disabled in demo version',
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'error'
          })

        }else{
          $('#icon_delete_modal').modal('hide');
          $.toast({
            heading: 'Success',
            text: data,
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'success'
          })
          setTimeout(function () {
            location.reload(true);
          }, 1000)
        }

      }
    });

  });

  /*----------------------------
* delete coin in admin panel
* -----------------------------*/
  $('.delete_btn.exchange').on('click',  function() {
    $("#delete-modal").modal('show');
  });


  /*----------------------------
* delete exchange in admin panel
* -----------------------------*/
  $(document).on('click', '.btn-yes-exchange',  function() {
    var  values = [];
    $('table tr.selected').each(function () {
      values.push($(this).attr('id'));
    });

    $.ajax({
      type: 'post',
      data: {
        "_token": token,
        "id": values
      },
      url: url+'/admin/exchange/delete',
      success: function (data) {

        if(data == 'demo'){
          $('#delete-modal').modal('hide');
          $.toast({
            heading: 'Error',
            text: 'Functionality is disabled in demo version',
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'error'
          })
        }else{
          $('#delete-modal').modal('hide');
          $.toast({
            heading: 'Success',
            text: data,
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'success'
          })
          setTimeout(function () {
            location.reload(true);
          }, 1000)
        }
      }
    });

  });

  /*----------------------------------
* Admin user delete and edit
* ----------------------------------*/
  $(document).on('click', '#edit_user',  function() {
    var id = $(this).data('id');
    $.ajax({
      type: 'get',
      url: url+'/admin/users/'+id+'/edit',
      success: function (data) {
        $('#edit-modal').html(data);
        $('#edit-modal').modal('show');
      }
    });
  });


  $('.delete_btn.user').on('click',  function() {
    $("#delete-modal").modal('show');
  });
  $(document).on('click', '.btn-yes-user',  function() {
    var  values = [];
    $('table tr.selected').each(function () {
      values.push($(this).attr('id'));
    });

    $.ajax({
      type: 'post',
      data: {
        "_token": token,
        "id": values
      },
      url: url+'/admin/user/delete',
      success: function (data) {
        if(data == 'demo'){
          $('#delete-modal').modal('hide');
          $.toast({
            heading: 'Error',
            text: 'Functionality is disabled in demo version',
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'error'
          })
        }else{
          $('#delete-modal').modal('hide');
          $.toast({
            heading: 'Success',
            text: data,
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'success'
          })
          setTimeout(function () {
            location.reload(true);
          }, 1000)
        }
      }
    });

  });
  /*----------------------------------
* Admin delete blog
* ----------------------------------*/
  $('.delete_btn.blog').on('click',  function() {
    $("#delete-modal").modal('show');
  });
  $(document).on('click', '.btn-yes-blog',  function() {
    var  values = [];
    $('table tr.selected').each(function () {
      values.push($(this).attr('id'));
    });

    $.ajax({
      type: 'post',
      data: {
        "_token": token,
        "id": values
      },
      url: url+'/admin/blog/delete',
      success: function (data) {
        if(data == 'demo'){
          $('#delete-modal').modal('hide');
          $.toast({
            heading: 'Error',
            text: 'Functionality is disabled in demo version',
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'error'
          })
        }else{
          $('#delete-modal').modal('hide');
          $.toast({
            heading: 'Success',
            text: data,
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'success'
          })
          setTimeout(function () {
            location.reload(true);
          }, 1000)
        }

      }
    });

  });

  /*----------------------------------
* Admin delete alert
* ----------------------------------*/
  $('.delete_btn.alert').on('click',  function() {
    $("#delete-modal").modal('show');
  });

  $(document).on('click', '.btn-yes-alert',  function() {
    var  values = [];
    $('table tr.selected').each(function () {
      values.push($(this).attr('id'));
    });

    $.ajax({
      type: 'post',
      data: {
        "_token": token,
        "id": values
      },
      url: url+'/admin/alert/delete',
      success: function (data) {
        if(data == 'demo'){
          $('#delete-modal').modal('hide');
          $.toast({
            heading: 'Error',
            text: 'Functionality is disabled in demo version',
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'error'
          })
        }else{
          $('#delete-modal').modal('hide');
          $.toast({
            heading: 'Success',
            text: data,
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'success'
          })
          setTimeout(function () {
            location.reload(true);
          }, 1000)
        }
      }
    });

  });

  /*----------------------------------
* Admin delete page
* ----------------------------------*/
  $('.delete_btn.page').on('click',  function() {
    $("#delete-modal").modal('show');
  });

  $(document).on('click', '.btn-yes-page',  function() {
    var  values = [];
    $('table tr.selected').each(function () {
      values.push($(this).attr('id'));
    });

    $.ajax({
      type: 'post',
      data: {
        "_token": token,
        "id": values
      },
      url: url+'/admin/page/delete',
      success: function (data) {
        if(data == 'demo'){
          $('#delete-modal').modal('hide');
          $.toast({
            heading: 'Error',
            text: 'Functionality is disabled in demo version',
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'error'
          })
        }else{
          $('#delete-modal').modal('hide');
          $.toast({
            heading: 'Success',
            text: data,
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'success'
          })
          setTimeout(function () {
            location.reload(true);
          }, 1000)
        }
      }
    });

  });


  /*----------------------------------
* Admin delete review
* ----------------------------------*/
  $('.delete_btn.review').on('click',  function() {
    $("#delete-modal").modal('show');
  });

  $(document).on('click', '.btn-yes-review',  function() {
    var  values = [];
    $('table tr.selected').each(function () {
      values.push($(this).attr('id'));
    });

    $.ajax({
      type: 'post',
      data: {
        "_token": token,
        "id": values
      },
      url: url+'/admin/review/delete',
      success: function (data) {
        if(data == 'demo'){
          $('#delete-modal').modal('hide');
          $.toast({
            heading: 'Error',
            text: 'Functionality is disabled in demo version',
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'error'
          })
        }else{
          $('#delete-modal').modal('hide');
          $.toast({
            heading: 'Success',
            text: data,
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'success'
          })
          setTimeout(function () {
            location.reload(true);
          }, 1000)
        }
      }
    });

  });

  /*----------------------------------
* Admin view review
* ----------------------------------*/
  $(document).on('click', '.btn-view',  function() {
    var id = $(this).val();
    $.ajax({
      type: 'get',
      url: url+'/admin/review/view/'+id,
      success: function (data) {
        if(data != 'error') {
          $('#view-modal').html(data);
          $('#view-modal').modal('show');
        }
      }
    });
  });


  /*----------------------------------
* Admin delete review
* ----------------------------------*/
  $('.delete_btn.subscriber').on('click',  function() {
    $("#delete-modal").modal('show');
  });

  $(document).on('click', '.btn-yes-subscriber',  function() {
    var  values = [];
    $('table tr.selected').each(function () {
      values.push($(this).attr('id'));
    });

    $.ajax({
      type: 'post',
      data: {
        "_token": token,
        "id": values
      },
      url: url+'/admin/subscriber/delete',
      success: function (data) {
        if(data == 'demo'){
          $('#delete-modal').modal('hide');
          $.toast({
            heading: 'Error',
            text: 'Functionality is disabled in demo version',
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'error'
          })
        }else{
          $('#delete-modal').modal('hide');
          $.toast({
            heading: 'Success',
            text: data,
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'success'
          })
          setTimeout(function () {
            location.reload(true);
          }, 1000)
        }
      }
    });

  });



  /*----------------------------------
* Admin delete language
* ----------------------------------*/
  $('.delete_btn.language').on('click',  function() {
    $("#delete-modal").modal('show');
  });

  $(document).on('click', '.btn-yes-language',  function() {
    var  values = [];
    $('table tr.selected').each(function () {
      values.push($(this).attr('id'));
    });

    $.ajax({
      type: 'post',
      data: {
        "_token": token,
        "id": values
      },
      url: url+'/admin/settings/language/delete',
      success: function (data) {
        if(data == 'demo'){
          $('#delete-modal').modal('hide');
          $.toast({
            heading: 'Error',
            text: 'Functionality is disabled in demo version',
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'error'
          })
        }else{
          $('#delete-modal').modal('hide');
          $.toast({
            heading: 'Success',
            text: data,
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'success'
          })
          setTimeout(function () {
            location.reload(true);
          }, 1000)
        }

      }
    });

  });


  /*----------------------------
* show hide fields on toggle
* -----------------------------*/

  $("#captcha").change(function() {
    if(this.checked) {
      $('.site_key').show();
    }else{
      $('.site_key').hide();
    }
  });


  /*---------------------------------
  * language toggle
  * *********************************/

  $('.custom-switch.lang input').on('change', function() {
    $('.custom-switch.lang input').not(this).prop('checked', false);

    var short_name = $(this).val();

    $.ajax({
      type: 'post',
      data: {
        "_token": token,
        "short_name": short_name
      },
      url: url+'/admin/settings/language/switch',
      success: function (data) {
        if(data == 'demo'){
          $.toast({
            heading: 'Error',
            text: 'Functionality is disabled in demo version',
            showHideTransition: 'slide',
            position: 'top-right',
            icon: 'error'
          })
        }
        if(data != 'true' && data != 'demo') {
          $('.custom-switch.lang input').each(function () {
            if ($(this).is(':checked')) {
              $(this).prop('checked', false)
            }
          });

        }else{
          setTimeout(function () {
            location.reload(true);
          }, 1000)
        }
      },
      error:function () {
        $('.custom-switch.lang input').each(function () {
          if ($(this).is(':checked')) {
            $(this).prop('checked', false)
          }
        })
      }
    });

  });

});
