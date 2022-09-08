



  function click_show(e,row) {
             
    e.preventDefault();
    var id =row

    var url ='/show_dossier/' + row ;

    window.open(url,'_blank');




}

 


$(document).ready(function() {


       function searchByColumn(table) {
          var defaultSearch = 1 //Name
          $(document).on('change', '#select-column', function() {
            defaultSearch = this.value;
          });
          $(document).on('change', '#search-by-column', function() {
            table.search('').columns().search('').draw();
            table.column(defaultSearch).search(this.value).draw();
          });
        }
     
  var button_show   = '  <svg width="26px" height="26px" viewBox="0 0 32 32" id="icon" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;}</style></defs><title>folder--details</title><rect x="16" y="20" width="14" height="2"/><rect x="16" y="24" width="14" height="2"/><rect x="16" y="28" width="7" height="2"/><path d="M14,26H4V6h7.17l3.42,3.41.58.59H28v8h2V10a2,2,0,0,0-2-2H16L12.59,4.59A2,2,0,0,0,11.17,4H4A2,2,0,0,0,2,6V26a2,2,0,0,0,2,2H14Z"/><rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="32" height="32"/></svg>';


        //    var table = $('#organigramme_table').DataTable({

        //     "aaData": data,
        //     "bInfo": false,
        //     "lengthChange": false,
    
    
        //     "paginate": {
        //         "first": "PremiÃ¨re",
        //         "last": "DerniÃ¨re",
        //         "next": "Suivante",
        //         "previous": "PrÃ©cÃ©dente"
        //     },
        //     "oLanguage": {
        //         "sUrl": "/assets/fr-FR.json"
        //     },
      
        //     "columns": [
             
        //         { "data": "id"  },
        //         { "data": "date"  },
        //         { "data": "titre"  },
        //         { "data": "user"  },
        //         { "data": "id"  , render: function(data, type, row) {
        //             return '<button class="btn btn-warning" style="padding: 3px 5px;" type="button"  onclick="click_show(event,' + data + ' )"  >'+button_show+'</button>' } 
        //         }

                 
        //         ]
    
    
    
    
    
        // });


        // table.destroy();
        var tt= [{ id: 1, date:"Demo Name" , titre:"demo1@gmail.com" , user:"demo1@gmail.com", user1:"demo1@gmail.com"  },{ id: 2, date:"Demo Name" , titre:"demo1@gmail.com" , user:"demo1@gmail.com", user1:"demo1@gmail.com"  }]

        table = $('#organigramme_table').DataTable( {
          "aaData": data,
          paging: false,
          "columns": [
            
                    { "data": "id"  },
                    { "data": "date"  },
                    { "data": "titre"  },
                    { "data": "user"  },
                    { "data": "id"  , render: function(data, type, row) {
                                 return '<button class="btn btn-warning" style="padding: 3px 5px;" type="button"  onclick="click_show(event,' + data + ' )"  >'+button_show+'</button>' } 
                              }

              
            ]
        } );

        table.destroy();


        var tt1 = [{ id: 3, date:"Demo Name" , titre:"demo1@gmail.com" , user:"demo1@gmail.com", user1:"demo1@gmail.com"  }];
        table = $('#organigramme_table').DataTable( {
          "aaData": tt ,
          paging: false,
            "columns": [
              
              { "data": "id"  },
              { "data": "date"  },
              { "data": "titre"  },
              { "data": "user"  },
              { "data": "id"  , render: function(data, type, row) {
                           return '<button class="btn btn-warning" style="padding: 3px 5px;" type="button"  onclick="click_show(event,' + data + ' )"  >'+button_show+'</button>' } 
                        }
            

            
          ]
        } );

  

 } );