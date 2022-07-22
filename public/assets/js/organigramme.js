var check_parent = 'false';

 var all_dossiers = [];
 
 var type_btn = 'btn_dossier';


 function removeRow_table_champs_add(e,row) {

  e.preventDefault();

  document.getElementById("row_table_champs_add_" + row).remove();

}


function unset_table() {

        $('.table_champs_add tr:not(:nth-child(-n+1))').remove();
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
              console.log('check :'.check_parent)
         

          }else{
          
            check_parent = 'false';

          }
          
          if(type_btn == 'btn_sous_dossier' &&	 check_parent == 'true'  ){
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

      $('.btn-toggle').click(function(e) {
        e.preventDefault();
        $(this).find('.btn').toggleClass('active');  
        
        if ($(this).find('.btn-primary').length>0) {
          $(this).find('.btn').toggleClass('btn-primary');
        }
        if ($(this).find('.btn-danger').length>0) {
          $(this).find('.btn').toggleClass('btn-danger');
        }
        if ($(this).find('.btn-success').length>0) {
          $(this).find('.btn').toggleClass('btn-success');
        }
        if ($(this).find('.btn-info').length>0) {
          $(this).find('.btn').toggleClass('btn-info');
        }
        
   
              
        });


        $('.btn_add_attributs_click').click(function(e) {

           e.preventDefault();
           $(".block_attributs").removeClass("hidden");

  
               
         });



        $('.btn_dossier').click(function(e) {
 
           e.preventDefault();
            type_btn = "btn_dossier" ;
           $(".btn_add_attributs_click").addClass("hidden");
        
           $('#type_dossier').val(type_btn);
       

         

           fill_treeview();

   
                
          });


          $('.btn_sous_dossier').click(function(e) {

            e.preventDefault();
            type_btn = 'btn_sous_dossier';

       

            if(type_btn == 'btn_sous_dossier' && check_parent == 'true'  ){
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

                $(".table_champs_add tbody tr:last").after(add_row);
            }
            if (tableLength == 0) {

                $(".table_champs_add tbody ").append(add_row);
            }
            tableLength++;



       });






        


      

            $('#treeview_form').on('submit', function(event){
              event.preventDefault();
                $.ajax({
                 url:"/store_dossier",
                 method:"POST",
                 data:$(this).serialize(),
                 success:function(data){

                  console.log(data.check_sub_dossier)

                  if(!data.check_sub_dossier){
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

                  }else{
                     alert('interdit d ajouter sous dossier dans ce racine');
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


