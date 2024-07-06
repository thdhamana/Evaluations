
// code pour le bouton de rafrechichement 
document.getElementById('refreshButton').addEventListener('click', function() {
    location.reload();
});


// pour le right menu
// let menu = document.querySelector('.openbtn');
// let close = document.querySelector('.close');
// let nav = document.querySelector('.rightbar');

// menu.addEventListener('click',function(e){
//     nav.setAttribute('style','transform : translateX(0px)');
// });
// close.addEventListener('click', function(e){
//     nav.setAttribute('style','transform: translateX(300px)');
// });

// code pour la recherche
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("searchInput");
    searchInput.addEventListener("input", function() {
        const searchTerm = searchInput.value.toLowerCase();
        const tableBody = document.getElementById("tableBody");
        const rows = tableBody.getElementsByTagName("tr");
        for (let i = 0; i < rows.length; i++) {
            const currentRow = rows[i];
            let found = false;
            for (let j = 0; j < currentRow.getElementsByTagName("td").length; j++) {
                const cell = currentRow.getElementsByTagName("td")[j];
                if (cell) {
                    const cellText = cell.textContent || cell.innerText;
                    if (cellText.toLowerCase().indexOf(searchTerm) > -1) {
                        found = true;
                        break;
                    }
                }
            }
            if (found) {
                currentRow.style.display = "";
            } else {
                currentRow.style.display = "none";
            }
        }
    });
});

// code pour trier
$(document).ready(function(){
// Fonction pour trier les colonnes
    $('th').on('click', function(){
        var table = $(this).closest('table');
        var index = $(this).index();

        // Récupérer les lignes du tableau à l'exception de la première (en-têtes)
        var rows = table.find('tbody > tr').get();

        // Tri des lignes en fonction de la colonne cliquée
        rows.sort(function(a, b) {
            var A = $(a).find('td').eq(index).text().toUpperCase();
            var B = $(b).find('td').eq(index).text().toUpperCase();

            return $.isNumeric(A) && $.isNumeric(B) ? A - B : A.localeCompare(B);
        });

        // Inversion de l'ordre si la colonne est déjà triée
        if ($(this).hasClass('asc')) {
            rows.reverse();
            $(this).removeClass('asc');
        } else {
            $(this).addClass('asc');
        }

        // Remettre les lignes triées dans le tableau
        $.each(rows, function(index, row) {
            table.children('tbody').append(row);
        });
    });
});


