        function remove_user(e,row) {


          e.preventDefault();





            $.ajax({
              url:APP_URL+"/user_destroy/"+row,
              method:"POST",
              data:{
                items_delete : row
              },
              success:function(data){

                

                  console.log(data.data)

                if(data.etat){

                  

                      $('#organigramme_table').DataTable().destroy();
                      fill_table()
                      

                
                                          
                  
                      alert('supprimer avec succes');
                    

                }
            

              }
            })




        }



  function click_edit(e,row) {
             
    e.preventDefault();
    var id =row

    location.href=APP_URL+'/showUser/' + row ;






}

  function fill_table(){


    var button_delete = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">';

        button_delete += '<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>';

        button_delete += '<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>';
        button_delete += '</svg>';



    var button_show   = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">';

      button_show += '<path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>';

      button_show  += '</svg>';




    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });

    $.ajax({
        'url': APP_URL+"/all_user",
        'method': "GET",
        'contentType': 'application/json'
    }).done( function(data) {
        $('#organigramme_table').dataTable( {
            "aaData": data,
            "bInfo" : false,
            "lengthChange": false,
            columnDefs: [
                {
                    targets: -1,
                    data: null,
                    defaultContent: '<button>Click!</button>',
                },
            ],
            
            "paginate": {
                "first": "PremiÃ¨re",
                "last": "DerniÃ¨re",
                "next": "Suivante",
                "previous": "PrÃ©cÃ©dente"
            },
            "oLanguage": {
              "sUrl": APP_URL+"/assets/fr-FR.json"
            },
    
            "columns": [
             
                { "data": "nom"  },
                { "data": "prenom"  },
                { "data": "email"  },
                { "data": "identifiant"  },
                { "data": "id"  , render: function(data, type, row) {
                    return '<button type="button" class="btn btn-danger mr-3 " onclick="remove_user(event,' + data + ' )"  >'+button_show+'</button><button type="button" class="btn btn-primary"   onclick="click_edit(event,' + data + ' )" >'+button_delete+'</button>' } 
                }

                 
                ]

		


        })
   
    })

}


$(document).ready(function() {
     
    fill_table();

 } );