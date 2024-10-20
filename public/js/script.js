// Botón para ver todos los personajes
document.getElementById('showAll').addEventListener('click', function() {
    window.location.href = "{{ route('characters') }}";
});

// Autocompletado para el campo de búsqueda
$('#searchInput').on('keyup', function() {
    let query = $(this).val();

    if (query.length > 0) {
        $.ajax({
            url: "{{ route('autocomplete') }}", // Ruta para la búsqueda de autocompletado
            type: "GET",
            data: { name: query },
            success: function(data) {
                $('#suggestions').remove(); // Limpiar resultados anteriores
                let suggestions = $('<div id="suggestions" class="list-group"></div>');

                // Itera sobre los resultados
                data.forEach(character => {
                    let suggestionItem = $('<a class="list-group-item list-group-item-action"></a>')
                        .text(character.name)
                        .on('click', function() {
                            $('#searchInput').val(character.name); // Rellena el input con el nombre
                            $('#suggestions').remove(); // Oculta las sugerencias
                        });

                    suggestions.append(suggestionItem);
                });

                // Añade las sugerencias a la vista
                $('#searchInput').after(suggestions);
            }
        });
    } else {
        $('#suggestions').remove(); // Limpia las sugerencias si no hay texto
    }
});