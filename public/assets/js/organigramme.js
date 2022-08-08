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
    url: "/fill_table_edit_attributs",
    method:"POST",
    data:{
      champs_id : row,
    },
    success: function(data) {


      $("#Modal_table_champs_add tbody tr:not(:first)").remove();
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
          url: "/remove_champs_attributs",
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


function unset_table() {

        $('#add_table_champs_add tr:not(:nth-child(-n+1))').remove();
        $(".block_attributs").addClass("hidden");

  }




 function fill_treeview() {





  check_have_parent();



  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: "/fill_drop_down",
    method:"POST",
    data:{
      organigramme_id : id_organigramme,
      type_btn : type_btn,
    },
    success: function(data) {

       $('#select_block').html(data)
       $('#select_tree').treeselect();

    }
  })

  $.ajax({
      url: "/array_organigramme",
      method:"POST",
      data:{
   
        organigramme_id : id_organigramme
      },
      dataType: "json",
      success: function(data) {
        $('#treeview').treeview({
          data: data,
          

        });
      }
  })

  $.ajax({
      url: "/array_organigramme_simple",
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
        url: "/check_have_parent",
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






        


      

            $('#treeview_form').on('submit', function(event){
              event.preventDefault();
                $.ajax({
                 url:"/store_dossier",
                 method:"POST",
                 data:$(this).serialize(),
                 success:function(data){

              

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
                              scrollTop: $("#treeview").offset().top
                          }, 2000);
      
                          unset_table()
                        }

                       }


              

                  }else{
                     alert('interdit d ajouter sous dossier dans ce racine');
                  }
   
                  
           
                 }
                })
             });

             $('#form_modal').on('submit', function(event){
              event.preventDefault();
                $.ajax({
                 url:"/update_attributs",
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
                  url:"/delete_dossier",
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

