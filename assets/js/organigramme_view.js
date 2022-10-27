



 function fill_treeview() {


  var  entite =  $('#select_entite').val() 

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
  });

 

  $.ajax({
      url: APP_URL+"/array_organigramme_view",
      method:"POST",
      data:{
   
        organigramme_id : id_organigramme
      },
      dataType: "json",
      success: function(data) {
        console.log(data)

        var num = 0;


 

        $(".tree").empty()

        for (let i = 0; i < data.length; i++) {

          num = num+1


          var label_entite = '<nav aria-label="breadcrumb"> <ol class="breadcrumb"> <li class="breadcrumb-item active" aria-current="page">'+data[i].name_entite+'</li> </ol> </nav>';


          $(".tree").append("<li  > "+label_entite+" <div id='treeview_"+num+"'> </div> </li> ");
          
        


              $("#treeview_"+num).treeview({
              data: data[i].dossiers,
              levels: 99,
              

              

            });


            

            


         }


      
      }
  })

  $.ajax({
      url: APP_URL+"/array_organigramme_simple",
      dataType: "json",
      data:{
        organigramme_id : id_organigramme
      },
      success: function(data) {
        all_dossiers =data
      }
  })





}





$(document).ready(function() {



        $('.btn_print').click(function(e) {


         
            

          e.preventDefault(); 
          var restorepage = $('body').html();
          var printcontent = $('.tree').clone();
          $('body').empty().html(printcontent);
          window.print();
          $('body').html(restorepage);


      

          

            
        });


       fill_treeview();


       


});





