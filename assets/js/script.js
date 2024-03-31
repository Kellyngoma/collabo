const allsideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

 allsideMenu.forEach(item=> {

        const li = item.parentElement;
        item.addEventListener('click', () => {
            allsideMenu.forEach(i=> {
                i.parentElement.classList.remove('active');

            })
            li.classList.add('active'),200;


        })

});

// TOGGLE SIDEBAR 
const menuBar = document.querySelector(' #content nav .bx.bx-menu');
const sideBar = document.getElementById('sidebar');

// menuBar.addEventListener('click', () => {
//     sideBar.classList.toggle('hide');

// })

// if(window.innerWidth < 578){
//     const searchButton = document.querySelector('#content nav form .form-input button');
//     const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
//     const searchForm = document.querySelector('#content nav form ');

// }
//     searchButton.addEventListener('click', (e) => {
//            e.preventDefault(); 
//             searchButtonForm.classList.toggle('show');
//            if(searchButtonForm.classList.contains('show')){
//                 searchButtonIcon.classList.replace('bx-search', 'bx-x');
//            }else{
//              searchButtonIcon.classList.replace( 'bx-x','bx-search');
//            }    
       
//         })

// if(window.innerWidth < 768){
//     sideBar.classList.add('hide');
// }else{
//     if(window.innerWidth > 576);
//         searchButtonIcon.classList.replace( 'bx-x','bx-search');
//         searchButtonForm.classList.remove('show');
// }

// window.addEventListener('resize', () => {
//     if(this.innerWidth > 576){
//         searchButtonIcon.classList.replace( 'bx-x','bx-search');
//         searchButtonForm.classList.remove('show');
//     }      
//  })


new DataTable('#datatable', {
    responsive: true,
    "language": {
        "decimal": "",
        "emptyTable": "Données non disponibles dans le tableau",
        "info": "Voir _START_ à _END_ de _TOTAL_ entrées",
        "infoEmpty": "Aucune entrée disponible",
        "infoFiltered": "(filtered from _MAX_ total entries)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Voir _MENU_ entrées",
        "loadingRecords": "Chargement...",
        "processing": "",
        "search": "Recherche:",
        "zeroRecords": "Aucune entrée correspondante trouvée",
        "paginate": {
            "first": "Premiere",
            "last": "Derniere",
            "next": "Suivant",
            "previous": "Precedent"
        },
        "aria": {
            "sortAscending": ": activate to sort column ascending",
            "sortDescending": ": activate to sort column descending"
        }
    }
});

