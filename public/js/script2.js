$(document).ready(function () {
  "use strict";
  /*homepage slider*/
  $('.camp_slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    arrows:false,
    dots:true,
    autoplay: true,
    autoplaySpeed: 3000,
  });
  $('.camp_slider2').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    arrows:false,
    dots:true,
    autoplay: true,
    autoplaySpeed: 3000,
  });

  $(document).ready(function () {
    $('#trading_form').submit(function (e) {
      e.preventDefault();
      if ($('#type_buy').is(':checked')) {
        var action = 'buy'
      }else{
        var action = 'sell'
      }
      if($('.coins_data').val() != ''){

        var coin = $('.coins_data').val();
        window.location.replace(url+'/trade/'+action+'/'+coin)
      }
    })
  });

  /*Subscribe form request*/
  $('#subscribe_btn').on('click', function(){
    var sub_email = $('#email_input').val();
    $.ajax({
      type: 'post',
      url: url+'/subscribe',
      data: {
        email:sub_email,
        _token:token
      },
      success: function(data){
        $('#email_input').val('');
        $('#sub_msg_error').text('');
        $('#sub_msg_success').text(data);
      },
      error: function(){
        $('#sub_msg_success').text('');
        $('#sub_msg_error').text('Email already exists or Not a valid email');
      }
    });
  });


  /*alert form submit*/
  $('#price-alert-form').on('submit', function (e) {
    e.preventDefault();
    var data = $('#price-alert-form').serialize();
    $.ajax({
      type: 'post',
      url: url+'/price-alert',
      data: data,
      success: function(data){
        $('.alert_success').text(data);
        $('.alert_success').show();
        $('.alert_error').hide();
        $("#price-alert-form input").val("");
      },
      error: function(reject){
        if( reject.status === 422 ) {
          var errors = $.parseJSON(reject.responseText);
          $.each(errors.errors, function (key, val) {
            $('.alert_error').append(val+"<br>");
            $('.alert_error').show();
            $('.alert_success').hide();
          });
        }
      }
    });
  });

  /*Trading page*/
  $(function() {
    $('span.stars').stars();
  });

  $.fn.stars = function() {
    return $(this).each(function() {
      var val = parseFloat($(this).html());
      var size = Math.max(0, (Math.min(5, val))) * 16;
      var $span = $('<span />').width(size);
      $(this).html($span);
    });
  };

  $('.filter_toggle').on('click', function () {
    $('#filters').toggleClass('show');
  });

  $('.checkbox input').on('change', function () {
    $('#filter_form').submit();
  });

  $('.radio input').on('change', function () {
    $('#filter_form').submit();
  });

  /*Calculate price*/
  $('#calculate_btn').on('click', function(){
    var coin_symbol = $('#coin').val();
    var currency_symbol = $('#currency').val();
    var amount = $('#amount').val();
    $.ajax({
      type: 'get',
      url: url+'/calculator/'+coin_symbol+'/'+currency_symbol+'/'+amount,
      success: function(data){
        $('#show_amount').text(amount);
        $('#show_coin').text(coin_symbol);
        $('#show_result').text(data);
        $('#show_currency').text(currency_symbol);
      }

    })
  });


  /* delete user alert*/
  $('.delete_alert_p').on('click', function() {
    var id = $(this).val();
    $('#delete-alert-modal').modal('show');
    $('.btn-delete-alert').val(id);
  });

  $('.btn-delete-alert').on('click', function(){
    var id = $(this).val();
    $.ajax({
      type: 'get',
      url: url+'/profile/delete/alert/'+id,
      success: function(data){
        if(data == 'success'){
          $('#delete-alert-modal').modal('hide');
          $('.pro-table  tr#'+id+'').hide();
          $('.delete-alert').show();
        }
      }

    })
  });

  /*delete user review*/
  $('.delete_review_p').on('click', function() {
    var id = $(this).val();
    $('#delete-review-modal').modal('show');
    $('.btn-delete-review').val(id);
  });

  $('.btn-delete-review').on('click', function(){
    var id = $(this).val();
    $.ajax({
      type: 'get',
      url: url+'/profile/delete/review/'+id,
      success: function(data){
        if(data == 'success'){
          $('#delete-review-modal').modal('hide');
          $('.pro-table tr#'+id+'').hide();
          $('.delete-alert').show();
        }
      }
    })
  });

  $('.select2').select2();
});
