



  function click_show(e,row) {
             
    e.preventDefault();
    var id =row

    var url =APP_URL+'/show_dossier/' + row ;

    window.open(url,'_blank');




}



$(document).ready(function() {



     
  var button_show   = '  <svg width="26px" height="26px" viewBox="0 0 32 32" id="icon" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;}</style></defs><title>folder--details</title><rect x="16" y="20" width="14" height="2"/><rect x="16" y="24" width="14" height="2"/><rect x="16" y="28" width="7" height="2"/><path d="M14,26H4V6h7.17l3.42,3.41.58.59H28v8h2V10a2,2,0,0,0-2-2H16L12.59,4.59A2,2,0,0,0,11.17,4H4A2,2,0,0,0,2,6V26a2,2,0,0,0,2,2H14Z"/><rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="32" height="32"/></svg>';



        table = $('#organigramme_table').DataTable( {
          paging: true,
          order: [[0, 'desc']],

               "bInfo": false,
              "lengthChange": false,
              
      
      
              "paginate": {
                  "first": "PremiÃ¨re",
                  "last": "DerniÃ¨re",
                  "next": "Suivante",
                  "previous": "PrÃ©cÃ©dente"
              },
              "oLanguage": {
                "sUrl": APP_URL+"/assets/fr-FR.json"
              },
        
          columnDefs: [
            { targets: 0, width: '120px' },    
            { targets: 1, width: '130px' },
            { targets: 2, width: '300px' },
            { targets: 3, width: '130px' },
            ],
          fixedColumns: true,
          "searching": false,
 
          
          "columns": [
            
                    { "data": "date"  },
                    { "data": "filename"  },
                    { "data": "content"  },
                   
                    { "data": "id"  , render: function(data, type, row) {
                                 return '<button class="btn btn-warning" style="padding: 3px 5px;" type="button"  onclick="click_show(event,' + data + ' )"  >'+button_show+'</button>' } 
                              }

              
            ]
        } );


       

        

        $('.btn_empty').click(function(e) {

          e.preventDefault();

          

          table
          .clear()
          .draw();

         


       

          $(".btn_empty").addClass("d_none");
          $(".input_champs").val('') ;


        } );

        $('#search_form').on('submit', function(event){

          event.preventDefault();

  

      


            if ($(".input_champs").val() != '' ) {
              
            
            

              $.ajax({
                url:APP_URL+"/api_search_ocr",
                method:"POST",
                data:$(this).serialize(),
                success:function(data){

              

                table.destroy();
          
                table
                .clear()
                .draw();

                
                table = $('#organigramme_table').DataTable( {
                  paging: true,
        
                      "bInfo": false,
                      "lengthChange": false,
                      
              
              
                      "paginate": {
                          "first": "PremiÃ¨re",
                          "last": "DerniÃ¨re",
                          "next": "Suivante",
                          "previous": "PrÃ©cÃ©dente"
                      },
                      "oLanguage": {
                        "sUrl": APP_URL+"/assets/fr-FR.json"
                      },
                  columnDefs: [
                    { targets: 0, width: '120px' },    
                    { targets: 1, width: '130px' },
                    { targets: 2, width: '300px' },
                    { targets: 3, width: '130px' },
                    ],
                  fixedColumns: true,
                  "searching": false,
                  "aaData": data,
                  
                  "columns": [
                    
                            { "data": "date"  },
                            { "data": "filename"  },
                            { "data": "content"  },
                          
                            { "data": "id_dossier"  , render: function(data, type, row) {
                                        return '<button class="btn btn-warning" style="padding: 3px 5px;" type="button"  onclick="click_show(event,' + data + ' )"  >'+button_show+'</button>' } 
                                      }
        
                      
                    ]
                } );
        
                


                }
              })

                 $(".btn_empty").removeClass("d_none");
             }
          

 
              
        });


        

  

 } );