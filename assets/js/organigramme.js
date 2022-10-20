var check_parent = 'false';

 var all_dossiers = [];
 
 var type_btn = 'btn_dossier';

 function editRow_organi(e,row) {


  
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: APP_URL+"/fill_table_edit_attributs",
    method:"POST",
    data:{
      champs_id : row,
    },
    success: function(data) {


      $("#Modal_table_champs_add tbody tr:not(:first)").remove();
      $("#Modal_table_link_index tbody tr:not(:first)").remove();
      $(".title_dossier").html(data.nom_dossier);
      $(".id_dossier").val(data.id_dossier);
      for (let i = 0; i < data.attributs.length; i++) {

        var add_row = '<tr id=model_row_table_champs_add_' + [i] + '  >';
        add_row += '<td><input name="old_id_champ[]" class="hidden" type="text" value="'+data.attributs[i].id+'" ><input name="old_name_champ[]" class="form-control" type="text" value="'+data.attributs[i].nom_champs+'"   required></td>';
        add_row += '<td>  <select name ="old_type_champ[]" class="form-control" id="" required> ';
        add_row += '  <option>sélectionner le type</option>';
        add_row += ' <option value="date"   ';
        if(data.attributs[i].type_champs == 'date'){
          add_row += 'selected';
        }
        add_row += '>Date </option> ';
        add_row += ' <option value="Text" ';
        if(data.attributs[i].type_champs == 'Text'){
          add_row += 'selected';
        }
        add_row += ' >Text</option> ';
        add_row += ' <option value="Fichier"';
        if(data.attributs[i].type_champs == 'Fichier'){
          add_row += 'selected';
        }
        add_row += '>fichier</option>';
        add_row += '   </select></td>';
        add_row += '<td>  <div class="block_action_organigramme"> ';
        add_row += '<a href="" onClick="model_removeRow_table_champs_add(event,' + [i] + ','+data.attributs[i].id+')" ><i class="fa-solid fa-circle-xmark "></i></a>';
        add_row += '      </div> </td></tr>';
        $("#Modal_table_champs_add tbody tr:last").after(add_row);

      }



      for (let i = 0; i < data.all_index.length; i++) {

        var add_row = '<tr id=model_row_table_all_index_' + [i] + '  >';
        add_row += '<td><input name="old_id_index[]" class="hidden" type="text" value="'+data.all_index[i].id+'" ><input name="old_name_index[]" class="form-control" type="text" value="'+data.all_index[i].name_index+'"   required></td>';
        add_row += '<td>  <select name ="old_type_champ_index[]" class="form-control" id="" required> ';
        add_row += '  <option>sélectionner le type</option>';
        for (let t = 0; t < data.attributs.length; t++) {
          if(data.attributs[t].type_champs == "Text" || data.attributs[t].type_champs == "Date" ){
            add_row += ' <option value=" '+data.attributs[t].id+' "';
              if(data.attributs[t].id == data.all_index[i].attribut_id ){
                add_row += 'selected';
              }
            add_row += '>'+data.attributs[t].nom_champs+'</option>';
            }
        }
        add_row += '   </select></td>';
        add_row += '<td>  <select name ="old_type_fichier[]" class="form-control" id="" required> ';
        add_row += '  <option>sélectionner le type</option>';
        for (let t = 0; t < data.attributs.length; t++) {
          if(data.attributs[t].type_champs == "Fichier" ){
            add_row += ' <option value=" '+data.attributs[t].id+' "';
              if(data.attributs[t].id == data.all_index[i].file_id ){
                add_row += 'selected';
              }
            add_row += '>'+data.attributs[t].nom_champs+'</option>';
            }
        }
        add_row += '   </select></td>';
        
        add_row += '<td>  <div class="block_action_organigramme"> ';
        add_row += '<a href="" onClick="model_removeRow_table_index(event,' + [i] + ','+data.all_index[i].id+')" ><i class="fa-solid fa-circle-xmark "></i></a>';
        add_row += '      </div> </td></tr>';
        $("#Modal_table_link_index tbody tr:last").after(add_row);

      }

     


    }
  })






  


 
        


}


 function removeRow_table_champs_add(e,row) {

  e.preventDefault();

  document.getElementById("row_table_champs_add_" + row).remove();






}


function model_removeRow_table_champs_add(e,row,id=null) {

  e.preventDefault();

  if (confirm("Vous voulez vraiment supprimer ce attribut !") == true) {
      document.getElementById("model_row_table_champs_add_" + row).remove();

      if(id !=null){
      
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
          }
        });
      
        $.ajax({
          url: APP_URL+"/remove_champs_attributs",
          method:"POST",
          data:{
            id_champs_attributs : id,
          },
          success: function(data) {
      
            fill_treeview()
      
          }
        })
      
      }
  } else {

  }

 
 



}


function model_removeRow_table_index(e,row,id=null) {

  e.preventDefault();

  if (confirm("Vous voulez vraiment supprimer ce indexe !") == true) {
      document.getElementById("model_row_table_all_index_" + row).remove();

      if(id !=null){
      
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
          }
        });
      
        $.ajax({
          url: APP_URL+"/remove_row_indexe",
          method:"POST",
          data:{
            id_indexe : id,
          },
          success: function(data) {
      
            fill_treeview()
      
          }
        })
      
      }
  } else {

  }

 
 



}

function unset_table() {

        $('#add_table_champs_add tr:not(:nth-child(-n+1))').remove();
        $(".block_attributs").addClass("hidden");

  }




 function fill_treeview() {





  check_have_parent();

  var  entite =  $('#select_entite').val() 

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: APP_URL+"/fill_drop_down",
    method:"POST",
    data:{
      organigramme_id : id_organigramme,
      type_btn : type_btn,
      entite : entite,
    },
    success: function(data) {
    

       $('#select_block').html(data)
       $('#select_tree').treeselect();

    }
  })

  $.ajax({
      url: APP_URL+"/array_organigramme",
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


function check_have_parent(){
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
          }
        });
      $.ajax({
        url: APP_URL+"/check_have_parent",
        method:"POST",
        data:{
          organigramme_id : id_organigramme
        },
        dataType: "json",
        success: function(data) {
        
          if(data.etat){

              check_parent = 'true';
          
         

          }else{
          
            check_parent = 'false';

          }
          
          if(type_btn == 'btn_sous_dossier' &&	 check_parent == 'true' || type_btn == 'btn_piece_joint' &&	 check_parent == 'true'  ){
            $('.btn_add_attributs_click').removeClass("hidden");
          } else {
                    $(".btn_add_attributs_click").addClass("hidden");
          }
        }
    })
}


$(document).ready(function() {

  

        var id_get = 1;

        var tableLength = 1;
        var count = 1;

      

      fill_treeview();




        $('.btn_add_attributs_click').click(function(e) {

           e.preventDefault();
           $(".block_attributs").removeClass("hidden");

  
               
         });



        $('.btn_dossier').click(function(e) {
 
           e.preventDefault();
            type_btn = "btn_dossier" ;
           $(".btn_add_attributs_click").addClass("hidden");


           $("#btn_group_oganigramme .btn").removeClass("btn-primary");
           $(".btn_dossier").addClass("btn-primary");
        
           $('#type_dossier').val(type_btn);
       

         

           fill_treeview();

   
                
          });


          $('.btn_sous_dossier').click(function(e) {

            e.preventDefault();

            type_btn = 'btn_sous_dossier';


            $("#btn_group_oganigramme .btn").removeClass("btn-primary");
            $(".btn_sous_dossier").addClass("btn-primary");


            if(type_btn == 'btn_sous_dossier' && check_parent == 'true'  ){
              $('.btn_add_attributs_click').removeClass("hidden");
            } 

            $('#type_dossier').val(type_btn);

            fill_treeview()

                 
           });

           $('.btn_piece_joint').click(function(e) {

            e.preventDefault();
            type_btn = 'btn_piece_joint';

            

           $("#btn_group_oganigramme .btn").removeClass("btn-primary");
           $(".btn_piece_joint").addClass("btn-primary");

       

            if( type_btn == 'btn_piece_joint' && check_parent == 'true'  ){
              $('.btn_add_attributs_click').removeClass("hidden");
            } 



               $('#type_dossier').val(type_btn);

               fill_treeview()

                 
           });



           $("#select_entite").change(function(){
               fill_treeview()
          });
  
      


      $('.btn_add_oranigramme').on('click', function(event){
        event.preventDefault();
       

            count++;


        
            var add_row = '<tr id=row_table_champs_add_' + count + '  >';

      


            add_row += '<td><input name="name_champ[]" class="form-control" type="text"   required></td>';

      
          

            add_row += '<td>  <select name ="type_champ[]" class="form-control" id="" required> ';
            add_row += '  <option>sélectionner le type</option><option value="date">Date</option> <option value="Text">Text</option> <option value="Fichier">fichier</option>';
            add_row += '   </select></td>';
            add_row += '<td>  <div class="block_action_organigramme"> ';
            add_row += '<a href="" onClick="removeRow_table_champs_add(event,' + count + ')" ><i class="fa-solid fa-circle-xmark "></i></a>';
            add_row += '      </div> </td></tr>';
          
                



            if (tableLength > 0) {

                $("#add_table_champs_add tbody tr:last").after(add_row);
            }
            if (tableLength == 0) {

                $("#add_table_champs_add tbody ").append(add_row);
            }
            tableLength++;



       });

       $('.btn_add_entitre').on('click', function(event){
        event.preventDefault();
      });

      $('.btn_creer_entite').on('click', function(event){
        event.preventDefault();

        var entite =  $('#nom_entite').val();
        var id_organigramme =  $('#id_organigramme').val();

        $.ajax({
          url:APP_URL+"/creer_entite",
          method:"POST",
          data:{
            'nom' : entite,
            'id_organigramme' : id_organigramme,
          },
          success:function(data){

            if(data.status){


              
                $("#select_entite").append($("<option   />").val(data.entite.id).text(data.entite.nom));
            

              $('#panel_entite .btn_fermer_attributs').click();

            }
    
          }
         })
      });




      $('.btn_delete_entite').on('click', function(event){
        event.preventDefault();

        var id_entite =  $('#select_entite').val();

        $.ajax({
          url:APP_URL+"/remove_entite",
          method:"POST",
          data:{
            'id_entite' : id_entite,
          },
          success:function(data){

            if(data.etat){


              $('#select_entite').find('option:selected').remove();


                alert('supprimer avec Succès')

            }
    
          }
         })

      });


       $('.modal_btn_add_oranigramme').on('click', function(event){
        event.preventDefault();
        var rowCount_v = $('#Modal_table_champs_add tr').length;
         rowCount = rowCount_v - 1;
    


        
            var add_row = '<tr id=model_row_table_champs_add_' + rowCount + '  >';

      


            add_row += '<td><input name="new_name_champ[]" class="form-control" type="text"   required></td>';

      
          

            add_row += '<td>  <select name ="new_type_champ[]" class="form-control" id="" required> ';
            add_row += '  <option>sélectionner le type</option><option value="date">Date</option> <option value="Text">Text</option> <option value="Fichier">fichier</option>';
            add_row += '   </select></td>';
            add_row += '<td>  <div class="block_action_organigramme"> ';
            add_row += '<a href="" onClick="model_removeRow_table_champs_add(event,' + rowCount + ')" ><i class="fa-solid fa-circle-xmark "></i></a>';
            add_row += '      </div> </td></tr>';
          
                




                $("#Modal_table_champs_add tbody tr:last").after(add_row);
          
      



       });


       $('.modal_btn_add_index').on('click', function(event){
        event.preventDefault();

        var rowCount_v = $('#Modal_table_link_index  tr').length;
        rowCount = rowCount_v - 1;
        
        $.ajax({
          url:APP_URL+"/api_champs_index",
          method:"POST",
          data:{ id :   $('.id_dossier').val()  },
          success:function(data){
         
            var add_row = '<tr id=model_row_table_champs_add_' + rowCount + '  >';

      


            add_row += '<td><input name="new_name_index[]" class="form-control" type="text"   required></td>';

      
          

            add_row += '<td>  <select name ="new_type_champ[]" class="form-control" id="" required> ';

            add_row += '  <option>sélectionner le type</option>';
            for (let i = 0; i < data.length; i++) {
              if(data[i].type_champs == "Text" || data[i].type_champs == "Date"  ){
            add_row += '  <option value=" '+data[i].id+' ">'+data[i].nom_champs+'</option>';
              }

            }
            
            add_row += '   </select></td>';
            add_row += '<td>  <select name ="new_file_champ[]" class="form-control" id="" required> ';
            add_row += '  <option>sélectionner le type</option>';
            for (let i = 0; i < data.length; i++) {
              if( data[i].type_champs == "Fichier"  ){
            add_row += '  <option value=" '+data[i].id+' ">'+data[i].nom_champs+'</option>';
              }

            }
            add_row += '   </select></td>';
            add_row += '<td>  <div class="block_action_organigramme"> ';
            add_row += '<a href="" onClick="model_removeRow_table_index(event,' + rowCount + ')" ><i class="fa-solid fa-circle-xmark "></i></a>';
            add_row += '      </div> </td></tr>';
          
                




                $("#Modal_table_link_index  tbody tr:last").after(add_row);

    
          }
         })
       
    


        
           
          
      



       });




      

            $('#treeview_form').on('submit', function(event){
              event.preventDefault();
                $.ajax({
                 url:APP_URL+"/store_dossier",
                 method:"POST",
                 data:$(this).serialize(),
                 success:function(data){
                  console.log(data)

                  console.log(data.piece_have_att)

                  if(!data.piece_have_att){

                      if(!data.check_sub_dossier){

                        if(data.type_dossier == 'btn_piece_joint' && data.piece_joint == true ){

                          alert("ce n'est pas une piece joint");

                        }else{

                        if(data.etat){
                        
                          fill_treeview();
                      
                          $('#treeview_form')[0].reset();
                          alert('ajouter aves succes');

                          $('#type_dossier').val(data.type_dossier);
      
                            $([document.documentElement, document.body]).animate({
                              scrollTop: $(".tree").offset().top
                          }, 2000);
      
                          unset_table()
                        }

                        }


              

                      }else{
                          alert('il ne respect pas la forme d une pièce ');
                      }


                  } else{


                       alert('interdit d ajouter la pièce  dans ce racine');

                  }

       
                  
           
                 }
                })
             });

             $('#form_modal').on('submit', function(event){
              event.preventDefault();
                $.ajax({
                 url:APP_URL+"/update_attributs",
                 method:"POST",
                 data:$(this).serialize(),
                 success:function(data){

             

                  if(data.etat){

             

                    $('#form_modal .btn_fermer_attributs').click();

                     fill_treeview()


                  }

   
                  
           
                 }
                })
             });









});




function removeRow(e,row) {


  e.preventDefault();

  
  array_id =[];







                        const
              getChildren = id => (relations[id] || []).flatMap(o => [o, ...getChildren(o.id)]),
            
              relations = all_dossiers.reduce((r, o) => {
                  (r[o.parent_id] ??= []).push(o);
                  return r;
              }, {});

              array_child= getChildren(row)

              for (var i = 0; i < array_child.length; i++) {       
                array_id.push( array_child[i].id)
                }
                array_id.push(row)
             



                $.ajax({
                  url: APP_URL+"/delete_dossier",
                  method:"POST",
                  data:{
                    items_delete : array_id
                  },
                  success:function(data){

                    if(data.etat){
                        fill_treeview();
                        alert('supprimer avec succes');

                     }
                
            
                  }
                 })




}

