


$(document).ready(function() {

  var count_page =  $('#count_projet').val();
  var count =0;


if(count_page >0){
  count=count_page;
}


console.log(count)

  $('#select_project').select2();

  var cpt =0;
  for (let i = 0; i < count_page; i++) {
         cpt = i+1;
      $('#select_tree'+cpt).select2({
   
      
      });
    
  

  }


  $('#select_project').on("removed", function(e) {
    

    $("#row"+e.val).remove();
    count--;
    
  });
  

  



  

  $('#select_project').on('select2-selecting', function (e) {

    var id_select = e.object.id;
    var text_select = e.object.text;

    console.log(text_select)

      
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "/fill_drop_down_dossier",
        method:"post",
        data:{
          organigramme_id : id_select
        },
        dataType: "json",
        success: function(data) {
          
          var new_count =0;
       
          new_count =parseInt(count)+1;
         

          var row = '<div id="row'+new_count +'" class="row mb-3">'
           row += '<input type="text" value="'+id_select+'" name="organigramme_id[]" hidden><label for="select_tree'+new_count+'" class="col-md-4 col-form-label text-md-end">Les Dossiers a Voir dans  <strong> '+text_select+' </strong>  </label>'
           row += '<div class="col-md-6">'
           row += '<select id="select_tree'+new_count+'"  multiple="multiple" class="form-control"  name="dossiers'+new_count+'[]">'
           row += ''
           row += '</select> </div> </div>'
         
        
      

           $("#row"+count).after(row);
           $('#select_tree'+new_count).select2({
           
            width: "100%"
           });
           $('#select_tree'+new_count).html(data);
           count++;
          
  
        }
      })
   });



  


      



});





