
var count = 2;
var all_index = [];



function loadFile(event,id_file){
  event.preventDefault();


  
  var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src+'#toolbar=1') // free memory
      console.log(output.src+'#toolbar=0&navpanes=0&scrollbar=0')
    }
  var form_data = new FormData();
  form_data.append("data", event.target.files[0]);
  var link_file ;
  $.ajax({
      'async': false,
      url: APP_URL+'/uploud_pdf_temp', // router
      method:"POST",
      data: form_data,
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,
  
      success:function(data) {
        link_file = data
        
      }
    });
    var result = link_file.substring(14);
    var full_link= APP_URL+'/public/storage/file_pdf_temp/'+result;
    var array = [];


      var indexe_file = {}

     


        $.each(all_index, function (){
          var  name = this.name_index
          if(this.file_id==id_file){

            var data1 = { [name] : this.attribut_id };
            indexe_file =  Object.assign(indexe_file,data1);

          }
      
        
        })

        var data = {'link_of_pdf' : full_link };

 
        indexe_file =  Object.assign(indexe_file,data);


        
       
       var array_response = {}

       
   

      $.ajax({
        'async': false,
        url: 'http://192.168.2.51:5000/api_pdf',
        contentType: "application/json",
        data: JSON.stringify(indexe_file),
       
        type: 'POST',
    
        success: function(response){

         
              
                array_response = response.reduce(function(result, current) {
                      return Object.assign(result, current);
                    }, {});

                for (let x in indexe_file) {
                  index_pdf  = x;
                  for (let i in array_response) {
                      if(index_pdf == i ){
                        $("#field_"+indexe_file[x]).val(array_response[i]);
                      }
                  }
                }

                $("#file_"+id_file).val(array_response['contenu']);
                
             
                
            },
            error: function(error){
                console.log(error);
        },
      
       });


       $.ajax({
        'async': false,
        url: APP_URL+'/remove_temp_file', // router
        method:"POST",
        data: {link_file : result },
        dataType: "json",
    
        success:function(data) {
        
          
        }
      });


      


}


function fonction_checkbox(){
  if (document.getElementById('version_physique_btn').checked) 
  {
    
      $('#VERSION_PHYSIQUE').val('OUI');
  } else 
  {
    $('#VERSION_PHYSIQUE').val('NON');
  }
}


function add_row_select(row){

  var next = row +1 ;

  var coordonnees  = ['salle', 'rayonnage','conteneur','boite'];

  var id_select =    $('#sous_select_'+row+' option:selected').val();


         if( id_select == '' ){

          var count_p = count;
          for (let i = next; i < count_p+1; i++) {
            $("#row_"+i).remove();
            count = count -1;
          }
          count++;

          $("#attribut_champ").empty();
          $("#attribut_file").empty();

         }

       $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        'async': false,
        url: APP_URL+"/fill_sous_dossier1",
        method:"get",
        data:{
          id_dossier : id_select
        },
        dataType: "json",
        success: function(data) {

           
      
          if ($.trim(data.dossier_champs)){   
            console.log('data.dossier_champs :'+data.dossier_champs);

            if( !$("#row_"+next).length ){    
              
              
      
           
              row_select = '<div id="row_'+count+'" class="col-md-12">';
              row_select += '<div class="form-group row">';
              row_select += ' <label for="colFormLabelSm" id="" class="col-sm-4 col-form-label col-form-label-sm sous_label_'+count+' text-uppercase" >________ :</label>';
              row_select += ' <input class="nom_champs_select_'+count+'" type="text" name="nom_champs_select[]" value="text" hidden> <div class="col-sm-8">';
              row_select += ' <select class="form-select" id="sous_select_'+count+'" name="value_select[]" onchange="add_row_select('+count+')" >';
              row_select += '<option value="">Selectionne le dossier</option>';
              $.each(data.dossier_champs, function (){
                row_select += '<option value="'+this.id+'">'+this.nom_champs+'</option>';
              });
              row_select += '</select>';
              row_select += '</div></div>';
              row_select += '</div>';
      
        
              $("#row_"+row).after(row_select);
    
              $(".sous_label_"+next).html(data.dossier_champs_label+" :");

              $(".nom_champs_select_"+next).val(data.dossier_champs_label);


              $(".sous_label_"+next).html(data.dossier_champs_label+" :");
    
              count++;

            }else {

          

              $("#sous_select_"+next).find('option').not(':first').remove();

              $.each(data.dossier_champs, function (){
                $("#sous_select_"+next).append($("<option   />").val(this.id).text(this.nom_champs));
               });
               var tt= next+1;
               $("#sous_select_"+tt).find('option').not(':first').remove();
               $(".sous_label_"+next).html(data.dossier_champs_label+" :");
            
            }
          } else {
            var count_pre = count;
            for (let i = next; i < count_pre+1; i++) {
              $("#row_"+i).remove();
              count = count -1;
            }
            count++;



          }


          if ($.trim(data.attribut_champ)){   

            $("#attribut_champ").empty();

          

             all_index =data.all_index;

            $.each(data.attribut_champ, function (){
              if(this.type_champs == "Text"){
                row_select1 = '<div id="" class="col-md-12">';
                row_select1 += '<div class="form-group row">';
                row_select1 += ' <label for="colFormLabelSm" class=" text-uppercase col-sm-4 col-form-label col-form-label-sm">'+this.nom_champs+' :</label>';
                row_select1 += '<input type="text" name="nom_champ[]"  value="'+this.nom_champs+' " class="d-none"> ';
                row_select1 += '<input type="text" name="type_champ[]" value="text" class="d-none"> <div class="col-sm-8">';
                row_select1 += ' <input class="form-control" type="text" id="field_'+this.id+'" name="valeur[]" required>';
            
              
                row_select1 += '</div></div>';
                row_select1 += '</div>';
               
              

                $("#attribut_champ").append(row_select1);
              }
              if(this.type_champs == "date"){
                row_select1 = '<div id="" class="col-md-12">';
                row_select1 += '<div class="form-group row">';
                row_select1 += ' <label for="colFormLabelSm" class=" text-uppercase col-sm-4 col-form-label col-form-label-sm">'+this.nom_champs+' :</label>';
                row_select1 += '<input type="text" name="nom_champ[]" value="'+this.nom_champs+' " class="d-none"> ';
                row_select1 += '<input type="text" name="type_champ[]" value="date" class="d-none"> <div class="col-sm-8">';
                row_select1 += ' <input class="form-control" type="date" name="valeur[]" required>';
            
                row_select1 += '';
                row_select1 += '</div>';
                row_select1 += '</div>';

                $("#attribut_champ").append(row_select1);
              }
              if(this.type_champs == "Fichier"){
                row_select1 = '<div id="" class="col-md-12">';
                row_select1 += '<div class="form-group row">';
                row_select1 += ' <label for="colFormLabelSm" class=" text-uppercase col-sm-4 col-form-label col-form-label-sm">'+this.nom_champs+' :</label>';
                row_select1 += '<input type="text" name="nom_champ_file[]" value="'+this.nom_champs+' " class="d-none"> ';
                row_select1 += '<div class="col-sm-8">';
                row_select1 += ' <input required class="form-control controle_file" type="file" name="file[]" placeholder="Choose file" id="file" onchange="loadFile(event,'+this.id+');"> ';

                row_select1 += '<input type="d-none" class="d-none" id="file_'+this.id+'" name="file_text[]" value="" >';
               
                row_select1 += '</div></div>';
                row_select1 += '</div>';

                $("#attribut_file").append(row_select1);
                $("#attribut_file").addClass("attribut_file");
              }


             
            

             
     

            });


            for (let index = 0; index < coordonnees.length; index++) {
              var nom_champs = coordonnees[index];
  
              row_select1 = '<div id="" class="col-md-12">';
              row_select1 += '<div class="form-group row">';
              row_select1 += ' <label for="colFormLabelSm" class=" text-uppercase col-sm-4 col-form-label col-form-label-sm">'+nom_champs+' :</label>';
              row_select1 += '<input type="text" name="nom_champ[]"  value="'+nom_champs+' " class="d-none"> ';
              row_select1 += '<input type="text" name="type_champ[]" value="text" class="d-none"> <div class="col-sm-8">';
              row_select1 += ' <input class="form-control" type="text" name="valeur[]" required>';
          
            
              row_select1 += '</div></div>';
              row_select1 += '</div>';
  
              $("#attribut_champ").append(row_select1);
              
            }

            var vesrion= " dispose d&#039;une version physique";

            row_select1 = '<div id="" class="col-md-12">';
            row_select1 += '<div class="form-group row">';
            row_select1 += " <label for='colFormLabelSm' class=' text-uppercase col-sm-4 col-form-label col-form-label-sm'>dispose d'une version physique :</label>";
            row_select1 += "<input type='text' name='nom_champ[]'  value='"+vesrion+"' class='d-none'> ";
            row_select1 += '<input type="text" name="type_champ[]" value="text" class="d-none" required> <div class="col-sm-8">';

        
            row_select1 += '<div class="form-check form-switch">';
            row_select1 += ' <input class="form-check-input"  type="checkbox" id="version_physique_btn" onclick="fonction_checkbox()" >';
            row_select1 += '<input type="text" id="VERSION_PHYSIQUE" class="d-none" name="valeur[]" value="NON" >';
            row_select1 += '</div>';

            row_select1 += '</div></div>';
            row_select1 += '</div>';

            $("#attribut_champ").append(row_select1);

         

     
    

           } else {
            $("#attribut_champ").empty();
            $("#attribut_file").empty();
            $("#objet").empty();
            $("#attribut_file").removeClass("attribut_file");
           }
       


           
    




        
        }
      })

    
}
 
 
 function fill_parent_dossier(){

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: APP_URL+"/fill_parent_dossier",
      method:"get",
      dataType: "json",
      success: function(data) {
       $.each(data, function (){
        
          $("#parent_select").append($("<option     />").val(this.id).text(this.nom_champs));
         });
      
      
      }
    })

}


$(document).ready(function() {





  
  $(document).ajaxStart(function(){
    $("#ajax_call").show();
  });

  $(document).ajaxStop(function(){
    $("#ajax_call").hide();
  });



  $("#ajax_call").hide();

  

  

  $(".btn1").click(function(){
    $("#ajax_call").hide();
  });
  $(".btn2").click(function(){
    $("#ajax_call").show();
  });


  
  fill_parent_dossier()


  $('#parent_select').on('change', function() {
    var id_select =    $('#parent_select option:selected').val();

    if( id_select == '' ){

      var count_p = count;

    


      var next = 2 ;
  
      for (let i = next; i < count_p+1; i++) {
        $("#row_"+i).remove();
        count = count -1;
      }
      count++;

      $("#sous_select_1").find('option').not(':first').remove();

      $(".sous_label_1").html('________ :');

      $("#attribut_champ").empty();
      $("#attribut_file").empty();

    }
      

       $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: APP_URL+"/fill_sous_dossier",
        method:"get",
        data:{
          id_dossier : id_select
        },
        dataType: "json",
        success: function(data) {

          

   

          $("#sous_select_1").find('option').not(':first').remove();
          $(".sous_label_1").html(data.dossier_champs_label+" :");
          $(".nom_champs_select_1").val(data.dossier_champs_label);
          $.each(data.dossier_champs, function (){
            $("#sous_select_1").append($("<option   />").val(this.id).text(this.nom_champs));
           });


           $("#attribut_champ").empty();
           $("#attribut_file").empty();
           $("#objet").empty();
           $("#attribut_file").removeClass("attribut_file");


           var count_pre = count;
          for (let i = 2; i < count_pre+1; i++) {
            $("#row_"+i).remove();
            count = count -1;
          }
          count++;



     
  
        
        
        }
      })

  });





 


  
  $('#sous_select').on('change', function() {

      



  });


        $('.btn_add_attributs_click').click(function(e) {

           e.preventDefault();
           $(".block_attributs").removeClass("d-none");

  
               
         });


         $('.printclass').click(function(e) {

          e.preventDefault();
       
          
          var restorepage = $('body').html();
          var printcontent = $('#id_table_print').clone();
          $('body').empty().html(printcontent);
          window.print();
          $('body').html(restorepage);

          var text = 'Impression du Dossier'
          var id_dossier =  $('#id_dossier').val();

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            url: APP_URL+"/historique_dossier",
            method:"post",
            data: {
              text : text,
              id_dossier : id_dossier
            },
            success: function(data) {
             $.each(data, function (){
              
                $("#parent_select").append($("<option     />").val(this.id).text(this.nom_champs));
               });
            
            
            }
          })


          


  
              
         });


        


        
       

         

         


         $('.controle_file').on("change", function(){ 
          alert(); 
        });



        


      

            $('#treeview_form').on('submit', function(event){
            
             });

        









});


