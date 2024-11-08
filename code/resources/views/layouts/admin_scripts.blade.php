

<script type="text/javascript">

  toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

  function deleterecord(recordid)
  {
    $("input[value='"+recordid+"']"+'.selectone').prop("checked", true);
    $('#@yield('deletemodalid','deletemodalid')').modal('show') ;
  }

function editrecord(href) 
{
  url = '{!!url("/")!!}';
  $('.editrecordbtn').prop('href',url+href);
}
function geteditrecord(record_id,route) 
{

  if (record_id) 
  {

    $.ajax({
        type: 'get',
        url: route,
        data: { record_id: record_id},
        statusCode: {
             403: function (xhr) {
                $('#isnotallowed').modal('show');   
             }
         },
        success: function(msg)
        { 
            
          $('.@yield("editrecordbtn","editrecordbtn")').attr('data-toggle','modal');
          $('.@yield("editrecordbtn","editrecordbtn")').attr('data-target','#@yield("editrecordmodal","editrecordmodal")');
          $('.@yield("editrecorddata","editrecorddata")').html(msg);
          $('#@yield("editrecordmodal","editrecordmodal")').modal('show') ;    
        },
        error: function (xhr, desc, err) {             

          $('#script_error').modal('show')
          
         }
    });
  }else{
    $('#isnotallowed').modal('show');   
  }
}
 
function errors(jqXHR,empty_container=true,modal_error=false) {
  $('.default_error').hide();
  errormsg = '';
  if (jqXHR.responseJSON.error) {
    errormsg = jqXHR.responseJSON.error + '<br>' +' ' ;
  }
  if (jqXHR.responseJSON.message) {
    errormsg = errormsg +  jqXHR.responseJSON.message;
  }
  if (modal_error) {

    $('#script_error').modal('show')
  }else
  {

    toastr.error(errormsg, 'Error');
  }
    $('.custom_error').html(errormsg).show();
            
  if (empty_container) {

    $('.content_container').html();
  }
}

jQuery(function($)
{

    $(document).on('click','.selectone',function () {
       
       if($('.selectone:checkbox:checked').length==1)
        {
            recordid = $('.selectone:checkbox:checked').val();
            $('.editrecordbtn').removeAttr('disabled');  
            $('.editrecordbtn').attr('data-recordid',recordid);  
        }else{
            
          $('.editrecordbtn').attr('disabled',true);  
          $('.editrecordbtn').attr('data-recordid',0);  
        }


    });

    $(document).on('click','.selectall',function() 
    {
        $('.editrecordbtn').attr('disabled',true);  
        $('.editrecordbtn').attr('data-recordid',0);  
    });

    $(document).on('click','.selectone',function () {
       
       if($(this).is(":checked"))
        {
            $('.deletebtn').removeAttr('disabled');
        }else{

            if($('.selectone:checkbox:checked').length==0)
            {
              $('.deletebtn').attr('disabled',true);  
            }
        }

    });
    $(document).on('click','.selectall',function() 
    {

        $('.deletebtn').removeAttr('disabled');

        if($(this).is(":checked"))
        {
          
            $('.selectone').each(function () 
            {
                if(!this.checked)
                {
                    this.checked = true
                }
            })
        }else{

           $('.deletebtn').attr('disabled',true);

           $('.selectone').each(function () {
                
                this.checked = false;
            }) 
        }
    });
                         
});

    
    

</script>